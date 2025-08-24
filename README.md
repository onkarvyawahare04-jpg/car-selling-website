# 🚗 Car Selling Web Application

A simple web application for selling cars online, allowing users to browse cars, book a purchase, register/login, and contact the admin for queries.

# 📌 Features

Homepage: Displays latest cars with price, details, and "Buy Now" options.

Sell Car Page: Car booking form with validation.

Contact Page: Contact form with name, email, and message validation.

User Authentication: Register, Login, and Logout functionality.

Responsive Design using HTML, CSS, and Font Awesome icons.

🛠️ Technologies Used

Frontend: HTML5, CSS3, JavaScript

Backend: PHP

Database: MySQL

Icons: Font Awesome

# 📂 Project Structure
project-folder/
│
├── index.html              # Homepage
├── contact.html            # Contact page
├── Sell_car.html           # Car booking page
├── login.php               # Login script
├── registration.php        # Registration script
├── logout.php              # Logout script
├── contact.php             # Handles contact form submission
├── config.php              # Database configuration
├── bmw-22428.png           # Image used on homepage
└── README.md               # Project documentation

# ⚙️ Setup Instructions

Clone the Repository

git clone <your-repository-link>


Move to your Server Directory (XAMPP or WAMP)
Place the project folder in:

C:\xampp\htdocs\


Create Database in phpMyAdmin

Create a database (e.g., car_sell_db)

Import or create tables for:

users (for registration/login)

contacts (for contact form)

bookings (for car purchase)

Update Database Credentials in config.php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "car_sell_db";


Start Apache & MySQL in XAMPP/WAMP and run:

http://localhost/project-folder/index.html

# ✅ Form Validations

Contact Form: Validates name, email, and message length (JavaScript).

Sell Car Form: Validates name (letters only), email, and phone (10 digits).

Registration: Basic PHP validation (ensure strong passwords recommended).

# 🔐 Security Recommendations

Use prepared statements to prevent SQL injection.

Store passwords using password_hash() in PHP.

Validate all user input on both client and server sides.

# 📷 Screenshots

## Home Page
![home page](https://github.com/user-attachments/assets/5bdb819c-558f-49df-ad4c-3cab5226e836)

## Sell Car Form
![sell car](https://github.com/user-attachments/assets/bef9eacf-8e8f-43f7-b1c1-57b083377869)

## About us
![about](https://github.com/user-attachments/assets/fef17cd2-54a7-4edc-a4e2-03d4ecae5d80)

## Login & Register Pages
![Login](https://github.com/user-attachments/assets/13983b55-6b86-422d-8c52-ad1c8cc80c4c)
![Registraon](https://github.com/user-attachments/assets/17933015-1215-40a0-b292-ea91d852b14c)

