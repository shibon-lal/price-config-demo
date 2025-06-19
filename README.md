# 🚀 Laravel + Livewire + Tailwind CSS Starter

Price config 
---

## 📂 Project Structure

This project includes:

- ✅ Laravel (latest version)
- ⚡ Livewire
- 🎨 Tailwind CSS
- 🔀 Database Seeding for Testing
- ⚙️ vite for Asset Compilation

---

## 🧰 Requirements

Ensure your environment meets the following:

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or another supported database
- Laravel CLI

---

## 🛠️ Installation

### 1. Clone the Repository

```bash
https://github.com/shibon-lal/price-config-demo.git
cd price-config-demo
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
```

### 4. Update the env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```
Generate the application key:

```bash
php artisan key:generate
```
### 5.Run Migrations
```bash
php artisan migrate
```

### 6.Seed the Database
```bash
php artisan db:seed
```

### 7. Install Node Modules
```bash
npm install
```

### 8. Build Frontend Assets
```bash
npm run dev
```


