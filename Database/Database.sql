
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
    user_id               INT(5)          UNSIGNED               NOT NULL   AUTO_INCREMENT,
    Nummer           MEDIUMINT                              NOT NULL,
    username         VARCHAR(50)                            NOT NULL,
    Voornaam         VARCHAR(150)                           NOT NULL,
    Tussenvoegsel    VARCHAR(50)                            NULL,
    Achternaam       VARCHAR(150)                           NOT NULL,
    Mobiel           VARCHAR(180)                           NOT NULL,
    Email            VARCHAR(255)                           NOT NULL,
    Lid_Sinds        DATE                                   NULL,
    rol              ENUM('Administrator','Medewerker','Lid','GastGebruiker') NULL,
    password         VARCHAR(255)                           NOT NULL,
    IsActief         BIT                                    NOT NULL    DEFAULT 1,
    Opmerking        VARCHAR(255)                           NULL        DEFAULT NULL,
    DatumAangemaakt  DATETIME(6)                            NOT NULL,
    DatumGewijzigd   DATETIME(6)                            NOT NULL,
    CONSTRAINT       PK_LedenOverzicht_user_id              PRIMARY KEY CLUSTERED(user_id)
) ENGINE=InnoDB;

INSERT INTO LedenOverzicht
(
    Nummer,
    username,
    Voornaam,
    Tussenvoegsel,
    Achternaam,
    Mobiel,
    Email,
    Lid_Sinds,
    rol,
    password,
    IsActief,
    Opmerking,
    DatumAangemaakt,
    DatumGewijzigd
)
VALUES
(1000, 'jan.janssen', 'Jan', 'van', 'Janssen', '0612345678', 'jan.janssen@example.com', '2025-09-01', 'Lid', 'JanPass123!?', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1001, 'Hamidoes', 'Hamida', 'El', 'Harachi', '0612345678', 'hamida.Harachi@example.com', '2025-01-01', 'Lid', 'Hamida123!?', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1002, 'jesse.jansen', 'Jesse', NULL, 'Jansen', '0623456789', 'jesse.jansen@example.com', '2025-01-04', 'Lid', 'JessePass456!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1003, 'ahmed.ali', 'Ahmed', NULL, 'Ali', '0634567890', 'ahmed.ali@example.com', '2025-01-07', 'Lid', 'AhmedPass789!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1004, 'ismael.hassan', 'Ismael', 'El', 'Hassan', '0645678901', 'ismael.hassan@example.com', '2025-01-10', 'Lid', 'IsmaelPass012!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1005, 'wessel.devries', 'Wessel', 'De', 'Vries', '0656789012', 'wessel.devries@example.com', '2025-01-13', 'Lid', 'WesselPass345!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1006, 'mark.johnson', 'Mark', NULL, 'Johnson', '0667890123', 'mark.johnson@example.com', '2025-01-16', 'Lid', 'MarkPass678!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1007, 'daniel.smith', 'Daniel', NULL, 'Smith', '0678901234', 'daniel.smith@example.com', '2025-01-19', 'Lid', 'DanielPass901!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1008, 'sophie.williams', 'Sophie', NULL, 'Williams', '0689012345', 'sophie.williams@example.com', '2025-01-22', 'Lid', 'SophiePass234!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1009, 'lucas.brown', 'Lucas', 'De', 'Brown', '0690123456', 'lucas.brown@example.com', '2025-01-25', 'Lid', 'LucasPass567!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1010, 'emma.jones', 'Emma', 'Van der', 'Jones', '0601234567', 'emma.jones@example.com', '2025-01-28', 'Lid', 'EmmaPass890!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1011, 'mila.martinez', 'Mila', NULL, 'Martinez', '0612345678', 'mila.martinez@example.com', '2024-01-31', 'Lid', 'MilaPass123!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1012, 'noah.martinez', 'Noah', 'De', 'Martinez', '0623456789', 'noah.martinez@example.com', '2024-02-03', 'Lid', 'NoahPass456!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1013, 'eva.garcia', 'Eva', 'Del', 'Garcia', '0634567890', 'eva.garcia@example.com', '2024-02-06', 'Lid', 'EvaPass789!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1014, 'liam.rodriguez', 'Liam', NULL, 'Rodriguez', '0645678901', 'liam.rodriguez@example.com', '2024-02-09', 'Lid', 'LiamPass012!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1015, 'julia.wilson', 'Julia', 'Van', 'Wilson', '0656789012', 'julia.wilson@example.com', '2024-02-12', 'Lid', 'JuliaPass345!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1016, 'finn.anderson', 'Finn', NULL, 'Anderson', '0667890123', 'finn.anderson@example.com', '2024-02-15', 'Lid', 'FinnPass678!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1017, 'tess.thomas', 'Tess', NULL, 'Thomas', '0678901234', 'tess.thomas@example.com', '2024-02-18', 'Lid', 'TessPass901!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1018, 'carlos.taylor', 'Carlos', 'De', 'Taylor', '0689012345', 'carlos.taylor@example.com', '2024-02-21', 'Lid', 'CarlosPass234!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1019, 'yuki.moore', 'Yuki', NULL, 'Moore', '0690123456', 'yuki.moore@example.com', '2024-02-24', 'Lid', 'YukiPass567!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1020, 'aisha.jackson', 'Aisha', NULL, 'Jackson', '0601234567', 'aisha.jackson@example.com', '2024-02-27', 'Lid', 'AishaPass890!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1021, 'lars.white', 'Lars', 'Van', 'White', '0612345678', 'lars.white@example.com', '2024-03-01', 'Lid', 'LarsPass123!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1022, 'sofia.harris', 'Sofia', 'De', 'Harris', '0623456789', 'sofia.harris@example.com', '2024-03-04', 'Lid', 'SofiaPass456!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1023, 'ming.martin', 'Ming', NULL, 'Martin', '0634567890', 'ming.martin@example.com', '2024-03-07', 'Lid', 'MingPass789!', 1, NULL, SYSDATE(6), SYSDATE(6)),
(1024, 'mingo.lee', 'Mingo', 'Van der', 'Lee', '0645678901', 'mingo.lee@example.com', '2024-03-10', 'Lid', 'MingoPass012!', 1, NULL, SYSDATE(6), SYSDATE(6));

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
