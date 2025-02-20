DROP DATABASE IF EXISTS accounts_overzicht;
CREATE DATABASE accounts_overzicht;

USE accounts_overzicht;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Administrator','Medewerker','Lid', 'GastGebruiker') NOT NULL
);


INSERT INTO users (username, password, role) VALUES
('admin', 'Achraf1532!?', 'Administrator'),
('Wesley', 'BorgMan5289!', 'MedeWerker'),
('Luuk', 'vdBilt0184?', 'MedeWerker'),
('Yassine', 'ElBardai6732*', 'MedeWerker'),
('Jordy', 'JordyPass123!', 'GastGebruiker'),
('Thijs', 'ThijsPass456!', 'GastGebruiker'),
('Jeroen', 'JeroenPass789!', 'Lid'),
('Jesse', 'JessePass012!', 'Lid');
