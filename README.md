# 🛒 Smart E-Commerce Management System

A full-stack Laravel e-commerce platform with a clean user storefront and a powerful admin dashboard — built from scratch, no starter kits.

Github Repo 🔗: https://github.com/Rimsha93/smart-ecommerce

Demo video 🔗: https://drive.google.com/file/d/17Uet6YW5P_Nkx-1Rt5VFPru3hAoJV4nj/view?usp=sharing 

---

## What This Project Does

Users can browse products, add them to cart, place orders, and track their delivery status. They can also reach out to support via a contact form and actually see the admin's reply — making it a mini support ticket system, not just a dead-end form.

Admins get a dedicated dashboard where they can manage everything: products, orders, customers, and support messages — all with live search and pagination powered by Yajra DataTables.

---

## Features

**User Side**
- Register / Login with role-based access
- Browse products with search, category filter, and sort
- Product detail page with related products
- Add to cart, update quantity, remove items
- Checkout and place orders
- Track order history with a visual status timeline
- Contact support (logged-in users only)
- View admin replies directly in their message inbox

**Admin Dashboard**
- Overview stats — revenue, orders, customers, pending items
- Product CRUD with image upload
- Order management with status updates (Pending → Processing → Shipped → Delivered)
- Customer profiles with full order history
- Support message inbox with reply system
- All tables powered by Yajra DataTables (server-side search, sort, pagination)

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 11 |
| Frontend | Bootstrap 5 |
| Database | MySQL |
| Tables | Yajra DataTables |
| Auth | Custom (no Breeze/Jetstream) |
| Storage | Laravel Storage (public disk) |

---

## Database Tables

```
users           — customers and admin accounts
categories      — product categories
products        — catalog with image, stock, price
carts           — user cart items
orders          — placed orders with shipping info
order_items     — individual items within each order
contacts        — support messages from users + admin replies
```

---

## Getting Started

### Requirements
- PHP 8.2+
- Composer
- MySQL
- Node.js (optional, for assets)

### Installation

```bash
# 1. Clone the repo
git clone https://github.com/your-username/smart-ecommerce.git
cd smart-ecommerce

# 2. Install dependencies
composer install

# 3. Copy env and configure
cp .env.example .env
php artisan key:generate
```

Open `.env` and set your database credentials:
```env
DB_DATABASE=smart_ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 4. Run migrations and seed demo data
php artisan migrate --seed

# 5. Link storage for product images
php artisan storage:link

# 6. Start the server
php artisan serve
```

Visit `http://localhost:8000`

---

## Demo Accounts

| Role | Email | Password |
|---|---|---|
| Admin | admin@store.com | abcdef |
| Customer | user@store.com | password |

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          → Dashboard, Products, Orders, Customers, Contacts
│   │   ├── Auth/           → Login, Register
│   │   └── ...             → Shop, Cart, Checkout, Orders, Contact
│   └── Middleware/
│       └── IsAdmin.php     → Protects all /admin routes
├── Models/                 → User, Product, Category, Cart, Order, OrderItem, Contact
└── Policies/
    └── CartPolicy.php

resources/views/
├── layouts/
│   ├── app.blade.php       → User-facing layout
│   └── admin.blade.php     → Admin sidebar layout
├── admin/                  → All admin pages
├── shop/                   → Product listing and detail
├── orders/                 → Order history and detail
└── auth/                   → Login and register
```

---

## How the Support System Works

This is the part that makes this project different from a basic store.

1. A logged-in user fills out the contact form with a subject and message
2. The message lands in the admin's inbox on the dashboard
3. Admin opens the message and types a reply
4. The reply gets saved to the database with a timestamp
5. The user can visit "My Messages" and see the full thread — their message and the admin's response
   <img width="1920" height="903" alt="image" src="https://github.com/user-attachments/assets/db04dd9a-031c-428f-bad1-3121527d0b28" />


It's simple but it works like a real support ticket flow.

---

## Order Status Flow

```
Pending → Processing → Shipped → Delivered
```

Admin can update status from the order detail page. Users see it reflected immediately with a visual step indicator on their order page.

---

## Screenshots

> Add your own screenshots here after running the project locally.

| Page | Description |
|---|---|
| `/` | Home page with hero slider and featured products |
| `/shop` | Product grid with filters |
| `/cart` | Cart with quantity controls |
| `/admin/dashboard` | Stats overview and recent orders |
| `/admin/products` | DataTables product management |
| `/admin/contacts` | Support inbox with reply form |

---

