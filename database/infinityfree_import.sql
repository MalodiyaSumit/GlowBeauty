-- Beauty Website Database for InfinityFree
-- Import this file in phpMyAdmin on InfinityFree
-- NOTE: Don't run CREATE DATABASE - InfinityFree creates it for you

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
('Rose Face Cream', 'Hydrating face cream with natural rose extracts for soft and supple skin', 299.00, '', 'Skincare'),
('Vitamin C Serum', 'Brightening serum for glowing and radiant skin', 499.00, '', 'Skincare'),
('Lavender Body Lotion', 'Soothing body lotion with lavender essence for relaxation', 249.00, '', 'Body Care'),
('Hair Growth Oil', 'Natural oil blend for healthy and strong hair growth', 349.00, '', 'Hair Care'),
('Matte Lipstick Set', 'Set of 5 trendy matte lipsticks in stunning shades', 599.00, '', 'Makeup'),
('Foundation SPF 30', 'Full coverage foundation with sun protection for flawless look', 449.00, '', 'Makeup'),
('Charcoal Face Mask', 'Deep cleansing mask for clear and fresh skin', 199.00, '', 'Skincare'),
('Nail Polish Collection', 'Set of 6 vibrant nail colors for perfect manicure', 299.00, '', 'Nails'),
('Aloe Vera Gel', 'Pure aloe vera gel for soothing and moisturizing skin', 179.00, '', 'Skincare'),
('Coconut Hair Mask', 'Deep conditioning hair mask with coconut extracts', 289.00, '', 'Hair Care'),
('Eye Makeup Kit', 'Complete eye makeup kit with eyeshadow, liner and mascara', 699.00, '', 'Makeup'),
('Body Scrub Coffee', 'Energizing coffee body scrub for smooth skin', 329.00, '', 'Body Care');
