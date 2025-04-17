# TASK MANAGER

This is a simple task manager for curotec assessment.

## Requirements for Laravel 10 + Vue 3 + Inertia + PostgreSQL Project

Before you begin, ensure you have the following software installed:

- PHP >= 8.1
- Composer
- Node.js
- NPM or Yarn
- PostgreSQL

## Step 1: Clone and access the repositoy

1. Clone:

```bash
git clone https://github.com/judsonmb/task-manager.git
```

2. Navigate to access the project directory:

```bash
cd task-manager
```

## Step 2: Configure PostgreSQL

1. In the `.env` file, configure the database environment variables for PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=password
```

2. Create a database in PostgreSQL with the name you defined in `.env`.

## Step 3: Install Laravel Dependencies

### Install the project dependencies:

```bash
composer install
```

### Generate the application key:

```bash
php artisan key:generate
```

### Run the migrations to create the database tables:

```bash
php artisan migrate --seed
```

3. Install js dependencies:

```bash
npm install
```

4. Compile the project assets:

```bash
npm run dev
```

5. Run the Server: In your project directory, run the Laravel server:

```bash
php artisan serve
```

Open your browser and go to `http://localhost:8000` to see your application in action

6. To run tests:

```bash
php artisan test
```

After run tests, it is necessary run php artisan db:seed again.