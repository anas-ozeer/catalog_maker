# 📚 Catalog and Item Management Application

This is a **Laravel-based web application** that allows users to manage catalogs and the items within them.  
Users can create, update, view, and delete catalogs, and perform similar operations for items associated with each catalog.  
The application supports importing items from Excel files, exporting catalogs to PDF, and bulk image uploads.

---

## 🎥 Demo Video

**YouTube:** [Watch here](https://youtu.be/s41gygf71IM?feature=shared)

---

## 📑 Table of Contents

- [Features](#-features)
- [System Requirements](#-system-requirements)
- [Installation Guide](#-installation-guide)
- [Usage](#usage)
  - [Catalog Management](#catalog-management)
  - [Item Management](#item-management)
  - [Import Items](#import-items)
  - [Export Catalog as PDF](#export-catalog-as-pdf)
  - [Bulk Image Upload](#bulk-image-upload)
- [Contributing](#contributing)
- [License](#license)

---

## ✅ Features

- **Catalog Management:** Create, update, delete, and view catalogs.
- **Item Management:** Add, edit, delete, and view items within catalogs.
- **Bulk Image Upload:** Upload and update item images in bulk.
- **Import Items:** Import items from Excel files.
- **Export Catalog:** Export catalog data to a printable PDF format.

---

## ⚙️ System Requirements

To run this project, ensure you have the following installed:

- **PHP** >= 8.1  
- **Composer** (PHP dependency manager)  
- **Node.js** (Recommended: LTS version 18 or 20)  
- **npm** (comes with Node.js)

### 📥 Installing Prerequisites

**macOS (Homebrew):**

```bash
# Install Homebrew (if not already installed)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install PHP
brew install php

# Install Composer
brew install composer

# Install Node.js (includes npm)
brew install node
```

**Ubuntu / Debian:**

```bash
# Update package lists
sudo apt update

# Install PHP and required extensions
sudo apt install php php-sqlite3 php-xml php-mbstring unzip curl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js and npm (using NodeSource)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

**Windows:**

- **PHP & Composer:** Install [XAMPP](https://www.apachefriends.org/) or [Laragon](https://laragon.org/), both include PHP.
- **Composer:** Download from [getcomposer.org](https://getcomposer.org/).
- **Node.js & npm:** Download from [nodejs.org](https://nodejs.org/).

**Verify installations:**

```bash
php -v
composer -V
node -v
npm -v
```

---

## 🚀 Installation Guide

Follow these steps to set up the application locally:

1. **Clone the repository**

   ```bash
   git clone https://github.com/anas-ozeer/catalog_maker.git
   cd catalog_maker
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install Node.js dependencies**

   ```bash
   npm install
   ```

4. **Copy the example environment file**

   ```bash
   cp .env.example .env
   ```

5. **Generate the application key**

   ```bash
   php artisan key:generate
   ```

6. **Create the SQLite database file**

   ```bash
   mkdir -p database
   touch database/database.sqlite
   ```

   Ensure your `.env` file has the following configuration:

   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

7. **Run database migrations**

   ```bash
   php artisan migrate
   ```

---

## 🤝 Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss improvements.

---

## 📜 License

This project is open-source and available under the [MIT License](LICENSE).
