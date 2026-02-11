-- Chicken Store Database Schema + Seed Data
CREATE DATABASE IF NOT EXISTS `chicken_store` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chicken_store`;

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Products table
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `category` VARCHAR(50) NOT NULL,
    `name` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(150) NOT NULL UNIQUE,
    `description` TEXT DEFAULT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `unit` VARCHAR(30) NOT NULL DEFAULT '500g',
    `image` VARCHAR(255) DEFAULT NULL,
    `is_available` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_category` (`category`),
    INDEX `idx_available` (`is_available`)
) ENGINE=InnoDB;

-- Orders table
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_number` VARCHAR(20) NOT NULL UNIQUE,
    `customer_name` VARCHAR(100) NOT NULL,
    `customer_phone` VARCHAR(20) NOT NULL,
    `customer_address` TEXT DEFAULT NULL,
    `order_type` ENUM('delivery','pickup') NOT NULL DEFAULT 'delivery',
    `payment_method` VARCHAR(30) NOT NULL DEFAULT 'cod',
    `total_amount` DECIMAL(10,2) NOT NULL,
    `order_status` ENUM('pending','confirmed','preparing','ready','out_for_delivery','delivered','cancelled') NOT NULL DEFAULT 'pending',
    `notes` TEXT DEFAULT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_status` (`order_status`),
    INDEX `idx_order_number` (`order_number`)
) ENGINE=InnoDB;

-- Order Items table
CREATE TABLE IF NOT EXISTS `order_items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT UNSIGNED NOT NULL,
    `product_id` INT UNSIGNED NOT NULL,
    `product_name` VARCHAR(150) NOT NULL,
    `product_price` DECIMAL(10,2) NOT NULL,
    `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
    `subtotal` DECIMAL(10,2) NOT NULL,
    CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_order_items_product` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    INDEX `idx_order_id` (`order_id`)
) ENGINE=InnoDB;

-- Seed admin user (change password after first login)
INSERT INTO `users` (`username`, `email`, `password`, `name`, `phone`) VALUES
('admin', 'admin@chickenstore.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin User', '9999999999');

-- Seed 12 demo products across 6 categories
INSERT INTO `products` (`category`, `name`, `slug`, `description`, `price`, `unit`, `image`, `is_available`) VALUES
-- Fresh Chicken
('Fresh Chicken', 'Whole Chicken (Skin On)', 'whole-chicken-skin-on', 'Farm-fresh whole chicken, cleaned and ready to cook. Perfect for roasting or curry.', 249.00, '1 kg', NULL, 1),
('Fresh Chicken', 'Chicken Curry Cut', 'chicken-curry-cut', 'Freshly cut chicken pieces ideal for everyday curry. Bone-in, skin off.', 199.00, '500g', NULL, 1),

-- Boneless
('Boneless', 'Boneless Breast', 'boneless-breast', 'Premium boneless chicken breast. Lean, tender, and versatile for any dish.', 299.00, '500g', NULL, 1),
('Boneless', 'Boneless Thigh', 'boneless-thigh', 'Juicy boneless thigh meat. Rich flavor, perfect for grilling or stir-fry.', 329.00, '500g', NULL, 1),

-- Marinated
('Marinated', 'Tandoori Marinated Chicken', 'tandoori-marinated-chicken', 'Classic tandoori spice marinated chicken. Ready to grill or bake.', 349.00, '500g', NULL, 1),
('Marinated', 'Butter Chicken Kit', 'butter-chicken-kit', 'Pre-marinated chicken with butter chicken gravy sachet. Restaurant taste at home.', 399.00, '500g', NULL, 1),

-- Kebabs & Seekh
('Kebabs & Seekh', 'Chicken Seekh Kebab', 'chicken-seekh-kebab', 'Handmade seekh kebabs with aromatic spices. Just grill and serve.', 299.00, '6 pcs', NULL, 1),
('Kebabs & Seekh', 'Malai Chicken Tikka', 'malai-chicken-tikka', 'Creamy malai tikka pieces marinated in cheese and cream. Melt in mouth.', 349.00, '8 pcs', NULL, 1),

-- Wings & Drumsticks
('Wings & Drumsticks', 'Chicken Wings', 'chicken-wings', 'Party-ready chicken wings. Perfect for frying, grilling, or air-frying.', 229.00, '500g', NULL, 1),
('Wings & Drumsticks', 'Chicken Drumsticks', 'chicken-drumsticks', 'Meaty drumsticks, great for tandoori or fried chicken lovers.', 219.00, '500g', NULL, 1),

-- Ready to Cook
('Ready to Cook', 'Chicken Nuggets', 'chicken-nuggets', 'Crispy breaded chicken nuggets. Kids favorite! Just fry for 3 minutes.', 249.00, '300g', NULL, 1),
('Ready to Cook', 'Chicken Popcorn', 'chicken-popcorn', 'Bite-sized crispy chicken popcorn. Perfect snack for movie night.', 229.00, '300g', NULL, 1);
