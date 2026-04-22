#!/bin/bash
set -e

REPO="https://github.com/uuteen-alyyn/Uudenmaan_Vihreiden_Verkkosivut.git"
DIR="uuvi-test"

if [ -d "$DIR" ]; then
  echo "Error: directory '$DIR' already exists. Remove it first or choose a different name."
  exit 1
fi

# Collect configuration up front
read -rp "Database password: " DB_PASS
read -rp "Site URL (e.g. http://1.2.3.4:8081): " SITE_URL

echo ""
echo "Cloning repository..."
TMP=$(mktemp -d)
git clone --depth 1 "$REPO" "$TMP"

echo "Setting up $DIR/..."
mkdir -p "$DIR"
cp "$TMP/hetzner/docker-compose.yml" "$DIR/docker-compose.yml"
cp -r "$TMP/uudenmaan-vihreat-theme" "$DIR/theme"
cp "$TMP/db-export/local-dump.sql" "$DIR/local-dump.sql"
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

echo "Restoring database..."
docker compose exec -T db mariadb -u wordpress -p"$DB_PASS" wordpress < local-dump.sql

echo "Updating URLs..."
docker run --rm \
  --network "${DIR}_internal" \
  --volumes-from uuvi-web \
  wordpress:cli \
  wp search-replace 'http://localhost:8081' "$SITE_URL" --allow-root

echo ""
echo "Done! Open $SITE_URL to access the site."
echo "Admin login: $SITE_URL/wp-admin"
echo ""
echo "To tear down later:"
echo "  docker compose down -v && cd .. && rm -rf $DIR"
