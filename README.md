# Laravel CRUD Basics

This is a simple Laravel application that demonstrates basic CRUD (Create, Read, Update, Delete) functionality for a `Product` resource. It's designed to be a starting point for learning Laravel and building more complex applications.

## Features

*   **Product Management:** Create, read, update, and delete products.
*   **Database Migrations:** Includes a migration to create the `products` table.
*   **Eloquent ORM:** Uses Laravel's Eloquent ORM for database interactions.
*   **Blade Templating:** Uses Blade for creating dynamic views.
*   **Vite Integration:** Uses Vite for compiling frontend assets.
*   **Responsive Design:** The UI is responsive and works on different screen sizes.

## Requirements

*   PHP >= 8.2
*   Composer
*   Node.js & npm
*   A database server (SQLite is used by default)

## Installation

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/laravel-crud-basics-iterative.git
    cd laravel-crud-basics-iterative
    ```

2.  **Install PHP dependencies:**

    ```bash
    composer install
    ```

3.  **Install frontend dependencies:**

    ```bash
    npm install
    ```

4.  **Create your environment file:**

    Copy the `.env.example` file to a new file named `.env`.

5.  **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

6.  **Create the database file:**

    The application is configured to use SQLite by default. Create an empty file named `database.sqlite` inside the `database` directory.

7.  **Run the database migrations:**

    ```bash
    php artisan migrate
    ```

## Usage

To start the development server, you can use the `dev` script defined in `composer.json`:

```bash
composer dev
```

This will start the following processes concurrently:

*   The Laravel development server on `http://127.0.0.1:8000`
*   The queue worker
*   The Pail log viewer
*   The Vite development server

Once the servers are running, you can access the application in your browser at `http://127.0.0.1:8000`.

### Running Tests

To run the application's tests, you can use the `test` script:

```bash
composer test
```

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
