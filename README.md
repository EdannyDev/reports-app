# 🚀 Opsdesk – Internal Reports Management System

## 📌 Overview
Opsdesk is a Laravel web application designed to manage internal reports and incidents across different departments within an organization.

It centralizes report creation, tracking, and administration, allowing employees to submit issues and administrators to review, update, and resolve them under a structured workflow.

The system emphasizes relational data integrity, role-based access control, and a clean server-rendered interface.

## 🏗 Architecture
The application follows Laravel's MVC structure:

- **Routes** → Define web endpoints and route protection
- **Controllers** → Handle business logic (reports, areas, authentication, profile)
- **Models** → Eloquent ORM relational modeling
- **Blade Templates** → Server-rendered UI
- **Middleware** → Authenticated route protection

## 🔐 Authentication & Security
- Laravel built-in authentication (login/register)
- Password hashing via bcrypt
- Role automatically assigned based on the user's email domain at registration
- Middleware-based route protection (`auth`)

## 👥 Role-Based Access Control (RBAC)
**Admin**
- Create, edit, and delete reports
- Manage areas
- Full visibility over all submitted reports

**Employee**
- Submit new reports
- View report status and history
- No edit/delete permissions on reports

Roles are determined automatically at registration based on the user's email domain.

## 📦 Core Modules
- User Management (registration, profile, roles)
- Area Management
- Report Creation & Tracking
- Real-time search and pagination (vanilla JS)

## 🛠 Tech Stack
`PHP 8.2+` · `Laravel 11` · `MySQL`

`Blade` · `Bootstrap 5` · `Tailwind CSS` · `Vite`

## ⚙️ Getting Started

### Installation
```bash
git clone https://github.com/EdannyDev/reports-app.git
cd reports-app
composer install
npm install
```

### Environment Variables
Copy `.env.example` to `.env` and fill in your own values:

```bash
cp .env.example .env
php artisan key:generate
```

| Variable | Description | Example |
|---|---|---|
| `APP_URL` | Base URL of the application | `http://localhost:8000` |
| `DB_CONNECTION` | Database driver | `mysql` |
| `DB_HOST` | Database host | `127.0.0.1` |
| `DB_PORT` | Database port | `3306` |
| `DB_DATABASE` | Database name | `opsdesk` |
| `DB_USERNAME` | Database username | `your_db_user` |
| `DB_PASSWORD` | Database password | `your_db_password` |

### Database Setup
```bash
php artisan migrate
php artisan db:seed --class=AreasTableSeeder
```

### Running the App
```bash
npm run build
php artisan serve
```

The app will be available at `http://127.0.0.1:8000`.

---
Author: [@EdannyDev](https://github.com/EdannyDev)