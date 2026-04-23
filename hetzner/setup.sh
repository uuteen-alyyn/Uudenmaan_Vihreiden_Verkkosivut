#!/bin/bash
set -e

REPO="https://github.com/uuteen-alyyn/Uudenmaan_Vihreiden_Verkkosivut.git"
DIR="uuvi-test"

if [ -d "$DIR" ]; then
  echo "Error: directory '$DIR' already exists. Remove it first or choose a different name."
  exit 1
fi

# Collect configuration up front
read -rp "Database password: " DB_PASS </dev/tty
read -rp "Site URL (e.g. http://1.2.3.4:8081): " SITE_URL </dev/tty

echo ""
echo "Cloning repository..."
TMP=$(mktemp -d)
git clone --depth 1 "$REPO" "$TMP"

echo "Setting up $DIR/..."
mkdir -p "$DIR"
cp "$TMP/hetzner/docker-compose.yml" "$DIR/docker-compose.yml"
cp -r "$TMP/uudenmaan-vihreat-theme" "$DIR/theme"
cp "$TMP/db-export/local-dump.sql" "$DIR/local-dump.sql"
cp -r "$TMP/db-export/uploads" "$DIR/uploads"
rm -rf "$TMP"

cat > "$DIR/.env" <<EOF
MYSQL_ROOT_PASSWORD=$DB_PASS
MYSQL_DATABASE=wordpress
MYSQL_USER=wordpress
MYSQL_PASSWORD=$DB_PASS
EOF

echo "Starting containers..."
cd "$DIR"
docker compose up -d

echo "Waiting for database to be ready..."
until docker compose exec -T db mariadb-admin ping -u wordpress -p"$DB_PASS" --silent 2>/dev/null; do
  sleep 2
done

echo "Waiting for WordPress to initialize..."
until docker compose exec -T wordpress test -f /var/www/html/wp-config.php 2>/dev/null; do
  sleep 2
done

echo "Restoring database..."
docker compose exec -T db mariadb -u wordpress -p"$DB_PASS" wordpress < local-dump.sql

echo "Copying uploads (staff photos)..."
docker cp "$DIR/uploads/." uuvi-web:/var/www/html/wp-content/uploads/

echo "Activating theme and plugins..."
docker compose exec -T wordpress bash -c \
  "curl -sS https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /tmp/wp.phar \
   && php /tmp/wp.phar theme activate uudenmaan-vihreat-theme --allow-root --path=/var/www/html \
   && php /tmp/wp.phar plugin install polylang --activate --allow-root --path=/var/www/html"

echo "Updating URLs..."
docker compose exec -T wordpress bash -c \
  "php /tmp/wp.phar search-replace 'http://localhost:8081' '$SITE_URL' \
      --all-tables --allow-root --path=/var/www/html"

echo ""
echo "Done! Open $SITE_URL to access the site."
echo "Admin login: $SITE_URL/wp-admin"
echo "Theme and Polylang are already activated — no manual steps needed."
echo ""
echo "To tear down later:"
echo "  docker compose down -v && cd .. && rm -rf $DIR"
