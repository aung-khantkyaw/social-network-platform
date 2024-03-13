# Social Network Laravel Application

Social Network is a web application built with Laravel that enables users to interact with one another, exchange information, and work together on different projects. You can set up and configure the Social Network application on your local development environment by following the instructions in this README file.

## Getting Started

To get started with Social Network, follow the steps below:

### Prerequisites

Before you begin, ensure you have the following software installed on your local machine:

-   [PHP](https://www.php.net/) (recommended version: 7.4 or higher)
-   [Composer](https://getcomposer.org/)
-   [MySQL](https://www.mysql.com/) or [SQLite](https://www.sqlite.org/) for the database
-   [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/) for frontend assets

### Installation

1. Clone the Social Network repository from GitHub:

    ```bash
    git clone https://github.com/aung-khantkyaw/Social_Network.git
    ```

2. Change into the project directory:

    ```bash
    cd Social_Network
    ```

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Configure your database connection settings in the `.env` file. You'll need to set the following variables:

    ```
    DB_CONNECTION=mysql
    DB_HOST=your_database_host
    DB_PORT=your_database_port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

    Replace the placeholders with your actual database information.

7. Migrate the database to create the necessary tables:

    ```bash
    php artisan migrate
    ```

8. Install JavaScript dependencies using npm:

    ```bash
    npm install
    ```

9. Compile frontend assets:

    ```bash
    npm run dev
    ```
10. Start the development server:

    ```bash
    php artisan serve
    ```

    By default, the application will be accessible at `http://localhost:8000`.

### Usage

The Social Network application is now available to you through your web browser. You can create an account, log in, and use the application's capabilities.

## Acknowledgments

-   We are grateful that the Laravel community has created such a great PHP framework..
-   # We really appreciate the Social Network development team's dedication to this project.
-   We are grateful that the Laravel community has created such a great PHP framework..
-   We really appreciate the Social Network development team's dedication to this project.

For any issues or questions, please [open an issue on GitHub](https://github.com/aung-khantkyaw/Social_Network/issues).

Enjoy using Social Network!

[@aung-khantkyaw](https://github.com/aung-khantkyaw)
