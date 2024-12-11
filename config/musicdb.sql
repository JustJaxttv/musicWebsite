CREATE DATABASE IF NOT EXISTS music_site;
USE music_site;

-- Create Artists Table
CREATE TABLE artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create Songs Table
CREATE TABLE songs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist_id INT,
    album VARCHAR(255),
    genre VARCHAR(255),
    release_date DATE,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE SET NULL
);

-- Create Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'user'
);

-- Insert Sample Artists
INSERT INTO artists (name) VALUES
('Artist One'),
('Artist Two'),
('Artist Three');

-- Insert Sample Songs
INSERT INTO songs (title, artist_id, album, genre, release_date) VALUES
('Song One', 1, 'Album One', 'Rock', '2021-01-01'),
('Song Two', 2, 'Album Two', 'Pop', '2022-02-15'),
('Song Three', 3, 'Album Three', 'Jazz', '2023-03-20');

-- Insert Sample Users (Passwords are hashed using bcrypt)
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFXExFzIT1oA5ghe6G0KCuk0Z9S/JZyW', 'admin'), -- Password: admin123
('user1', '$2y$10$R0Kb.3n.sZtAs5UlEFO0e.ZPNgXZ3eYZ2EZgOjdGOdDdJl3RT.PAu', 'user');  -- Password: user123
