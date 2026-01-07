# 🛒 E-Commerce Platform

A modern, full-featured e-commerce application built with Laravel 11, featuring a complete shopping experience with authentication, cart management, secure checkout, and order processing.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-blue?style=flat-square)

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Security Features](#-security-features)
- [API Routes](#-api-routes)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 🔐 Authentication & User Management
- User registration and login
- Password reset functionality with secure token expiration
- User profile management with profile picture support
- Session security with regeneration on login

### 🛍️ Product Management
- Product catalog with pagination (12 items per page)
- Product categories
- Product images
- Admin panel for product management

### 🛒 Shopping Cart
- Add items to cart
- Update item quantities
- Remove items from cart
- User-specific cart isolation
- Real-time cart calculations

### 💳 Checkout & Payment
- Multi-step checkout process:
  - Customer details collection
  - Payment method selection
  - Order confirmation
- Secure payment data encryption
- Payment status tracking
- Order management system

### 📦 Order Management
- Complete order tracking
- Order history
- Order items preservation
- Order confirmation emails

### 🔒 Security
- Encrypted payment data storage
- Route protection with authentication middleware
- User authorization checks
- CSRF protection
- Secure password hashing

---

## 🛠️ Tech Stack

### Backend
- **Laravel 11.9** - PHP web framework
- **PHP 8.2+** - Programming language
- **MySQL/PostgreSQL** - Database

### Frontend
- **Tailwind CSS 3.4** - Utility-first CSS framework
- **Vite 5.0** - Next-generation frontend tooling
- **Axios** - HTTP client

### Development Tools
- **Laravel Pint** - Code style fixer
- **PHPUnit** - Testing framework
- **Laravel Sail** - Docker development environment

---

## 📦 Requirements

Before you begin, ensure you have the following installed:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x and **npm**
- **MySQL** >= 8.0 or **PostgreSQL** >= 13
- **Web Server** (Apache/Nginx) or PHP built-in server

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd ecommerce
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the environment file and configure it:

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database Setup

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Build Frontend Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 8. Start the Development Server

```bash
php artisan serve
```

Or use the combined development command:
```bash
composer run dev
```

The application will be available at `http://localhost:8000`

---

## ⚙️ Configuration

### Mail Configuration

Configure your mail settings in `.env` for email notifications:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### File Storage

Ensure the storage directory is writable:

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

---

## 📖 Usage

### Creating an Admin User

Currently, the admin panel is accessible to any authenticated user. To create a user:

1. Register a new account through the registration page
2. Log in with your credentials
3. Access the admin panel at `/admin`

### Adding Products

1. Navigate to `/admin` (requires authentication)
2. Fill in the product form:
   - Product name
   - Description
   - Price
   - Category
   - Product image
3. Submit to add the product

### Shopping Flow

1. **Browse Products**: Visit `/product` to view all available products
2. **Add to Cart**: Click "Add to Cart" on any product (requires login)
3. **View Cart**: Navigate to `/cart` to review your items
4. **Checkout**: Proceed to checkout and complete the multi-step process:
   - Enter customer details
   - Select payment method
   - Confirm order
5. **Order Confirmation**: Receive order confirmation with order details

---

## 📁 Project Structure

```
ecommerce/
├── app/
│   ├── Http/
│   │   └── Controllers/      # Application controllers
│   │       ├── adminController.php
│   │       ├── authController.php
│   │       ├── CartController.php
│   │       ├── CheckoutController.php
│   │       └── productController.php
│   └── Models/               # Eloquent models
│       ├── User.php
│       ├── Item.php
│       ├── Cart.php
│       ├── Order.php
│       ├── OrderItem.php
│       └── Payment.php
├── bootstrap/                # Application bootstrap files
├── config/                   # Configuration files
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/             # Database seeders
├── public/                   # Public assets
├── resources/
│   ├── css/                 # Stylesheets
│   ├── js/                  # JavaScript files
│   └── views/               # Blade templates
│       ├── admin/
│       ├── authentication/
│       ├── cart/
│       ├── checkout/
│       └── products/
├── routes/
│   └── web.php              # Web routes
├── storage/                 # Storage directory
├── tests/                   # Test files
└── vendor/                  # Composer dependencies
```

---

## 🔒 Security Features

This application implements several security best practices:

- ✅ **Encrypted Payment Data**: Sensitive payment information is encrypted using Laravel's encryption
- ✅ **Authentication Middleware**: All protected routes require authentication
- ✅ **Authorization Checks**: Users can only access their own cart and orders
- ✅ **CSRF Protection**: All forms are protected against CSRF attacks
- ✅ **Password Hashing**: Passwords are securely hashed using bcrypt
- ✅ **Session Security**: Session regeneration on login prevents session fixation
- ✅ **Token Expiration**: Password reset tokens expire after 1 hour

For more details, see [IMPROVEMENTS.md](IMPROVEMENTS.md).

---

## 🛣️ API Routes

### Authentication Routes
- `GET /login` - Login page
- `POST /login` - Process login
- `GET /register` - Registration page
- `POST /register` - Process registration
- `GET /logout` - Logout user
- `GET /forget-password` - Password reset request
- `POST /forget-password` - Process password reset request
- `GET /reset-password/{token}` - Password reset form
- `POST /reset-password` - Process password reset

### Product Routes
- `GET /product` - Product catalog
- `GET /` - Home page

### Cart Routes (Authenticated)
- `POST /cart/add/{item}` - Add item to cart
- `GET /cart` - View cart
- `PATCH /cart/update/{item}` - Update cart item quantity
- `DELETE /cart/{id}` - Remove item from cart

### Checkout Routes (Authenticated)
- `GET /checkout/customer-details` - Customer details form
- `POST /checkout/customer-details` - Save customer details
- `GET /checkout/payment-method` - Payment method selection
- `POST /checkout/payment-method` - Save payment method
- `GET /checkout/confirmation` - Order confirmation
- `POST /order/complete` - Complete order
- `GET /order/thank-you/{order?}` - Order thank you page

### Admin Routes (Authenticated)
- `GET /admin` - Admin dashboard
- `POST /admin` - Add new product

### Profile Routes (Authenticated)
- `GET /user_profile` - User profile page
- `POST /user_profile/update` - Update user profile

---

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

Or use PHPUnit directly:

```bash
./vendor/bin/phpunit
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style

This project uses Laravel Pint for code formatting:

```bash
./vendor/bin/pint
```

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com)
- Styled with [Tailwind CSS](https://tailwindcss.com)
- Icons by [Icons8](https://icons8.com)

---

## 📞 Support

For support, please open an issue in the repository or contact the development team.

---

**Made with ❤️ using Laravel**
