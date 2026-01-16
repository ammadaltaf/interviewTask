## Clone Repository

git clone <repository_url>
cd laravel-ecommerce-api

# Laravel Ecommerce API (Laravel 12 + Sanctum)

This project is a **production-ready, API-first ecommerce system** built with **Laravel 12**, following **SOLID principles**, **Repository pattern**, **Service layer**, and **Laravel Sanctum** for authentication.

Blade views are used **only as UI**, and they consume the **same API endpoints** as external clients (Postman, mobile apps, SPA).

---

## 🚀 Features

-   API-based authentication using **Laravel Sanctum**
-   Roles: **Admin**, **Staff**
-   Product management (Admin only)
-   Order management with stock handling
-   Async shipment creation using **Queue Jobs**
-   3rd-party Shipping API integration (mock supported)
-   Policy-based authorization
-   Webhooks for shipment updates
-   Soft deletes
-   Optimized queries (eager loading, pagination, indexes)

---

## 🧱 Architecture Overview

Blade UI
↓ (AJAX / Fetch)
API Controllers
↓
Service Layer
↓
Repositories
↓
Eloquent Models

-   **Single API controller** used by both Blade & external clients
-   No business logic inside controllers
-   External API calls isolated in service classes
-   Queue jobs for async processing

---

## Environment Configuration

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=interview_task
DB_USERNAME=root
DB_PASSWORD=

SHIPPING_API_URL=https://mockshippingapi.com/create-shipment
SHIPPING_API_KEY=your_api_key_here
SHIPPING_WEBHOOK_TOKEN=secret_webhook_token

## Run Migrations and Seeders

php artisan migrate:fresh --seed

## Seeder creates

Admin user
Staff users
Sample products

## Register User

    ## Endpoint

POST /api/register

## Request Body

{
"name": "Admin User",
"email": "admin@example.com",
"password": "password",
"password_confirmation": "password"
}

## Login User Endpoint

POST /api/login

## Request Body

{
"email": "admin@example.com",
"password": "password"
}

## Start Queue Worker (for shipment processing)

php artisan queue:work

## Run Server

php artisan serve
