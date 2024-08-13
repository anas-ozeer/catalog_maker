# Catalog and Item Management Application

This is a Laravel-based web application that allows users to manage catalogs and the items within them. Users can create, update, view, and delete catalogs, and perform similar operations for items associated with each catalog. The application also supports importing items from Excel files and exporting catalogs to PDF.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
  - [Catalog Management](#catalog-management)
  - [Item Management](#item-management)
  - [Import Items](#import-items)
  - [Export Catalog as PDF](#export-catalog-as-pdf)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Catalog Management**: Create, update, delete, and view catalogs.
- **Item Management**: Add items to catalogs, edit item details, delete items, and view item details.
- **Bulk Image Upload**: Upload and update images for items in bulk.
- **Import Items**: Import items from Excel files.
- **Export Catalog**: View catalog data in a printable PDF format.

## Installation

1. **Clone the repository**:
    ```bash
    git clone 
    cd yourrepository
    ```

2. **Install dependencies**:
    ```bash
    composer install
    npm install
    ```

3. **Set up environment variables**:
    - Copy `.env.example` to `.env`.
    - Update database credentials and other necessary configurations in the `.env` file.

4. **Generate application key**:
    ```bash
    php artisan key:generate
    ```

5. **Run migrations**:
    ```bash
    php artisan migrate
    ```

6. **Serve the application**:
    ```bash
    php artisan serve
    ```

## Usage

### Catalog Management

- **View All Catalogs**: Navigate to `/catalogs/index` to view all catalogs.
- **Create a Catalog**: Go to `/catalogs/create`, fill out the form, and submit to create a new catalog.
- **Edit a Catalog**: Go to `/catalogs/{catalog}/edit` to update an existing catalog.
- **Delete a Catalog**: On the catalog view page, click the delete button to remove a catalog.

### Item Management

- **View Items in a Catalog**: Navigate to `/catalogs/{catalog}/items` to view all items in a catalog.
- **Add New Item**: Go to `/catalogs/{catalog}/items/create`, fill out the form, and submit to add a new item.
- **Edit an Item**: Go to `/items/{item}/edit` to update an existing item.
- **Delete an Item**: On the item view page, click the delete button to remove an item.

### Import Items

- **Import Items from Excel**: 
  - Go to `/catalogs/{catalog}/items/import` to upload an Excel file containing items.
  - Ensure the Excel file follows the format: `name,description,price`.

### Export Catalog as PDF

- **View Catalog as PDF**: 
  - Navigate to `/catalogs/{catalog}/view_pdf` to see a catalog in PDF format.

### Bulk Image Upload

- **Bulk Upload Images**: 
  - Go to `/catalogs/{catalog}/items/bulk_edit_image` to upload and update images for items in bulk.

## Contributing

Contributions are welcome! Please fork this repository and submit a pull request.

## License

This project is licensed under the MIT License.

 