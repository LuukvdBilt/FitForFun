
DROP DATABASE IF EXISTS FitForFun;
 
CREATE DATABASE FitForFun;
 
USE Fitforfun;
 
Create table Pincode
(
    Id INT NOT NULL AUTO_INCREMENT,
    Pincode VARCHAR(10) NOT NULL,
    IsActief BIT NOT NULL,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL,
    Datumgewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id)
);

INSERT INTO Pincode (Pincode, IsActief, Opmerking, Datumaangemaakt, Datumgewijzigd)
VALUES
('1234', 1, 'Hoofdingang', SYSDATE(6), SYSDATE(6));

CREATE TABLE Aanbiedingen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    beschrijving TEXT NOT NULL,
    prijs DECIMAL(10, 2) NOT NULL,
    kortingsprijs DECIMAL(10, 2) NOT NULL
);
 
INSERT INTO Aanbiedingen (beschrijving, prijs, kortingsprijs) VALUES
('🏋️‍♂️ FitForFun Deal: 3 Maanden Sportschoolabonnement 📌 Krijg 3 maanden onbeperkt toegang tot de sportschool 💰 Nu voor slechts', 80.00, 80.00 * 0.70),
('🏃‍♀️ FitForFun Deal: 2 Hardloopschoenen Voor de Prijs van 1! 📌 Koop één paar hardloopschoenen en krijg de tweede gratis!', 80.00, 40.00),
('🚴 FitForFun Deal: 30% Korting op Sportkleding en Accessoires! 📌 Van sportleggings tot fietshandschoenen-shop nu met korting!', 50.00, 50.00 * 0.70);
 
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
('Jesse', 'JessePass012!', 'Lid'),
('Ahmed', 'AhmedPass123!', 'MedeWerker'),
('Ismael', 'IsmaelPass123!', 'MedeWerker'),
('Wessel', 'WesselPass123!', 'MedeWerker'),
('Mark', 'MarkPass123!', 'MedeWerker'),
('Daniel', 'DanielPass123!', 'MedeWerker'),
('Sophie', 'SophiePass123!', 'MedeWerker'),
('Lucas', 'LucasPass123!', 'MedeWerker'),
('Emma', 'EmmaPass123!', 'MedeWerker'),
('Mila', 'MilaPass123!', 'MedeWerker'),
('Noah', 'NoahPass123!', 'MedeWerker'),
('Eva', 'EvaPass123!', 'MedeWerker'),
('Liam', 'LiamPass123!', 'MedeWerker'),
('Julia', 'JuliaPass123!', 'MedeWerker'),
('Finn', 'FinnPass123!', 'MedeWerker'),
('Tess', 'TessPass123!', 'MedeWerker'),
('Carlos', 'CarlosPass123!', 'MedeWerker'),
('Yuki', 'YukiPass123!', 'MedeWerker'),
('Aisha', 'AishaPass123!', 'MedeWerker'),
('Lars', 'LarsPass123!', 'MedeWerker'),
('Sofia', 'SofiaPass123!', 'MedeWerker'),
('Ming', 'MingPass123!', 'MedeWerker');
 
CREATE TABLE MedewerkerOverzicht
(
    Id               TINYINT(3)          UNSIGNED           NOT NULL   AUTO_INCREMENT,
    Voornaam         VARCHAR(150)                           NOT NULL
    ,Tussenvoegsel   VARCHAR(50)                            NULL
    ,Achternaam      VARCHAR(150)                           NOT NULL
    ,Nummer          MEDIUMINT                              NOT NULL
    ,Medewerkersoort VARCHAR(20)                            NOT NULL
    ,IsActief        BIT                                    NOT NULL    DEFAULT 1
    ,Opmerking       VARCHAR(255)                           NULL        DEFAULT NULL
    ,DatumAangemaakt DATETIME(6)                            NOT NULL    
    ,DatumGewijzigd  DATETIME(6)                            NOT NULL
    ,CONSTRAINT      PK_MedewerkerOverzicht_Id              PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;
 
INSERT INTO MedewerkerOverzicht
(
         Voornaam
        ,Tussenvoegsel
        ,Achternaam
        ,Nummer
        ,Medewerkersoort
        ,IsActief
        ,Opmerking
        ,DatumAangemaakt
        ,DatumGewijzigd
)
VALUES
('Ahmed', NULL, 'Khasmiri', 1001, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Ismael', 'El', 'Karamari', 1002, 'beheerder', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Wessel', 'Van der', 'Meer', 1003, 'deskmedewerker', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Mark', NULL, 'Zuckerberg', 1004, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Daniel', NULL, 'Zegveld', 1005, 'beheerder', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sophie', NULL, 'Jansen', 1006, 'deskmedewerker', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lucas', 'De', 'Vries', 1007, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Emma', NULL, 'Bakker', 1008, 'beheerder', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Mila', 'Van', 'Dijk', 1009, 'deskmedewerker', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Noah', NULL, 'Visser', 1010, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Eva', NULL, 'Smit', 1011, 'beheerder', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Liam', 'Van', 'Leeuwen', 1012, 'deskmedewerker', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Julia', NULL, 'Dekker', 1013, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Finn', 'De', 'Jong', 1014, 'beheerder', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Tess', NULL, 'Bos', 1015, 'deskmedewerker', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Carlos', NULL, 'Garcia', 1016, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Yuki', NULL, 'Tanaka', 1017, 'beheerder', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Aisha', NULL, 'Khan', 1018, 'deskmedewerker', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lars', NULL, 'Hansen', 1019, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sofia', NULL, 'Rossi', 1020, 'beheerder', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Ming', NULL, 'Li', 1021, 'deskmedewerker', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Mingo', NULL, 'lido', 1022, 'manager', 1, NULL, SYSDATE(6), SYSDATE(6));
 
CREATE TABLE LedenOverzicht
(
    Id               INT(3)          UNSIGNED               NOT NULL   AUTO_INCREMENT,
    Voornaam         VARCHAR(150)                           NOT NULL,
    Tussenvoegsel    VARCHAR(50)                            NULL,
    Achternaam       VARCHAR(150)                           NOT NULL,
    Relatienummer    VARCHAR(50)                            NOT NULL,
    Mobiel           VARCHAR(180)                           NOT NULL,
    Email            VARCHAR(255)                           NOT NULL,
    Lid_Sinds        VARCHAR(20)                            NOT NULL,
    IsActief         BIT                                    NOT NULL    DEFAULT 1,
    Opmerking        VARCHAR(255)                           NULL        DEFAULT NULL,
    DatumAangemaakt  DATETIME(6)                            NOT NULL,
    DatumGewijzigd   DATETIME(6)                            NOT NULL,
    CONSTRAINT       PK_LedenOverzicht_Id                   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;
 
INSERT INTO LedenOverzicht
(
    Voornaam,
    Tussenvoegsel,
    Achternaam,
    Relatienummer,
    Mobiel,
    Email,
    Lid_Sinds,
    IsActief,
    Opmerking,
    DatumAangemaakt,
    DatumGewijzigd
)
VALUES
('Jeroen', 'van', 'Bakker', 'REL001', '0612345678', 'jeroen.bakker@example.com', '01-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Jesse', NULL, 'Jansen', 'REL002', '0623456789', 'jesse.jansen@example.com', '04-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Ahmed', NULL, 'Ali', 'REL003', '0634567890', 'ahmed.ali@example.com', '07-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Ismael', 'el', 'Hassan', 'REL004', '0645678901', 'ismael.hassan@example.com', '10-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Wessel', 'de', 'Vries', 'REL005', '0656789012', 'wessel.devries@example.com', '13-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Mark', NULL, 'Johnson', 'REL006', '0667890123', 'mark.johnson@example.com', '16-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Daniel', NULL, 'Smith', 'REL007', '0678901234', 'daniel.smith@example.com', '19-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Sophie', NULL, 'Williams', 'REL008', '0689012345', 'sophie.williams@example.com', '22-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Lucas', 'de', 'Brown', 'REL009', '0690123456', 'lucas.brown@example.com', '25-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Emma', 'van der', 'Jones', 'REL010', '0601234567', 'emma.jones@example.com', '28-01-2025', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Mila', NULL, 'Martinez', 'REL011', '0612345678', 'mila.martinez@example.com', '31-01-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Noah', 'de', 'Martinez', 'REL012', '0623456789', 'noah.martinez@example.com', '03-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Eva', 'del', 'Garcia', 'REL013', '0634567890', 'eva.garcia@example.com', '06-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Liam', NULL, 'Rodriguez', 'REL014', '0645678901', 'liam.rodriguez@example.com', '09-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Julia', 'van', 'Wilson', 'REL015', '0656789012', 'julia.wilson@example.com', '12-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Finn', NULL, 'Anderson', 'REL016', '0667890123', 'finn.anderson@example.com', '15-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Tess', NULL, 'Thomas', 'REL017', '0678901234', 'tess.thomas@example.com', '18-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Carlos', 'de', 'Taylor', 'REL018', '0689012345', 'carlos.taylor@example.com', '21-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Yuki', NULL, 'Moore', 'REL019', '0690123456', 'yuki.moore@example.com', '24-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Aisha', NULL, 'Jackson', 'REL020', '0601234567', 'aisha.jackson@example.com', '27-02-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Lars', 'van', 'White', 'REL021', '0612345678', 'lars.white@example.com', '01-03-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Sofia', 'de', 'Harris', 'REL022', '0623456789', 'sofia.harris@example.com', '04-03-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Ming', NULL, 'Martin', 'REL023', '0634567890', 'ming.martin@example.com', '07-03-2024', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Mingo', 'van der', 'Lee', 'REL024', '0645678901', 'mingo.lee@example.com', '10-03-2024', 1, NULL, SYSDATE(6), SYSDATE(6));
 
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
