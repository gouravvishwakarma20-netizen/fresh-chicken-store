# Fresh Chicken Store

A modern, mobile-first e-commerce application for a chicken delivery store built with CodeIgniter 4, Tailwind CSS, and MySQL.

## Tech Stack

- **Backend**: PHP 8.1+ / CodeIgniter 4
- **Frontend**: Tailwind CSS (CDN), Font Awesome, AOS animations
- **Database**: MySQL 5.7+ / MariaDB 10.3+
- **Server**: Apache with mod_rewrite

## Features

- Product catalog with categories, search, and filtering
- Session-based shopping cart with AJAX updates
- Checkout with delivery/pickup options and multiple payment methods
- Order confirmation with WhatsApp sharing
- Admin panel with dashboard, order management, and product CRUD
- Mobile-responsive design with bottom navigation
- CSRF protection on all forms and AJAX requests
- Login rate limiting and session security

## Requirements

- PHP 8.1 or higher (with intl, mbstring, mysqlnd extensions)
- MySQL 5.7+ or MariaDB 10.3+
- Apache with `mod_rewrite` enabled
- Composer

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/fresh-chicken-store.git
   cd fresh-chicken-store
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   ```
   Edit `.env` and set:
   - `app.baseURL` to your domain
   - `database.default.*` to your database credentials
   - `encryption.key` — generate with: `php -r "echo bin2hex(random_bytes(32));"`

4. **Import database**
   ```bash
   mysql -u root -p < database/chicken_store.sql
   ```

5. **Set permissions**
   ```bash
   chmod -R 775 writable/
   chmod -R 775 public/uploads/
   ```

6. **Configure web server**
   Point your web server's document root to the `public/` directory.

## Admin Access

- **URL**: `/admin/login`
- **Username**: `admin`
- **Password**: `password`

> Change the admin password after first login.

## Folder Structure

```
project/
├── app/
│   ├── Config/         # App configuration
│   ├── Controllers/    # Route handlers
│   ├── Filters/        # Auth middleware
│   ├── Models/         # Database models
│   └── Views/          # PHP templates
├── database/           # SQL schema & seed data
├── public/             # Web root (index.php, uploads, assets)
├── writable/           # Cache, logs, sessions
├── .env.example        # Environment template
└── composer.json       # PHP dependencies
```

## Deployment Notes

- Set `CI_ENVIRONMENT = production` in `.env`
- Set `app.forceGlobalSecureRequests = true` when SSL is configured
- Use a strong database password in production
- Ensure `writable/` directory has write permissions
- Ensure `public/uploads/` directory has write permissions for product images
