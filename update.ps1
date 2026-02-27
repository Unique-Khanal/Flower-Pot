# ============================================================
#  FlowerPot — Pull Latest Updates (Windows PowerShell)
#  Run this in VS Code terminal:  .\update.ps1
#  Use this AFTER you have already run setup.ps1 once.
# ============================================================

$ErrorActionPreference = "Stop"

function Write-Step($msg)    { Write-Host ""; Write-Host "==> $msg" -ForegroundColor Cyan }
function Write-Success($msg) { Write-Host "  OK  $msg" -ForegroundColor Green }
function Write-Fail($msg)    { Write-Host "  FAIL  $msg" -ForegroundColor Red; exit 1 }

Write-Step "Pulling latest code..."
git pull origin copilot/build-ecommerce-frontend
if ($LASTEXITCODE -ne 0) { Write-Fail "git pull failed" }
Write-Success "Code updated"

Write-Step "Installing any new PHP packages..."
composer install --no-interaction --prefer-dist
if ($LASTEXITCODE -ne 0) { Write-Fail "composer install failed" }
Write-Success "Composer done"

Write-Step "Installing any new Node packages..."
npm install
if ($LASTEXITCODE -ne 0) { Write-Fail "npm install failed" }

Write-Step "Rebuilding frontend assets..."
npm run build
if ($LASTEXITCODE -ne 0) { Write-Fail "npm run build failed" }
Write-Success "Assets built"

Write-Step "Running any new database migrations..."
php artisan migrate --force
if ($LASTEXITCODE -ne 0) { Write-Fail "migrate failed" }
Write-Success "Migrations done"

Write-Host ""
Write-Host "============================================" -ForegroundColor Green
Write-Host "  All updated! Run:  php artisan serve" -ForegroundColor Green
Write-Host "  Open: http://127.0.0.1:8000" -ForegroundColor White
Write-Host "============================================" -ForegroundColor Green
