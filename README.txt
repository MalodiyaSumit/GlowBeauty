====================================
GLOW BEAUTY SALON - COLLEGE PROJECT
====================================

A simple Beauty Website built using PHP, HTML, CSS, JavaScript, and MySQL.

FOLDER STRUCTURE:
-----------------
Beauty website/
├── config/
│   └── database.php      (Database connection file)
├── css/
│   └── style.css         (Main stylesheet)
├── database/
│   └── beauty_website.sql (SQL file to create database)
├── images/
│   └── products/         (Folder for product images)
├── includes/
│   ├── header.php        (Common header)
│   └── footer.php        (Common footer)
├── js/
│   └── script.js         (JavaScript for validation)
├── index.php             (Home page)
├── services.php          (Services page)
├── products.php          (Products page - fetches from DB)
├── appointment.php       (Appointment booking form)
├── contact.php           (Contact form)
└── README.txt            (This file)


SETUP INSTRUCTIONS (XAMPP):
---------------------------
1. Start XAMPP Control Panel
2. Start Apache and MySQL services

3. Create Database:
   - Open browser: http://localhost/phpmyadmin
   - Click "New" to create database
   - Enter name: beauty_website
   - Click "Create"
   - Click "Import" tab
   - Choose file: database/beauty_website.sql
   - Click "Go" to run the SQL

4. Copy Project:
   - Copy the entire "Beauty website" folder
   - Paste it in: C:/xampp/htdocs/

5. Run Website:
   - Open browser: http://localhost/Beauty website/
   - Or: http://localhost/Beauty%20website/


DATABASE TABLES:
----------------
1. products
   - id (Primary Key, Auto Increment)
   - name
   - description
   - price
   - image
   - category
   - created_at

2. appointments
   - id (Primary Key, Auto Increment)
   - name
   - email
   - phone
   - service
   - date
   - time
   - message
   - created_at

3. contact_messages
   - id (Primary Key, Auto Increment)
   - name
   - email
   - subject
   - message
   - created_at


FEATURES:
---------
- Responsive design (works on mobile)
- Form validation (PHP + JavaScript)
- Database integration for products
- Appointment booking saves to database
- Contact form saves to database
- Clean and simple UI
- No login required


PAGES:
------
1. Home - Introduction and service preview
2. Services - List of all services with prices
3. Products - Products fetched from database
4. Appointment - Booking form (saves to DB)
5. Contact - Contact form (saves to DB)


TECHNOLOGIES USED:
------------------
- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP (Core PHP, no framework)
- Database: MySQL
- Server: XAMPP (Apache + MySQL)


FOR VIVA EXPLANATION:
---------------------
- Database connection is in config/database.php
- All forms use POST method
- PHP validates data before saving
- mysqli_real_escape_string() prevents SQL injection
- htmlspecialchars() prevents XSS attacks
- Products are fetched using SELECT query
- Forms insert data using INSERT query


CREATED FOR:
------------
College Project - Web Development

====================================
