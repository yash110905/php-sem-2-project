-- Create database
CREATE DATABASE crud_project;
USE crud_project;

-- Table for users (admin & registered users)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for website content (like blog posts)
CREATE TABLE content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    body TEXT NOT NULL,
    image VARCHAR(255),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Optionally insert a default user (password: admin123)
INSERT INTO users (name, email, password) 
VALUES ('Admin', 'admin@example.com', '$2y$10$O9/7lD3fB3YwRk.RW2cAJe.qYeCdH88l9IZlTuJX1SYdxwAlrMo0m');
