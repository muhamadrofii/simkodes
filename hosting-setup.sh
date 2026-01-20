#!/usr/bin/env bash
set -euo pipefail

# Simple Laravel setup script for Hostinger hPanel (SSH).
# Configure via environment variables or edit defaults below.

APP_DIR="${APP_DIR:-$PWD}"
WEB_ROOT="${WEB_ROOT:-$PWD/public}"
PHP_BIN="${PHP_BIN:-php}"
COMPOSER_BIN="${COMPOSER_BIN:-composer}"
NODE_BIN="${NODE_BIN:-node}"
NPM_BIN="${NPM_BIN:-npm}"
RUN_MIGRATE="${RUN_MIGRATE:-yes}"   # yes/no
BUILD_ASSETS="${BUILD_ASSETS:-yes}" # yes/no

cd "$APP_DIR"

echo "==> Ensuring .env"
if [[ ! -f .env && -f .env.example ]]; then
  cp .env.example .env
  echo "Copied .env.example -> .env (remember to edit .env)."
fi

echo "==> Installing PHP dependencies"
if command -v "$COMPOSER_BIN" >/dev/null 2>&1; then
  "$COMPOSER_BIN" install --no-dev --optimize-autoloader
else
  echo "Composer not found. Install composer or set COMPOSER_BIN."
  exit 1
fi

echo "==> Generating app key (if missing)"
if ! $PHP_BIN -r 'exit(strlen(trim((string)getenv("APP_KEY")))>0?0:1);'; then
  $PHP_BIN artisan key:generate
fi

echo "==> Storage symlink"
$PHP_BIN artisan storage:link || true

if [[ "$BUILD_ASSETS" == "yes" ]]; then
  echo "==> Building assets"
  if command -v "$NODE_BIN" >/dev/null 2>&1 && command -v "$NPM_BIN" >/dev/null 2>&1; then
    "$NPM_BIN" install
    "$NPM_BIN" run build
  else
    echo "Node/npm not found. Set BUILD_ASSETS=no or install Node."
    exit 1
  fi
fi

if [[ "$RUN_MIGRATE" == "yes" ]]; then
  echo "==> Running migrations"
  $PHP_BIN artisan migrate --force
fi

echo "==> Optimizing"
$PHP_BIN artisan config:cache || true
$PHP_BIN artisan route:cache || true
$PHP_BIN artisan view:cache || true

echo "==> Done"
echo "Make sure your web root points to: $WEB_ROOT"
