-- Database setup script for Alemba.com October CMS
-- Run this script in your MySQL database before importing your backup

-- Create the database (replace 'alemba_db' with your preferred database name)
CREATE DATABASE IF NOT EXISTS alemba_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create a user for the application (optional, you can use root)
-- CREATE USER 'alemba_user'@'localhost' IDENTIFIED BY 'your_password';
-- GRANT ALL PRIVILEGES ON alemba_db.* TO 'alemba_user'@'localhost';
-- FLUSH PRIVILEGES;

-- Use the database
USE alemba_db;

-- Note: After running this script, import your database backup file
-- You can do this with: mysql -u root -p alemba_db < your_backup_file.sql
