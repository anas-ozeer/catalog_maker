Absolutely — here is the entire improved README.md formatted inside a single fenced code block so you can copy it easily:

# 📚 Catalog and Item Management Application

This is a **Laravel-based web application** that allows users to manage catalogs and the items within them.  
Users can create, update, view, and delete catalogs, and perform similar operations for items associated with each catalog.  
The application supports importing items from Excel files, exporting catalogs to PDF, and bulk image uploads.

---

## 🎥 Demo Video

**YouTube:** [Watch here](https://youtu.be/s41gygf71IM?feature=shared)

---

## 📑 Table of Contents

- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation Guide](#installation-guide)
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

To run this project, you need the following tools installed on your machine:

- **PHP** >= 8.1  
- **Composer** (PHP dependency manager)  
- **Node.js** (Recommended: LTS version 18 or 20)  
- **npm** (comes with Node.js)

### 📥 Installing Prerequisites

#### macOS (Homebrew)

```bash
# Install Homebrew if not installed
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install PHP
brew install php

# Install Composer
brew install composer

# Install Node.js (includes npm)
brew install node

Ubuntu / Debian

# Install PHP and SQLite extension
sudo apt update
sudo apt install php php-sqlite3 php-xml php-mbstring unzip curl

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js and npm (using NodeSource)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

Windows
	•	PHP & Composer: Install XAMPP or Laragon, both include PHP.
	•	Composer: Download from getcomposer.org.
	•	Node.js & npm: Download from nodejs.org.

📌 Verify installations:

php -v
composer -V
node -v
npm -v



⸻

🚀 Installation Guide
	1.	Clone the repository

git clone https://github.com/anas-ozeer/catalog_maker.git
cd catalog_maker


	2.	Install PHP dependencies

composer install


	3.	Install Node.js dependencies

npm install


	4.	Copy the environment file

cp .env.example .env


	5.	Set your application key

php artisan key:generate


	6.	Create the SQLite database file

mkdir -p database
touch database/database.sqlite

In your .env file, ensure the database configuration is:

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite


	7.	Run database migrations

php artisan migrate


	8.	Start the local server
Open two terminals in your project directory:
	•	Terminal 1: Run Laravel’s built-in server

php artisan serve


	•	Terminal 2: Run Vite’s development server

npm run dev


	9.	Visit the app
Open your browser and go to http://127.0.0.1:8000

⸻

✅ Usage

📁 Catalog Management
	•	View All Catalogs: /catalogs/index
	•	Create a Catalog: /catalogs/create
	•	Edit a Catalog: /catalogs/{catalog}/edit
	•	Delete a Catalog: Use the delete button on the catalog view page.

📦 Item Management
	•	View Items: /catalogs/{catalog}/items
	•	Add New Item: /catalogs/{catalog}/items/create
	•	Edit an Item: /items/{item}/edit
	•	Delete an Item: Use the delete button on the item view page.

📥 Import Items
	•	Upload an Excel file at /catalogs/{catalog}/items/import.
Format: name, description, price.

📤 Export Catalog as PDF
	•	View PDF: /catalogs/{catalog}/view_pdf

🖼️ Bulk Image Upload
	•	Upload or update item images in bulk: /catalogs/{catalog}/items/bulk_edit_image

⸻

🤝 Contributing

Contributions are welcome! Please fork this repository, make your changes, and submit a pull request.

⸻

📄 License

This project is licensed under the MIT License.

