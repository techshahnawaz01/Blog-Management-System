
 
# Blog Management System

A feature-rich, full-stack web application built with **Laravel**. This project focuses on high interactivity, security, and clean code architecture.

## Core Features

* **Blog CRUD:** Full Create, Read, Update, and Delete functionality with strict ownership authorization.
* **Infinite Nested Comments:** AJAX-powered multi-level replies without page reloads.
* **Real-Time Interactions:** Instant Like/Unlike functionality.
* **Advanced Filtering:** Smart tag-based filtering and live debounced search.
* **Performance:** Infinite scrolling for seamless content loading.

---

## Installation Guide

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/techshahnawaz01/Blog-Management-System.git
cd Blog-Management-System
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install and build frontend assets
npm install
npm run build
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
1. Create a database named `blog_system` in your MySQL server.
2. Update your `.env` file with your database credentials:
```env
DB_DATABASE=blog_system
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrate and Seed
Run the following command to create tables and populate the database with test data:
```bash
php artisan migrate 
php artisan migrate --seed
```

### 6. Run the Application
```bash
php artisan serve
```
Access the project at: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## Test Credentials

Use these pre-seeded accounts to test the application features:

| Name | Email | Password |
| :--- | :--- | :--- |
| **Shahnawaz** | `test@example.com` | `password123` |
| **Ahmed Khan** | `ahmed@example.com` | `password123` |

---

## Technical Highlights

* **Architecture:** Clean MVC (Model-View-Controller) structure.
* **UI Components:** Reusable Laravel Blade components.
* **Security:** Laravel Policies for authorization and Sanctum for route protection.
* **Error Handling:** Fallback mechanisms for AJAX and API requests.

**Developed by Md Shahnawaz**
