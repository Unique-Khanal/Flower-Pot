#!/usr/bin/env bash
# ============================================================
#  FlowerPot — One-Click Setup Script (Mac / Linux / Git Bash)
#  Run this in VS Code terminal:  bash setup.sh
# ============================================================

set -e

CYAN='\033[0;36m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

step()    { echo ""; echo -e "${CYAN}==> $1${NC}"; }
success() { echo -e "${GREEN}  ✔  $1${NC}"; }
warn()    { echo -e "${YELLOW}  !!  $1${NC}"; }
fail()    { echo -e "${RED}  ✘  $1${NC}"; exit 1; }

# ── 1. Pull latest code ──────────────────────────────────────
step "Fetching latest code from GitHub..."
git fetch origin                                   || fail "git fetch failed"
git checkout copilot/build-ecommerce-frontend       || fail "git checkout failed"
git pull origin copilot/build-ecommerce-frontend    || fail "git pull failed"
success "Code is up to date"

# ── 2. PHP dependencies ──────────────────────────────────────
step "Installing PHP dependencies (Composer)..."
composer install --no-interaction --prefer-dist    || fail "composer install failed"
success "Composer packages installed"

# ── 3. Node dependencies ─────────────────────────────────────
step "Installing Node dependencies (npm)..."
npm install                                        || fail "npm install failed"
success "npm packages installed"

# ── 4. Build frontend assets ─────────────────────────────────
step "Building frontend assets (Vite)..."
npm run build                                      || fail "npm run build failed"
success "Frontend assets built"

# ── 5. .env setup ────────────────────────────────────────────
step "Setting up .env..."
if [ ! -f ".env" ]; then
    cp .env.example .env
    warn "Created .env from .env.example"
    echo ""
    warn "ACTION REQUIRED: Open .env and set your database details:"
    echo "    DB_CONNECTION=mysql"
    echo "    DB_DATABASE=flower_pot"
    echo "    DB_USERNAME=root"
    echo "    DB_PASSWORD=yourpassword"
    echo ""
    warn "Also set:"
    echo "    APP_URL=http://127.0.0.1:8000"
    echo "    SESSION_DRIVER=file"
    echo "    CACHE_STORE=file"
    echo ""
    read -p "  Press ENTER after you have updated .env to continue..."
else
    success ".env already exists"
fi

# ── 6. App key ───────────────────────────────────────────────
step "Generating application key..."
php artisan key:generate                           || fail "key:generate failed"
success "App key generated"

# ── 7. Database migrations ───────────────────────────────────
step "Running database migrations..."
php artisan migrate --force                        || fail "migrate failed"
success "Migrations complete"

# ── 8. Seed product data ─────────────────────────────────────
step "Seeding product data (prices)..."
php artisan db:seed --class=ProductSeeder --force  || fail "db:seed failed"
success "Products seeded into database"

# ── 9. Storage link ──────────────────────────────────────────
step "Creating storage symlink..."
php artisan storage:link 2>/dev/null || true
success "Storage linked"

# ── Done ─────────────────────────────────────────────────────
echo ""
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  ✔  Setup complete! Start your server:${NC}"
echo -e "     ${CYAN}php artisan serve${NC}"
echo -e "  Then open: ${CYAN}http://127.0.0.1:8000${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
