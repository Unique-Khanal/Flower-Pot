# ============================================================
#  FlowerPot — One-Click Setup Script (Windows PowerShell)
#  Run this in VS Code terminal:  .\setup.ps1
# ============================================================

$ErrorActionPreference = "Stop"

function Write-Step($msg) {
    Write-Host ""
    Write-Host "==> $msg" -ForegroundColor Cyan
}

function Write-Success($msg) {
    Write-Host "  OK  $msg" -ForegroundColor Green
}

function Write-Fail($msg) {
    Write-Host "  FAIL  $msg" -ForegroundColor Red
    exit 1
}

# ── 1. Pull latest code ──────────────────────────────────────
Write-Step "Fetching latest code from GitHub..."
git fetch origin
if ($LASTEXITCODE -ne 0) { Write-Fail "git fetch failed" }

git checkout copilot/build-ecommerce-frontend
if ($LASTEXITCODE -ne 0) { Write-Fail "git checkout failed" }

git pull origin copilot/build-ecommerce-frontend
if ($LASTEXITCODE -ne 0) { Write-Fail "git pull failed" }

Write-Success "Code is up to date"

# ── 2. PHP dependencies ──────────────────────────────────────
Write-Step "Installing PHP dependencies (Composer)..."
composer install --no-interaction --prefer-dist
if ($LASTEXITCODE -ne 0) { Write-Fail "composer install failed" }
Write-Success "Composer packages installed"

# ── 3. Node dependencies ─────────────────────────────────────
Write-Step "Installing Node dependencies (npm)..."
npm install
if ($LASTEXITCODE -ne 0) { Write-Fail "npm install failed" }
Write-Success "npm packages installed"

# ── 4. Build frontend assets ─────────────────────────────────
Write-Step "Building frontend assets (Vite)..."
npm run build
if ($LASTEXITCODE -ne 0) { Write-Fail "npm run build failed" }
Write-Success "Frontend assets built"

# ── 5. .env setup ────────────────────────────────────────────
Write-Step "Setting up .env..."
if (-Not (Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
    Write-Success "Created .env from .env.example (SQLite — no MySQL needed)"
} else {
    Write-Success ".env already exists"
}

# ── 6. Ensure SQLite database file exists ────────────────────
Write-Step "Ensuring SQLite database file exists..."
if (-Not (Test-Path "database")) { New-Item -ItemType Directory -Path "database" | Out-Null }
if (-Not (Test-Path "database\database.sqlite")) { New-Item -ItemType File -Path "database\database.sqlite" | Out-Null }
Write-Success "database\database.sqlite ready"

# ── 7. App key ───────────────────────────────────────────────
Write-Step "Generating application key..."
php artisan key:generate
if ($LASTEXITCODE -ne 0) { Write-Fail "key:generate failed" }
Write-Success "App key generated"

# ── 8. Database migrations ───────────────────────────────────
Write-Step "Running database migrations..."
php artisan migrate --force
if ($LASTEXITCODE -ne 0) { Write-Fail "migrate failed" }
Write-Success "Migrations complete"

# ── 9. Seed product data ─────────────────────────────────────
Write-Step "Seeding product data (prices)..."
php artisan db:seed --class=ProductSeeder --force
if ($LASTEXITCODE -ne 0) { Write-Fail "db:seed failed" }
Write-Success "Products seeded"

# ── 10. Storage link ──────────────────────────────────────────
Write-Step "Creating storage symlink..."
php artisan storage:link 2>$null
Write-Success "Storage linked"

# ── Done ─────────────────────────────────────────────────────
Write-Host ""
Write-Host "============================================" -ForegroundColor Green
Write-Host "  Setup complete! Start your server:" -ForegroundColor Green
Write-Host "    php artisan serve" -ForegroundColor White
Write-Host "  Then open: http://127.0.0.1:8000" -ForegroundColor White
Write-Host "============================================" -ForegroundColor Green
Write-Host ""
