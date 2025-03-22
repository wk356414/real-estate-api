# Real Estate API & Web Application

This project is a Laravel-based application that provides both a RESTful API and a responsive web interface (using Blade templates) for managing real estate properties. It demonstrates best practices in building a modern Laravel application with features such as soft deletes, conditional validations, and complete CRUD operations.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [API Endpoints](#api-endpoints)
- [Web Interface](#web-interface)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [License](#license)
- [Contributing](#contributing)

## Overview

The Real Estate application allows users to create, view, update, delete (soft delete), restore, and hard-delete properties. The API endpoints accept and return JSON, while the web interface uses responsive Blade views styled with Bootstrap and includes DataTables integration for listing records.

## Features

- **RESTful API:**
  - **List Properties:** Returns a JSON array with properties (fields: `id`, `name`, `real_state_type`, `city`, `country`).
  - **Show Property:** Returns detailed JSON for a single property.
  - **Create Property:** Accepts JSON with detailed validation rules including conditional validations.
  - **Update Property:** Updates and returns the updated property.
  - **Soft Delete:** Soft deletes a property and returns the record.
  - **Restore & Hard Delete:** Endpoints for restoring soft-deleted properties and permanently deleting them.

- **Web Interface:**
  - **Responsive Design:** Built with Bootstrap for mobile-first design.
  - **DataTables Integration:** Enhances the properties list with search, sort, and pagination.
  - **Reusable Forms:** Blade partials are used for both create and edit forms.
  - **Client-side Validation:** Uses jQuery validation with custom methods for conditional requirements.

- **Validation & Conditional Logic:**
  - Bathrooms must be greater than zero unless the property type is `land` or `commercial_ground` (in which case, bathrooms can be zero).
  - The `internal_number` field is required only for `department` or `commercial_ground` types.

- **Testing:**
  - Feature tests for API endpoints and web routes.
  - Unit tests for basic application functionality.
  - Utilizes an in-memory SQLite database for fast, isolated tests.

## Installation

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL (or any other supported database; SQLite is used for testing)
- Node.js & NPM (for asset compilation)

### Steps

1. **Clone the Repository:**

   ```bash
   git clone git@github.com:wk356414/laravel-api.git
   cd laravel-api
   ```

2. **Install Dependencies:**

   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations and Seeders:**

   ```bash
   php artisan migrate --seed
   ```

5. **Serve the Application:**

   ```bash
   php artisan serve
   ```

   Your app will be available at [http://localhost:8000](http://localhost:8000).

## Configuration

- **Database:**  
  Configure your database connection in the `.env` file.

- **Testing:**  
  Your `phpunit.xml` is set up to use an in-memory SQLite database. No additional configuration is required for testing.

## API Endpoints

All endpoints return JSON responses.

- **List Properties:**

  ```
  GET /api/realstates
  curl --location 'http://localhost:8000/api/realstates'
  ```

- **Show Property:**

  ```
  GET /api/realstates/{id}
  curl --location 'http://localhost:8000/api/realstates/1'
  ```

- **Create Property:**

  ```
  POST /api/realstates
  curl --location 'http://localhost:8000/api/realstates' \
    --header 'Content-Type: application/json' \
    --data '{
        "name": "New Property",
        "real_state_type": "land",
        "street": "Maple Street",
        "external_number": "A1-101",
        "neighborhood": "Downtown",
        "city": "Metropolis",
        "country": "US",
        "rooms": 3,
        "bathrooms": 4,
        "comments": "Great property"
    }'
  ```

  **Example Request Body:**

  ```json
  {
      "name": "Sample Property",
      "real_state_type": "house",
      "street": "Main Street",
      "external_number": "A1-101",
      "neighborhood": "Downtown",
      "city": "Metropolis",
      "country": "US",
      "rooms": 3,
      "bathrooms": 1.5,
      "comments": "Great location"
  }
  ```

- **Update Property:**

  ```
  PUT /api/realstates/{id}
  curl --location --request PUT 'http://localhost:8000/api/realstates/21' \
    --header 'Content-Type: application/json' \
    --data '{
        "name": "Updated Property",
        "real_state_type": "house",
        "street": "Elm Street",
        "external_number": "B2-202",
        "neighborhood": "Suburbia",
        "city": "Indore",
        "country": "US",
        "rooms": 4,
        "bathrooms": 2,
        "comments": "Updated details"
    }'
  ```

- **Delete (Soft Delete) Property:**

  ```
  DELETE /api/realstates/{id}
  curl --location --request DELETE 'http://localhost:8000/api/realstates/21'
  ```

## Web Interface

- **Homepage (`/`):**  
  Lists all properties with options to view, edit, delete, restore, or hard-delete.

- **Create Property (`/realestates/create`):**  
  A responsive form for creating new properties with client-side validation.

- **Edit Property (`/realestates/{id}/edit`):**  
  A similar form pre-filled with property data for editing.

- **Show Property (`/realestates/{id}`):**  
  Displays property details and action buttons depending on the property state (active or soft-deleted).

## Testing

### Running Tests

Run all tests using the following command:

```bash
php artisan test
```

Or directly via PHPUnit:

```bash
./vendor/bin/phpunit
```

### What is Tested

- **ExampleTest:**  
  Checks if the homepage returns a 200 status.

- **RealEstateTest:**
  - **Index:** Asserts that the API returns properties with the expected JSON structure.
  - **Store & Show:** Verifies creating a property and fetching its details.
  - **Update:** Tests updating property details.
  - **Destroy:** Tests soft-deleting a property and verifies it is marked as soft-deleted.

## Troubleshooting

- **Missing Tables:**  
  If you encounter errors such as "no such table: real_estates", ensure you have run your migrations:

  ```bash
  php artisan migrate
  ```

- **Caching Issues:**  
  Clear any cached configurations:

  ```bash
  php artisan route:clear
  php artisan config:clear
  php artisan view:clear
  ```

- **Testing Database Issues:**  
  Ensure your testing configuration in `phpunit.xml` is set up correctly with:

  ```xml
  <env name="DB_CONNECTION" value="sqlite"/>
  <env name="DB_DATABASE" value=":memory:"/>
  ```

## License

This project is open-sourced under the [MIT License](LICENSE).

## Contributing

Contributions, issues, and feature requests are welcome!  
Feel free to check the [issues page](https://github.com/wk356414/laravel-api/issues).
```

---

This README file now has corrected formatting, clear code blocks, and a complete overview of your project. Adjust the repository URL, license link, and any other custom details as needed.