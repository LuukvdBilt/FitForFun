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
INSERT INTO Les (Id, Naam, Datum, Tijd, Beschikbaarheid, MinAantalPersonen, MaxAantalPersonen, Prijs, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd)
VALUES
(1, 'Yoga', '2023-10-05', '09:00:00', 'Ingepland', 3, 9, 15.00, 1, 'Breng een matje mee.', '2023-09-01 10:00:00', '2023-09-01 10:00:00'),
(2, 'Spinning', '2023-10-06', '10:30:00', 'Ingepland', 2, 8, 20.00, 1, 'Intensieve sessie.', '2023-09-02 11:00:00', '2023-09-02 11:00:00'),
(3, 'Pilates', '2023-10-07', '14:00:00', 'Ingepland', 4, 10, 18.00, 1, 'Geschikt voor alle niveaus.', '2023-09-03 12:00:00', '2023-09-03 12:00:00'),
(4, 'Zumba', '2023-10-08', '18:00:00', 'Ingepland', 5, 12, 22.00, 1, 'Dansen en fit blijven!', '2023-09-04 13:00:00', '2023-09-04 13:00:00'),
(5, 'Kickboksen', '2023-10-09', '19:30:00', 'Ingepland', 3, 10, 25.00, 1, 'Voor zowel beginners als gevorderden.', '2023-09-05 14:00:00', '2023-09-05 14:00:00');

INSERT INTO Reservering (Id, Voornaam, Tussenvoegsel, Achternaam, Nummer, LesId, Datum, Tijd, Reserveringstatus, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd)
VALUES
(1, 'Jan', 'van', 'Janssen', 123456789, 1, '2023-10-05', '09:00:00', 'Gereserveerd', 1, 'Eerste keer Yoga.', '2023-09-06 08:00:00', '2023-09-06 08:00:00'),
(2, 'Piet', '', 'Hein', 987654321, 2, '2023-10-06', '10:30:00', 'Gereserveerd', 1, 'Regelmatige spinner.', '2023-09-07 09:00:00', '2023-09-07 09:00:00'),
(3, 'Klaas', 'de', 'Boer', 456789123, 3, '2023-10-07', '14:00:00', 'Gereserveerd', 1, 'Pilates liefhebber.', '2023-09-08 10:00:00', '2023-09-08 10:00:00'),
(4, 'Griet', 'van', 'Buren', 789123456, 4, '2023-10-08', '18:00:00', 'Gereserveerd', 1, 'Liefhebber van Zumba.', '2023-09-09 11:00:00', '2023-09-09 11:00:00'),
(5, 'Anne', 'de', 'Jong', 321654987, 5, '2023-10-09', '19:30:00', 'Gereserveerd', 1, 'Kickboksen voor conditie.', '2023-09-10 12:00:00', '2023-09-10 12:00:00');