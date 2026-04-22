#!/bin/bash
set -e

REPO="https://github.com/uuteen-alyyn/Uudenmaan_Vihreiden_Verkkosivut.git"
DIR="uuvi-test"

if [ -d "$DIR" ]; then
  echo "Error: directory '$DIR' already exists. Remove it first or choose a different name."
  exit 1
fi

echo "Cloning repository..."
TMP=$(mktemp -d)
git clone --depth 1 "$REPO" "$TMP"

echo "Setting up $DIR/..."
mkdir -p "$DIR"
cp "$TMP/hetzner/docker-compose.yml" "$DIR/docker-compose.yml"
cp -r "$TMP/uudenmaan-vihreat-theme" "$DIR/theme"
rm -rf "$TMP"

cat > "$DIR/.env" <<'EOF'
MYSQL_ROOT_PASSWORD=change_me
MYSQL_DATABASE=wordpress
MYSQL_USER=wordpress
MYSQL_PASSWORD=change_me
EOF

echo ""
echo "Done. Before starting:"
echo "  1. Edit $DIR/.env — replace 'change_me' with real passwords"
echo "  2. cd $DIR && docker compose up -d"
echo "  3. Open http://<server-ip>:8081 to install WordPress"
echo ""
echo "To tear down later:"
echo "  docker compose down -v && cd .. && rm -rf $DIR"
