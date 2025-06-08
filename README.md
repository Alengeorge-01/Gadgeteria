# Gadgeteria

A demo e-commerce project combining a PHP front-end with a Node.js backend for authentication.

## Requirements

- Node.js 18 or later
- PHP 7 or later
- MySQL or compatible database

## Directory Structure

```
public/
  controllers/    # PHP scripts handling requests
  views/          # PHP pages rendered to the browser
  assets/
    css/
    js/
    img/
backend/          # Node.js authentication API
php/              # PHP environment configuration (.env)
```

## Setup

1. Copy `.env.example` to `.env` and provide the necessary credentials for the Node server.
2. Copy `php/.env.example` to `php/.env` and add your database credentials.
3. Install PHP dependencies using `composer install` (none are currently required but composer sets up autoloading).
4. Install Node dependencies with `npm install`. This installs packages used by the backend and the Jest test runner.
5. Start the authentication backend with `npm start`. It runs on port 3000 by default and the PHP front-end sends login requests to this API.

## Testing

### Node tests

1. Install Node dependencies with `npm install` if you haven't already. The tests rely on the packages defined in `package.json`.
2. Run `npm test` to execute the Jest test suite located at `backend/index.test.js`.

### PHP tests

1. Install PHP dependencies with `composer install`. This installs PHPUnit defined in `composer.json`.
2. Run the PHP test suite with `composer test-php` or `vendor/bin/phpunit`.
