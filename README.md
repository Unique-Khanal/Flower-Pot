# 🌿 FlowerPot

A full-stack e-commerce web application for browsing and purchasing flower pots and plants,
built with **Laravel 12**, **Tailwind CSS**, **Alpine.js**, and **Vite**.

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

## ⚡ Pull the Latest Code in VS Code Terminal

Open VS Code, press **Ctrl + `** to open the integrated terminal, then run these commands one by one:

### If you have already cloned the repo before

```bash
# 1. Go into the project folder (adjust path to where you cloned it)
cd Flower-Pot

# 2. Switch to the main branch
git checkout main

# 3. Pull the latest changes from GitHub
git pull origin main

# 4. Install/update PHP packages (run if composer.json changed)
composer install

# 5. Install/update Node packages (run if package.json changed)
npm install

# 6. Build the front-end assets
npm run build

# 7. Run any new database migrations
php artisan migrate

# 8. Start the development server
php artisan serve
```

Your app will be live at **http://127.0.0.1:8000** 🎉

---

### If you are cloning for the first time

```bash
# 1. Clone the repository
git clone https://github.com/Unique-Khanal/Flower-Pot.git

# 2. Move into the project folder
cd Flower-Pot

# 3. Install PHP packages
composer install

# 4. Install Node packages
npm install

# 5. Copy the environment file
cp .env.example .env

# 6. Generate the application key
php artisan key:generate

# 7. Open .env in VS Code and set your DB credentials, then run:
php artisan migrate

# 8. Build the front-end assets
npm run build

# 9. Start the development server
php artisan serve
```

---

## Prerequisites

| Tool | Version | Download |
|------|---------|----------|
| PHP | 8.2 or higher | https://www.php.net/downloads |
| Composer | any | https://getcomposer.org |
| Node.js & npm | 18 or higher | https://nodejs.org |
| MySQL | any | https://dev.mysql.com/downloads |
| Git | any | https://git-scm.com |

---

## .env — Database Setup

After copying `.env.example` to `.env`, update these lines with your local MySQL details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flower_pot
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create a database named `flower_pot` (or any name you prefer) before running `php artisan migrate`.

---

## Project Structure

```
Flower-Pot/
├── app/Http/Controllers/   ← Route controllers
├── database/migrations/    ← Database schema
├── public/images/          ← Product photos
├── resources/views/        ← Blade templates (all pages)
│   ├── layouts/            ← Shared navbar & footer
│   ├── home/               ← Homepage
│   ├── products/           ← Product listing pages
│   ├── about.blade.php
│   ├── services.blade.php
│   └── contact.blade.php
├── routes/web.php          ← All web routes
├── .env.example            ← Environment template
└── vite.config.js          ← Vite / Tailwind config
```

---

## Useful Commands

| What it does | Command |
|---|---|
| Start dev server | `php artisan serve` |
| Start Vite hot-reload | `npm run dev` |
| Build assets for production | `npm run build` |
| Run migrations | `php artisan migrate` |
| Clear config cache | `php artisan config:clear` |
| Clear view cache | `php artisan view:clear` |
| Run tests | `php artisan test` |

---

## License

Open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
