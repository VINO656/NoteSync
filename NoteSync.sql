-- NoteSync.sql
-- SQL script to create the database structure for NoteSync application

-- Drop existing tables if they exist
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS notes;

-- Create 'users' table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create 'notes' table
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert sample users
INSERT INTO users (username, password, email) VALUES ('testuser1', '$2y$10$wH1HhS7XqG.m7MxIsd9Bbu0G92llXgEOlXQX4Qv/YqgZ2Jb0cPzy2', 'testuser1@example.com');
INSERT INTO users (username, password, email) VALUES ('testuser2', '$2y$10$wH1HhS7XqG.m7MxIsd9Bbu0G92llXgEOlXQX4Qv/YqgZ2Jb0cPzy2', 'testuser2@example.com');
INSERT INTO users (username, password, email) VALUES ('testuser3', '$2y$10$wH1HhS7XqG.m7MxIsd9Bbu0G92llXgEOlXQX4Qv/YqgZ2Jb0cPzy2', 'testuser3@example.com');
INSERT INTO users (username, password, email) VALUES ('testuser4', '$2y$10$wH1HhS7XqG.m7MxIsd9Bbu0G92llXgEOlXQX4Qv/YqgZ2Jb0cPzy2', 'testuser4@example.com');
INSERT INTO users (username, password, email) VALUES ('testuser5', '$2y$10$wH1HhS7XqG.m7MxIsd9Bbu0G92llXgEOlXQX4Qv/YqgZ2Jb0cPzy2', 'testuser5@example.com');
-- Note: The password 'password' is hashed using bcrypt

-- Insert sample notes
INSERT INTO notes (user_id, title, content, file_path) VALUES (1, 'Sample Note 1', 'This is the content of sample note 1.', 'uploads/sample1.txt');
INSERT INTO notes (user_id, title, content, file_path) VALUES (2, 'Sample Note 2', 'This is the content of sample note 2.', 'uploads/sample2.txt');
INSERT INTO notes (user_id, title, content, file_path) VALUES (3, 'Sample Note 3', 'This is the content of sample note 3.', 'uploads/sample3.txt');
INSERT INTO notes (user_id, title, content, file_path) VALUES (4, 'Sample Note 4', 'This is the content of sample note 4.', 'uploads/sample4.txt');
INSERT INTO notes (user_id, title, content, file_path) VALUES (5, 'Sample Note 5', 'This is the content of sample note 5.', 'uploads/sample5.txt');
