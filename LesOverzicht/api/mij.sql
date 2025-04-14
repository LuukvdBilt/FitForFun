-- Create the database
CREATE DATABASE fitforfun;

-- Use the database
USE fitforfun;

-- Create the Les table
CREATE TABLE Les (
    Id INT NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(50) NOT NULL,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    MinAantalPersonen TINYINT NOT NULL,
    MaxAantalPersonen TINYINT NOT NULL,
    Beschikbaarheid VARCHAR(50) NOT NULL,
    Prijs DECIMAL(10, 2) NOT NULL, -- Toegevoegd Prijs kolom
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id)
);

-- Create the Reservering table
CREATE TABLE Reservering (
    Id INT NOT NULL AUTO_INCREMENT,
    Voornaam VARCHAR(50) NOT NULL,
    Tussenvoegsel VARCHAR(10),
    Achternaam VARCHAR(50) NOT NULL,
    Nummer MEDIUMINT NOT NULL,
    LesId INT NOT NULL, -- Toegevoegd LesId kolom
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    Reserveringstatus VARCHAR(20) NOT NULL,
    Isactief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (LesId) REFERENCES Les(Id) -- Toegevoegd foreign key constraint
);

-- Voorbeeldgegevens invoegen
INSERT INTO Les (Naam, Datum, Tijd, MinAantalPersonen, MaxAantalPersonen, Beschikbaarheid, Prijs, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd)
VALUES
('Yoga Basics', '2025-05-01', '10:00:00', 5, 20, 'Ingepland', 15.00, 1, '', NOW(), NOW()),
('Kickboxing Advanced', '2025-05-02', '18:00:00', 4, 15, 'Ingepland', 22.00, 1, '', NOW(), NOW()),
('Zumba Fiesta', '2025-05-03', '17:00:00', 6, 25, 'Ingepland', 18.50, 1, '', NOW(), NOW()),
('HIIT Express', '2025-05-04', '07:00:00', 3, 12, 'Ingepland', 19.00, 1, '', NOW(), NOW()),
('Pilates Flow', '2025-05-05', '09:00:00', 2, 10, 'Ingepland', 14.50, 1, '', NOW(), NOW()),
('Box Fit', '2025-05-06', '20:00:00', 5, 18, 'Ingepland', 21.00, 1, '', NOW(), NOW()),
('Spin Class', '2025-05-07', '06:30:00', 4, 16, 'Ingepland', 16.00, 1, '', NOW(), NOW()),
('Aqua Gym', '2025-05-08', '11:00:00', 3, 14, 'Ingepland', 17.00, 1, '', NOW(), NOW()),
('Dance Fit', '2025-05-09', '19:00:00', 5, 20, 'Ingepland', 20.00, 1, '', NOW(), NOW()),
('Core Blast', '2025-05-10', '08:00:00', 2, 12, 'Ingepland', 13.00, 1, '', NOW(), NOW()),
('Cardio Kick', '2025-05-11', '17:30:00', 6, 22, 'Ingepland', 21.00, 1, '', NOW(), NOW()),
('Crossfit Intro', '2025-05-12', '12:00:00', 4, 15, 'Ingepland', 19.00, 1, '', NOW(), NOW()),
('Stretch & Flex', '2025-05-13', '09:30:00', 3, 10, 'Ingepland', 12.50, 1, '', NOW(), NOW()),
('Tabata Burn', '2025-05-14', '08:30:00', 4, 18, 'Ingepland', 15.00, 1, '', NOW(), NOW()),
('BodyPump', '2025-05-15', '10:30:00', 5, 20, 'Ingepland', 18.00, 1, '', NOW(), NOW()),
('Strength Circuit', '2025-05-16', '19:30:00', 3, 16, 'Ingepland', 17.00, 1, '', NOW(), NOW()),
('Latin Dance', '2025-05-17', '14:00:00', 6, 24, 'Ingepland', 16.00, 1, '', NOW(), NOW()),
('TRX Training', '2025-05-18', '15:30:00', 3, 10, 'Ingepland', 20.00, 1, '', NOW(), NOW()),
('Balance & Burn', '2025-05-19', '13:00:00', 4, 14, 'Ingepland', 17.50, 1, '', NOW(), NOW()),
('Morning Energizer', '2025-05-20', '06:00:00', 2, 8, 'Ingepland', 10.00, 1, '', NOW(), NOW()),
('Evening Flow', '2025-05-21', '21:00:00', 5, 18, 'Ingepland', 13.50, 1, '', NOW(), NOW()),
('Urban Combat', '2025-05-22', '20:30:00', 6, 20, 'Ingepland', 22.00, 1, '', NOW(), NOW()),
('Aerobics', '2025-05-23', '16:00:00', 3, 15, 'Ingepland', 12.00, 1, '', NOW(), NOW()),
('Full Body Bootcamp', '2025-05-24', '08:30:00', 4, 20, 'Ingepland', 19.00, 1, '', NOW(), NOW()),
('Mobility Magic', '2025-05-25', '10:00:00', 2, 12, 'Ingepland', 14.00, 1, '', NOW(), NOW()),
('Power Yoga', '2025-05-26', '07:30:00', 5, 20, 'Ingepland', 16.00, 1, '', NOW(), NOW()),
('Stretch & Strength', '2025-05-27', '13:30:00', 3, 14, 'Ingepland', 15.50, 1, '', NOW(), NOW()),
('Booty Blast', '2025-05-28', '18:00:00', 4, 16, 'Ingepland', 18.00, 1, '', NOW(), NOW()),
('Functional Fitness', '2025-05-29', '17:00:00', 3, 15, 'Ingepland', 20.00, 1, '', NOW(), NOW()),
('Sunset Flow', '2025-05-30', '19:00:00', 5, 20, 'Ingepland', 17.00, 1, '', NOW(), NOW());

INSERT INTO Reservering (Voornaam, Tussenvoegsel, Achternaam, Nummer, LesId, Datum, Tijd, Reserveringstatus, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd)
VALUES
('Emma', NULL, 'Jansen', 101, 1, '2025-05-01', '10:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Noah', NULL, 'Smith', 102, 2, '2025-05-02', '18:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Lucas', NULL, 'Garcia', 103, 3, '2025-05-03', '17:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Olivia', NULL, 'Nguyen', 104, 4, '2025-05-04', '07:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Finn', NULL, 'Martens', 105, 5, '2025-05-05', '09:00:00', 'Geannuleerd', 1, 'Verhinderd', NOW(), NOW()),
('Liam', NULL, 'Connor', 106, 6, '2025-05-06', '20:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Zoe', NULL, 'Kowalski', 107, 7, '2025-05-07', '06:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Tariq', NULL, 'Ahmed', 108, 8, '2025-05-08', '11:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Lotte', NULL, 'de Boer', 109, 9, '2025-05-09', '19:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Ava', NULL, 'Johnson', 110, 10, '2025-05-10', '08:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Jasper', NULL, 'Willems', 111, 11, '2025-05-11', '17:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Mia', NULL, 'Schneider', 112, 12, '2025-05-12', '12:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Daan', NULL, 'Klein', 113, 13, '2025-05-13', '09:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Anna', NULL, 'Petrov', 114, 14, '2025-05-14', '08:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Benjamin', NULL, 'Dubois', 115, 15, '2025-05-15', '10:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Eva', NULL, 'Horváth', 116, 16, '2025-05-16', '19:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Amir', NULL, 'Zhang', 117, 17, '2025-05-17', '14:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Julia', NULL, 'Vermeer', 118, 18, '2025-05-18', '15:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Ryan', NULL, 'Evans', 119, 19, '2025-05-19', '13:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Saar', NULL, 'Pieters', 120, 20, '2025-05-20', '06:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Natalie', NULL, 'Lopez', 121, 21, '2025-05-21', '21:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Milan', NULL, 'Ivanov', 122, 22, '2025-05-22', '20:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Isa', NULL, 'Cruz', 123, 23, '2025-05-23', '16:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Jayden', NULL, 'Brown', 124, 24, '2025-05-24', '08:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Chloe', NULL, 'Rossi', 125, 25, '2025-05-25', '10:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Thomas', NULL, 'Schouten', 126, 26, '2025-05-26', '07:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Sara', NULL, 'Novak', 127, 27, '2025-05-27', '13:30:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Leo', NULL, 'Meier', 128, 28, '2025-05-28', '18:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Nora', NULL, 'Silva', 129, 29, '2025-05-29', '17:00:00', 'Bevestigd', 1, '', NOW(), NOW()),
('Max', NULL, 'Bennett', 130, 30, '2025-05-30', '19:00:00', 'Bevestigd', 1, '', NOW(), NOW());
