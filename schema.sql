
CREATE DATABASE IF NOT EXISTS todo_app;
USE todo_app;
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    status ENUM('pending', 'completed') DEFAULT 'pending'
);
