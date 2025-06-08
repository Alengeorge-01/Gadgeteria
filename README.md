# Gadgeteria

A demo e-commerce project combining a PHP storefront with a Node.js backend for authentication.

## Directory layout

- `server/` - Express API using Supertokens for passwordless login.
- `*.php` and asset files - the PHP front-end that renders the shop and interacts with a MySQL database.
- `connect.php` - database connection helper used across PHP pages.

## Requirements

- Node.js 18 or later
- PHP 7 or later
- MySQL server for the PHP scripts

## Environment variables

### Node
Copy `.env.example` to `.env` and provide values:

```env
APP_NAME=demo-app
PORT=3000
SUPERTOKENS_CONNECTION_URI=https://demo.supertokens.io
SUPERTOKENS_API_KEY=YOUR_SUPERTOKENS_API_KEY
NODEMAILER_USER=your_email@example.com
NODEMAILER_PASSWORD=your_password
```

### PHP
The PHP code expects MySQL credentials matching `connect.php`. Example variables:

```env
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=appliances
```

Edit `connect.php` or export these variables to match your database setup.

## Setup

1. Install Node dependencies with `npm install`.
2. Start the Node backend using `npm start`.
3. Serve the PHP front-end from the repository root:
   ```bash
   php -S localhost:8000
   ```

## Testing

Run the Jest tests for the backend:

```bash
npm test
```
