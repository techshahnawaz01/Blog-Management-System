
 
# 🚀 Blog Management System

A professional, feature-rich, full-stack web application built with **Laravel**. This project demonstrates a clean MVC architecture, high interactivity with AJAX, and a modern UI/UX design.

---

## 🌟 Key Features

### 📝 Advanced Content Management
* **Full CRUD Lifecycle:** Complete control over blog posts (Create, Read, Update, Delete).
* **Rich Text Editing:** Integrated **CKEditor 5** for professional formatting (Bold, Lists, etc.).
* **Smart Truncation:** Intelligently truncated content in grid views for a clean layout.

### 💬 Interactive Discussion System
* **Infinite Nested Replies:** Multi-level threading allowing users to reply to any comment.
* **AJAX-Powered:** Post comments and replies instantly without page reloads.
* **Visual Hierarchy:** Professional conversation design with threaded lines and nested padding.

### ❤️ Social & Engagement
* **Real-Time Likes:** Seamless AJAX-based like/unlike functionality.
* **Live Metrics:** Instant display of total likes and comment counts on every post.
* **Dynamic Avatars:** Initial-based user avatars for personalized attribution.

### 🔍 Discovery & Navigation
* **Live Debounced Search:** Instant title search with debouncing to optimize server load.
* **Multi-Tag Filtering:** Advanced tag-based filtering for precise content discovery.
* **Infinite Scrolling:** Smooth content loading using the **Intersection Observer API**.

### 🎨 Modern UI/UX
* **Adaptive Dark Mode:** Tailwind CSS-based toggle with persistence via `localStorage`.
* **Responsive Grid:** Dual-column professional layout for desktop and single-column for mobile.
* **Glassmorphism Design:** Premium look with sticky navigation and blurred backgrounds.
* **Typography:** Optimized for readability using **Google Fonts (Inter)**.

---

## 🛠 Technical Stack

* **Backend:** Laravel (PHP)
* **Frontend:** Tailwind CSS, Laravel Blade Components
* **Database:** MySQL (Eloquent ORM)
* **Interactions:** jQuery AJAX, Fetch API
* **Optimization:** Infinite Scroll, JS Debouncing
* **Authentication:** Laravel Sanctum & Policies (Strict Authorization)

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
