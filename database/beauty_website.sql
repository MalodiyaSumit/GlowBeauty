-- Beauty Website Database
-- Run this SQL in phpMyAdmin to create the database and tables

-- Create Database
CREATE DATABASE IF NOT EXISTS beauty_website;
USE beauty_website;

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Appointments Table
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    service VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Sample Products
INSERT INTO products (name, description, price, image, category) VALUES
('Rose Face Cream', 'Hydrating face cream with natural rose extracts', 299.00, 'images/products/cream1.jpg', 'Skincare'),
('Vitamin C Serum', 'Brightening serum for glowing skin', 499.00, 'images/products/serum1.jpg', 'Skincare'),
('Lavender Body Lotion', 'Soothing body lotion with lavender essence', 249.00, 'images/products/lotion1.jpg', 'Body Care'),
('Hair Growth Oil', 'Natural oil blend for healthy hair growth', 349.00, 'images/products/oil1.jpg', 'Hair Care'),
('Matte Lipstick Set', 'Set of 5 trendy matte lipsticks', 599.00, 'images/products/lipstick1.jpg', 'Makeup'),
('Foundation SPF 30', 'Full coverage foundation with sun protection', 449.00, 'images/products/foundation1.jpg', 'Makeup'),
('Charcoal Face Mask', 'Deep cleansing mask for clear skin', 199.00, 'images/products/mask1.jpg', 'Skincare'),
('Nail Polish Collection', 'Set of 6 vibrant nail colors', 299.00, 'images/products/nailpolish1.jpg', 'Nails');
