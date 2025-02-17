CREATE DATABASE accounts_overzicht;

USE accounts_overzicht;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Werker', 'Gebruiker') NOT NULL
);


INSERT INTO users (username, password, role) VALUES
('admin', 'Achraf5216!?', 'Werker'),
('Wesley', 'BorgMan5289!', 'Werker'),
('Luuk', 'vdBilt0184?', 'Werker'),
('Yassine', 'ElBardai6732*', 'Werker'),
('Jordy', 'JordyPass123!', 'Gebruiker'),
('Thijs', 'ThijsPass456!', 'Gebruiker'),
('Jeroen', 'JeroenPass789!', 'Gebruiker'),
('Jesse', 'JessePass012!', 'Gebruiker');
