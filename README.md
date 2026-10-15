# Classic Hotel Management System

A hotel management system for managing rooms, guests, reservations, check-in/check-out, payments, staff, and hotel operations using MySQL, HTML, CSS, and JavaScript.

## Application functionality

- Dashboard
- Employee login/logout
- Customer registration
- Customer search
- Customer editing/deletion
- Departments
- Employee management
- Room types
- Room range management
- Room availability checking
- Reservation creation
- Reservation cancellation
- Room sales
- Restaurant management and restaurant service
- Medical service management
- Medical service records
- Sport facility management and sport service
- Massage room management and massage service
- Room service management and service records
- Laundry management and service records
- Customer frequency/revenue reporting
- Current guest reporting
- Service usage reporting
- Printable reports
- Dashboard daily service statistics
- Next-week occupancy counts
- Most frequent customers
- Highest-paying customer
- Responsive admin interface


## PHP architecture

```text
Classic_Hotel_Management_System/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   └── images/
├── database/
│   └── database.sql
├── includes/
│   ├── auth.php
│   ├── db.php
│   ├── helpers.php
│   ├── layout.php
│   └── service_engine.php
├── uploads/
├── config.php
├── install.php
├── login.php
├── logout.php
├── index.php
├── customer.php
├── customers.php
├── customer_edit.php
├── departments.php
├── department_form.php
├── employees.php
├── employee_form.php
├── rooms.php
├── room_form.php
├── room_types.php
├── room_type_form.php
├── reservation.php
├── reservations.php
├── restaurant.php
├── restaurant_form.php
├── restaurant_service.php
├── medical.php
├── medical_form.php
├── medical_service.php
├── sport.php
├── sport_form.php
├── sport_service.php
├── massage.php
├── massage_form.php
├── massage_service.php
├── room_service.php
├── room_service_form.php
├── room_service_service.php
├── laundry.php
├── laundry_form.php
├── laundry_service.php
├── search.php
├── service.php
├── reports.php
└── README.md
```

PHP and HTML are together in the PHP pages. CSS is kept in `assets/css/`, JavaScript in `assets/js/`, and images in `assets/images/`.

## Requirements

- PHP 8.3+
- MySQL 5.7+/8.x or MariaDB
- Apache/XAMPP
- PDO
- PDO MySQL

## Installation with XAMPP

1. Extract the project to:

```text
C:\xampp\htdocs\Classic_Hotel_Management_System
```

2. Start **Apache** and **MySQL** in XAMPP.

3. Open:

```text
http://localhost/Classic_Hotel_Management_System/install.php
```

4. Enter your MySQL details.

Typical XAMPP values:

```text
Host:     127.0.0.1
Port:     3306
Database: hotel
Username: root
Password: empty
```

5. Create the administrator account.

6. Open:

```text
http://localhost/Classic_Hotel_Management_System/login.php
```

## Default administrator

The installer initially suggests:

```text
Username: admin
Password: admin123
```

Change this password after installation.

## PHP built-in server

From the project directory:

```bash
php -S localhost:8000
```

Open:

```text
http://localhost:8000/install.php
```

## License/subscription restrictions

The application can run locally without an activation key or subscription check.

## Important

After installation, protect or remove `install.php` on a public production server.

Do not use the MySQL `root` account for a production deployment. Create a dedicated database user with only the required permissions.
