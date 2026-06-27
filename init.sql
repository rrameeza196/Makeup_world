-- Auto-runs when MySQL container starts for the first time
-- Creates the makeup_db tables

CREATE DATABASE IF NOT EXISTS makeup_db;
USE makeup_db;

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert default admin (username: Maryam, password: 1234)
INSERT IGNORE INTO admin_users (username, password) VALUES ('Maryam', '1234');

-- Sample products data
INSERT IGNORE INTO products (name, description, price, image_url) VALUES
('Lipstick - Red Rose', 'Long-lasting matte red lipstick', 599.00, ''),
('Foundation - Ivory', 'Full coverage liquid foundation', 1200.00, ''),
('Mascara - Black', 'Volumizing waterproof mascara', 850.00, ''),
('Eyeshadow Palette', '12-color shimmer palette', 1500.00, ''),
('Blush - Peach Glow', 'Natural peachy blush', 700.00, '');
