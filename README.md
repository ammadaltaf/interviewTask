## Clone Repository

git clone <repository_url>
cd laravel-ecommerce-api

## Install Dependencies

composer install
npm install

## Environment Configuration

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_ecommerce
DB_USERNAME=root
DB_PASSWORD=

SHIPPING_API_URL=https://mockshippingapi.com/create-shipment
SHIPPING_API_KEY=your_api_key_here
SHIPPING_WEBHOOK_TOKEN=secret_webhook_token

## Run Migrations and Seeders

php artisan migrate:fresh --seed

## Start Queue Worker (for shipment processing)

php artisan queue:work

## Run Server

php artisan serve
