#!/usr/bin/env bash
# ============================================================
#  FlowerPot — Pull Latest Updates (Mac / Linux / Git Bash)
#  Run this in VS Code terminal:  bash update.sh
#  Use this AFTER you have already run setup.sh once.
# ============================================================

set -e
CYAN='\033[0;36m'; GREEN='\033[0;32m'; NC='\033[0m'
step()    { echo ""; echo -e "${CYAN}==> $1${NC}"; }
success() { echo -e "${GREEN}  ✔  $1${NC}"; }

step "Pulling latest code..."
git pull origin copilot/build-ecommerce-frontend
success "Code updated"

step "Installing any new PHP packages..."
composer install --no-interaction --prefer-dist
success "Composer done"

step "Installing any new Node packages..."
npm install

step "Rebuilding frontend assets..."
npm run build
success "Assets built"

step "Running any new database migrations..."
php artisan migrate --force
success "Migrations done"

echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  ✔  All updated! Run: php artisan serve${NC}"
echo -e "  Open: ${CYAN}http://127.0.0.1:8000${NC}"
echo -e "${GREEN}============================================${NC}"
