# 🌿 FlowerPot

A full-stack e-commerce web application for browsing and purchasing flower pots and plants,
built with **Laravel 12**, **Tailwind CSS**, **Alpine.js**, and **Vite**.

---

## 🆘 Lost your folder? Re-clone from scratch

If your `Flower-Pot` folder was deleted or lost, run **all of the following commands** in PowerShell or Git Bash:

```powershell
git clone https://github.com/Unique-Khanal/Flower-Pot.git
cd Flower-Pot
git checkout copilot/build-ecommerce-frontend
```

> ⚠️ **The `git checkout` line is required.** The setup script (`setup.ps1`) only exists on this branch.
> Skipping it causes the *"setup.ps1 is not recognized"* error.

Then open the `Flower-Pot` folder in **VS Code** (`code .`) and continue with Quick Start below.

---

### 🚨 PowerShell says "setup.ps1 is not recognized" or "cannot be loaded"?

Run this **once** to allow local scripts, then run `.\setup.ps1` again:

```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

Or bypass the policy for this one run only:

```powershell
powershell -ExecutionPolicy Bypass -File .\setup.ps1
```

---

### 🆘 If `setup.ps1` still fails — run these manual commands instead

Paste them one by one in the VS Code terminal:

```powershell
composer install --no-interaction --prefer-dist
npm install
npm run build
copy .env.example .env
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=ProductSeeder --force
php artisan storage:link
php artisan serve
```

Then open **http://127.0.0.1:8000** ✅

> 💡 Before running the commands above, open `.env` and set your database details:
> `DB_DATABASE=flower_pot`, `DB_USERNAME=root`, `DB_PASSWORD=` ← use your actual MySQL password (never leave this blank in production).

---

## ⚡ Quick Start — Run ONE command in VS Code terminal

Open your `Flower-Pot` folder in VS Code, open the terminal (**Ctrl + `**).

**First — make sure you are on the correct branch** (do this once after cloning):
```powershell
git checkout copilot/build-ecommerce-frontend
```

Then run the setup script:

### Windows (PowerShell)
```powershell
.\setup.ps1
```

> If you get a *"cannot be loaded"* error, run first:
> ```powershell
> Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
> ```

### Mac / Linux / Git Bash
```bash
bash setup.sh
```

That's it. The script will automatically:
1. Switch to the correct branch (`copilot/build-ecommerce-frontend`)
2. Pull all the latest code
3. Install all PHP & Node packages
4. Build the frontend assets
5. Create your `.env` file and prompt you to fill in database details
6. Run all database migrations
7. Seed all product data (prices, images, categories)

After setup is done, start the server:
```bash
php artisan serve
```
Then open **http://127.0.0.1:8000** ✅

---

## 🔄 Pull the Latest Code

Use this every time new changes are pushed to the project.

### Option A — One command (recommended)

#### Windows (PowerShell)
```powershell
.\update.ps1
```

#### Mac / Linux / Git Bash
```bash
bash update.sh
```

The script pulls the code, installs any new packages, rebuilds assets, and runs new migrations automatically.

---

### Option B — Manual git commands (copy-paste these one by one)

```bash
git pull origin copilot/build-ecommerce-frontend
composer install --no-interaction --prefer-dist
npm install
npm run build
php artisan migrate --force
```

Then start the server (run this separately):
```bash
php artisan serve
```

Then open **http://127.0.0.1:8000** ✅

> 💡 After pulling, always run `php artisan serve` to start the server if it is not already running.

---

## ✏️ Editing the blade files

After running `setup.ps1` (or `setup.sh`) your `resources/views/` folder will contain:

```
resources/views/
├── layouts/app.blade.php            ← navbar, cart drawer, footer
├── components/product-card.blade.php
├── home/index.blade.php
├── about.blade.php
├── services.blade.php
├── contact.blade.php
├── auth/login.blade.php
└── products/
    ├── index.blade.php
    ├── plants.blade.php
    └── pots/
        ├── index.blade.php
        ├── ceramics.blade.php
        ├── cement.blade.php
        ├── mud.blade.php
        └── plastic.blade.php
```

> 💡 After editing any `.blade.php` file just **refresh your browser** — no rebuild needed.
> Only run `npm run build` again if you edit `resources/js/app.js` or `resources/css/app.css`.

---

## 📝 How to Edit Page Text & Paragraphs

Open the file in VS Code, find the text shown below, and change it to whatever you want.
**Save the file, then refresh your browser — the change appears instantly.**

---

### 🏠 Home Page — `resources/views/home/index.blade.php`

| What you see on screen | What to look for in the file |
|---|---|
| Hero badge | `🌿 Welcome to FlowerPot` |
| Hero heading | `Bring <span class="text-amber-400">Nature</span><br>Into Your Home` |
| Hero paragraph | `Discover our handpicked collection of beautiful pots and vibrant plants.` |
| Stats strip numbers | `200+`, `5+`, `Free`, `100%` and their labels (`Products`, `Categories`, …) |
| "Shop by Category" sub-heading | `Find the perfect pot or plant to breathe life into every corner of your home` |
| "Why Choose Us?" heading | `We're committed to bringing the best nature has to offer, right to your door` |
| Free Delivery card text | `Free home delivery on all orders above Rs. 1500. We deliver across Pakistan.` |
| 100% Natural card text | `All our plants are naturally grown. Healthy, vibrant, and ready for your home.` |
| Gift Wrapping card text | `Special gift packaging available. Perfect for birthdays, anniversaries, and more.` |
| CTA banner heading | `Ready to Go Green?` |
| CTA banner paragraph | `Browse our full collection of pots and plants to find your perfect match.` |

---

### ℹ️ About Page — `resources/views/about.blade.php`

| What you see on screen | What to look for in the file |
|---|---|
| Hero paragraph | `We believe every home deserves a touch of green. FlowerPot was born out of…` |
| "Our Story" paragraph 1 | `FlowerPot started with a simple idea — that bringing nature indoors should be easy…` |
| "Our Story" paragraph 2 | `From hand-crafted ceramic and mud pots to sturdy cement and plastic planters…` |
| "Our Story" paragraph 3 | `Whether you are a seasoned plant parent or just starting your green journey…` |
| "What We Stand For" sub-heading | `Everything we do is guided by our love for nature…` |
| Value card labels & sub-titles | Edit the `'name'` and `'sub'` values inside the `@foreach` array |
| Feature card descriptions | Edit the `'desc'` values inside the second `@foreach` array |

---

### 🛠️ Services Page — `resources/views/services.blade.php`

| What you see on screen | What to look for in the file |
|---|---|
| Hero paragraph | `From doorstep delivery to custom pot design — we take care of everything…` |
| Home Delivery paragraph | `We deliver your plants and pots directly to your doorstep, anywhere in Pakistan…` |
| Home Delivery bullet points | The three `<li>` items under "Home Delivery" |
| Custom Pots paragraph | `Want something unique? We craft custom pots in any size, shape, or color…` |
| Plant Consultation paragraph | `Not sure which plant suits your space? Our expert horticulturists provide…` |
| Gift Wrapping paragraph | `Make your gift extra special with our eco-friendly gift wrapping service…` |
| Landscaping paragraph | `Transform your outdoor spaces with our professional landscaping service…` |
| Bulk Orders paragraph | `Need pots or plants in large quantities for events, offices, or hotels?…` |
| CTA paragraph | `Contact us today and let's create something beautiful together.` |

---

### 📬 Contact Page — `resources/views/contact.blade.php`

| What you see on screen | What to look for in the file |
|---|---|
| Hero paragraph | `We'd love to hear from you. Reach out and we'll get back to you within 24 hours.` |
| Address | `123 Garden Street, Green City, Lahore, Pakistan` |
| Phone numbers | `+92 300 1234567` / `+92 42 1234567` |
| Email addresses | `info@flowerpot.pk` / `support@flowerpot.pk` |
| Business hours | `Mon – Sat: 9:00 AM – 8:00 PM` / `Sunday: 10:00 AM – 5:00 PM` |

---

### 🧭 Navbar & Footer — `resources/views/layouts/app.blade.php`

All navigation links, the site name, and the footer text live in this single file.
Search for the text you want to change and edit it directly.

---

## 📤 How to Share Screenshots

There are two ways to send a screenshot (ss) to this project:

### Option 1 — Attach to a GitHub Issue or PR comment (easiest)

1. Open the issue or pull request on GitHub.
2. Scroll to the comment box at the bottom.
3. **Drag and drop** your screenshot image file directly into the comment box, **or** click the 📎 paperclip icon to browse for it.
4. GitHub will upload it automatically and insert a link like `![screenshot](https://...)` into your comment.
5. Click **"Comment"** to post it.

> 💡 See [GitHub's supported file types and size limits](https://docs.github.com/en/get-started/writing-on-github/working-with-advanced-formatting/attaching-files) for the full list.

---

### Option 2 — Add a screenshot to the repo docs

If you want a screenshot to appear permanently in the README:

1. Save your image as a `.png` file into the `public/screenshots/` folder:
   ```
   public/screenshots/your-screenshot-name.png
   ```
2. Reference it in `README.md`:
   ```markdown
   ![Description](public/screenshots/your-screenshot-name.png)
   ```
3. Commit and push:
   ```bash
   git add public/screenshots/your-screenshot-name.png README.md
   git commit -m "docs: add screenshot for <feature>"
   git push
   ```

---

## 📸 Screenshots

### 🏠 Home Page
![Home](public/screenshots/home.png)

### 🛍 Products
![Products](public/screenshots/products.png)

### 🪴 Plants Collection
![Plants](public/screenshots/plants.png)

### 🏺 Pots
![Pots](public/screenshots/pots.png)

### 🎨 Ceramics
![Ceramics](public/screenshots/ceramics.png)

### ℹ️ About
![About](public/screenshots/about.png)

### 📬 Contact
![Contact](public/screenshots/contact.png)

---

## ⚡ Get & Run the Latest Code (Terminal Commands)

Open VS Code, press **Ctrl + `** to open the integrated terminal, then run **all of these commands one by one**:

---

### ✅ Step 1 — Switch to the PR branch (where all new code lives)

```bash
git fetch origin
git checkout copilot/build-ecommerce-frontend
git pull origin copilot/build-ecommerce-frontend
```

---

### ✅ Step 2 — Install PHP packages

```bash
composer install
```

---

### ✅ Step 3 — Set up your environment file

```bash
cp .env.example .env
php artisan key:generate
```

Then open `.env` and update these lines:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flower_pot
DB_USERNAME=root
DB_PASSWORD=your_password_here

SESSION_DRIVER=file
CACHE_STORE=file
```

> 💡 Setting `SESSION_DRIVER=file` and `CACHE_STORE=file` means no database is needed to browse the frontend.

---

### ✅ Step 4 — Install Node packages & build assets

```bash
npm install
npm run build
```

---

### ✅ Step 5 — Start the development server

```bash
php artisan serve
```

Your app will be live at 👉 **http://127.0.0.1:8000**

---

## 🔄 What Changed in This Branch

| File | What was updated |
|---|---|
| `resources/js/app.js` | Added Alpine.js **cart store** with localStorage — cart persists across pages |
| `resources/views/components/product-card.blade.php` | "🛒 Cart" → **"Add to Cart"** with live feedback ("✓ Added!") |
| `resources/views/components/product-card.blade.php` | **"Buy Now"** now adds item to cart AND opens the cart drawer |
| `resources/views/layouts/app.blade.php` | Cart icon badge now shows **live item count** |
| `resources/views/layouts/app.blade.php` | New **cart slide-out drawer** — view items, see total, clear cart |

---

## 🛠️ Editing the Blade Files

All page templates are in `resources/views/`. Open any of these in VS Code to edit:

```
resources/views/
├── layouts/app.blade.php          ← Navbar, cart drawer, footer (edit here for global changes)
├── components/product-card.blade.php  ← Product card (image, name, price, Add to Cart, Buy Now)
├── home/index.blade.php           ← Home page
├── products/index.blade.php       ← Products page
├── products/plants.blade.php      ← Plants listing
├── products/pots/index.blade.php  ← Pots category page
├── products/pots/ceramics.blade.php
├── products/pots/cement.blade.php
├── products/pots/mud.blade.php
├── products/pots/plastic.blade.php
├── about.blade.php
├── services.blade.php
└── contact.blade.php
```

After editing any blade file, just **refresh your browser** — no rebuild needed.

After editing `resources/js/app.js` or `resources/css/app.css`, run:

```bash
npm run build
```

---

## Prerequisites

| Tool | Version | Download |
|------|---------|----------|
| PHP | 8.2 or higher | https://www.php.net/downloads |
| Composer | any | https://getcomposer.org |
| Node.js & npm | 18 or higher | https://nodejs.org |
| Git | any | https://git-scm.com |

---

## Useful Commands

| What it does | Command |
|---|---|
| Start dev server | `php artisan serve` |
| Hot-reload assets while editing JS/CSS | `npm run dev` |
| Build assets for production | `npm run build` |
| Clear config cache | `php artisan config:clear` |
| Clear view cache | `php artisan view:clear` |

---

## License

Open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
