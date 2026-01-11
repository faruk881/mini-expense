# 🚀 Expense Management System API (Laravel + Sanctum)

A **secure, scalable, and role-based Expense Management System API** built with **Laravel 11** and **Laravel Sanctum**.  
This project enables employees to submit expense claims and managers to review, approve, or reject them with dashboard-level reporting.

---

## 📌 Features

### 🔐 Authentication & Authorization
- API authentication using **Laravel Sanctum**
- Role-based access control:
  - **Employee**
  - **Manager**
- Employee self-registration
- Manager accounts created via **database seeder**

---

### 💼 Expense Management
- Employees can:
  - Submit expenses
  - Upload receipt images
  - View their own expense history
- Managers can:
  - View all employee expenses
  - Approve or reject expense requests
  - Provide rejection remarks

---

### 🧾 Expense Categories
- Predefined expense categories
- SEO-friendly **slug-based filtering**
- Example categories:
  - Travel
  - Food
  - Accommodation
  - Office Supplies

---

### 📊 Dashboard & Reports
- Total pending expense amount
- Total approved expenses (current month)
- Aggregated statistics using optimized database queries

---

### 🔍 Filtering & Querying
- Filter expenses by:
  - Status (`pending`, `approved`, `rejected`)
  - Category (`travel`, `food`, etc.)
- Filters implemented using **Eloquent Scopes**

---

### 🖼️ File Uploads
- Receipt images stored using Laravel **Storage**
- Files saved on the `public` disk
- Organized and accessible via storage symlink

---

## 🛠️ Tech Stack

- **Laravel 11**
- **Laravel Sanctum**
- **MySQL**
- **Eloquent ORM**
- **RESTful API Architecture**

---

## 📂 Database Schema

### Users
- `id`
- `name`
- `email`
- `password`
- `role` (`employee`, `manager`)

### Expense Categories
- `id`
- `name`
- `slug`

### Expenses
- `id`
- `user_id`
- `category_id`
- `amount`
- `description`
- `receipt_image`
- `status` (`pending`, `approved`, `rejected`)
- `remarks`
- `created_at`

---

## 🔗 API Endpoints

### Authentication
| Method | Endpoint | Description |
|------|---------|-------------|
| POST | `/api/register` | Employee registration |
| POST | `/api/login` | User login |

---

### Expenses
| Method | Endpoint | Role |
|------|---------|------|
| POST | `/api/expenses` | Employee |
| GET | `/api/expenses` | Employee / Manager |
| PATCH | `/api/expenses/{id}/status` | Manager |

---

### Dashboard
| Method | Endpoint | Role |
|------|---------|------|
| GET | `/api/dashboard-stats` | Manager |

---

## 📥 Installation & Setup

```bash
git clone https://github.com/your-username/expense-management-api.git
cd expense-management-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
