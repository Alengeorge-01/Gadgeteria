# Gadgeteria

A demo e-commerce project combining a PHP front-end with a Node.js backend for authentication.

## Requirements

- Node.js 18 or later
- PHP 7 or later

## Setup

1. Copy `.env.example` to `.env` and provide the necessary credentials.
2. Install Node dependencies with `npm install`.
3. Start the backend server using `npm start`.
4. Ensure a `cart` table exists in your `appliances` database:
   ```sql
   CREATE TABLE cart (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(100) NOT NULL,
       product_id VARCHAR(100) NOT NULL,
       name VARCHAR(100) NOT NULL,
       price INT NOT NULL,
       quantity INT NOT NULL
   );
   ```

## Testing

Run `npm test` to execute the Jest test suite.
