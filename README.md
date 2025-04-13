
# 🛒 Laravel E-Commerce API

This is a Laravel-based RESTful API for managing products, categories, users, and orders in an e-commerce system. It includes authentication using Laravel Sanctum, role-based access control, image uploads, and inventory management.

---

## 🚀 Features

- Product & Category CRUD with validation
- Image upload support
- Order management with inventory handling
- Role-based access: Admin & Customer
- Laravel Sanctum authentication
- Input validation & sanitization
- Rate limiting on sensitive endpoints

---

## 📦 Installation

### 1. Clone the repository:

```bash
git clone https://github.com/husni159/life-ecommerce-laravel.git
cd your-repo-name
```

### 2. Install dependencies:

```bash
composer install
```

### 3. Set up your environment:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Update your .env file:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YOUR_KEY
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=life_farmacy
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### 5. Run migrations and seeders:

```bash
php artisan migrate --seed
```

### 6. Link storage for public image access:

```bash
php artisan storage:link
```

### 7. Run the server:

```bash
php artisan serve
```

---

## 📂 API Endpoints Overview

### 🔐 Authentication

- `POST /api/register` – Register a new user
- `POST /api/login` – Login & receive token

### 📦 Products

- `GET /api/products` – List products (paginated)
- `GET /api/products/{id}` – Get product details
- `POST /api/products` – Create (Admin only)
- `PUT /api/products/{id}` – Update (Admin only)
- `DELETE /api/products/{id}` – Delete (Admin only)

### 🗂️ Categories

- `GET /api/categories` – List categories
- `POST /api/categories` – Create (Admin only)

### 📑 Orders

- `POST /api/orders` – Place an order
- `GET /api/orders` – View user order history
- `GET /api/orders/{id}` – View specific order

---

## 🛡️ Security & Validation

- Sanctum API Token Authentication
- Role-based authorization middleware
- Input sanitization and custom validation
- Rate limiting on sensitive endpoints

---

## 🧪 API Testing with Postman

You can find the Postman collection in the `/postman` folder:

📁 [`life-hospital.postman_collection.json`](postman/laravel-ecommerce-api.postman_collection.json)

Import it into Postman and set your environment variables like `{{base_url}}` and `{{token}}`.

---

Happy coding! 🚀