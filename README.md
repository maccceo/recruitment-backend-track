# RB Taxes

RB Taxes is a Laravel-based backend API that provides a complete system for managing invoices, tax profiles, and users. This API is designed to be robust, scalable, and easily integrated with frontend applications that require electronic invoicing functionality.

## Key features

**User Management**: Registration, authentication, and permission management
**Tax Profiles**: Creation and management of tax profiles for companies and individuals
**Invoice Management**: Creation, modification, and archiving of electronic invoices
**Advanced Search**: Filter invoices by their fields

## Getting Started

1. Clone the repository:

    ```
    git clone https://github.com/maccceo/recruitment-backend-track
    cd recruitment-backend-track
    ```

2. Create the project's .env file:

    ```bash
    cp .env.example .env  # since no sensitive information are contained, this is all you'll need
    ```

3. Build and start the Docker containers:

    ```bash
    docker compose up --build -d
    ```

4. Enter the Docker container:

    ```bash
    docker compose exec app bash
    ```

5. Inside the container, run:

    ```bash
    composer install
    php artisan key:generate
    php artisan migrate --seed
    ```

6. That's it! Installation complete.

## Testing the API

To test and interact with the RB Taxes API, the following options are available:

-   [Postman collection](https://www.postman.com/maccceo/workspace/public/collection/5171181-72d8304c-90b0-496e-8ff7-4a35a0c8463d?action=share&creator=5171181)
-   After the installation, check the docs: http://localhost:8080/docs/api/
