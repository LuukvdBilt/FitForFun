DROP DATABASE IF EXISTS FitForFun;

CREATE DATABASE FitForFun;

USE Fitforfun; 

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


CREATE TABLE LidOverzicht
(
    Id               TINYINT(3)          UNSIGNED           NOT NULL   AUTO_INCREMENT
    ,Voornaam        VARCHAR(150)                           NOT NULL
    ,Tussenvoegsel   VARCHAR(50)                            NULL
    ,Achternaam      VARCHAR(150)                           NOT NULL
    ,Lid_Sinds       DATE                                   NOT NULL
    ,CONSTRAINT      PK_LidOverzicht_Id                     PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;

INSERT INTO LidOverzicht
(
         Voornaam
        ,Tussenvoegsel
        ,Achternaam
        ,Lid_Sinds
)
VALUES
('Jeroen', NULL, 'Kramer', '2025-01-30')
,('Jesse', NULL, 'Kramer', '2025-02-01')
,('Ahmed', NULL, 'Ali', '2025-02-05')
,('Ismael', NULL, 'Hassan', '2025-02-10')
,('Wessel', NULL, 'De Boer', '2025-02-15')
,('Wessel', NULL, 'De Boer', '2025-01-30')
,('Mark', NULL, 'Smith', '2025-02-01')
,('Daniel', NULL, 'Johnson', '2025-02-05')
,('Sophie', NULL, 'Williams', '2025-02-10')
,('Lucas', NULL, 'Brown', '2025-02-15')
,('Emma', NULL, 'Jones', '2025-02-20')
,('Mila', NULL, 'Garcia', '2025-02-25')
,('Noah', NULL, 'Martinez', '2025-03-01')
,('Eva', NULL, 'Rodriguez', '2025-03-05')
,('Liam', NULL, 'Hernandez', '2025-03-10')
,('Julia', NULL, 'Lopez', '2025-03-15')
,('Finn', NULL, 'Gonzalez', '2025-03-20')
,('Tess', NULL, 'Wilson', '2025-03-25')
,('Carlos', NULL, 'Anderson', '2025-03-30')
,('Yuki', NULL, 'Thomas', '2025-01-30')
,('Aisha', NULL, 'Taylor', '2025-02-01')
,('Lars', NULL, 'Moore', '2025-02-05')
,('Sofia', NULL, 'Jackson', '2025-02-10')
,('Ming', NULL, 'Martin', '2025-02-15');

CREATE TABLE LedenOverzicht
(
     Id              TINYINT             UNSIGNED           NOT NULL   AUTO_INCREMENT
    ,Voornaam        VARCHAR(150)                           NOT NULL
    ,Tussenvoegsel   VARCHAR(50)                            NULL
    ,Achternaam      VARCHAR(150)                           NOT NULL
    ,Leeftijd        TINYINT UNSIGNED                       NOT NULL
    ,Geslacht        VARCHAR(180)                           NOT NULL   
    ,IsActief        BIT                                    NOT NULL    DEFAULT 1
    ,Opmerking       VARCHAR(255)                           NULL        DEFAULT NULL
    ,DatumAangemaakt DATETIME(6)                            NOT NULL    
    ,DatumGewijzigd  DATETIME(6)                            NOT NULL
    ,CONSTRAINT      PK_LedenOverzicht_Id                   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


INSERT INTO LedenOverzicht
(
         Voornaam
        ,Tussenvoegsel
        ,Achternaam
        ,Leeftijd
        ,Geslacht
        ,IsActief
        ,Opmerking
        ,DatumAangemaakt
        ,DatumGewijzigd
)
VALUES
('Jan', NULL, 'Jansen', 25, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sanne', 'De', 'Vries', 30, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Pieter', 'van', 'Dijk', 22, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Emma', NULL, 'Bakker', 28, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lucas', NULL, 'Visser', 35, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sophie', 'Van', 'Smit', 27, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Daan', 'de', 'Boer', 32, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lotte', NULL, 'Mulder', 24, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Thomas', NULL, 'Dekker', 29, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Eva', NULL, 'Kok', 26, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Ruben', NULL, 'Meijer', 31, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Anna', 'van', 'Groot', 23, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Jesse', NULL, 'Bos', 34, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Julia', NULL, 'Vos', 25, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lars', NULL, 'Peters', 28, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Mila', NULL, 'Hendriks', 27, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Finn', NULL, 'Bruin', 33, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Noa', NULL, 'Leeuw', 22, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sem', 'De', 'Koning', 30, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Tess', NULL, 'Schouten', 24, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Milan', NULL, 'Graaf', 29, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Fleur', NULL, 'Lange', 26, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Niels', NULL, 'Ruiter', 28, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Roos', 'De', 'Wit', 27, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sven', NULL, 'Haan', 31, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lieke', NULL, 'Jong', 25, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Timo', NULL, 'Boer', 32, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sara', NULL, 'Vos', 24, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Joep', NULL, 'Vries', 29, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lina', 'Van der', 'Groot', 26, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Teun', NULL, 'Bruin', 33, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Maud', 'De', 'Leeuw', 22, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Rik', NULL, 'Koning', 30, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lara', NULL, 'Schouten', 24, 'F', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Joris', NULL, 'Graaf', 28, 'M', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Nina', NULL, 'Lange', 27, 'F', 1, NULL, SYSDATE(6), SYSDATE(6));

CREATE TABLE MedewerkerOverzicht
(
    Id               TINYINT(3)          UNSIGNED           NOT NULL   AUTO_INCREMENT
    ,Voornaam        VARCHAR(150)                           NOT NULL
    ,Tussenvoegsel   VARCHAR(50)                            NULL
    ,Achternaam      VARCHAR(150)                           NOT NULL
    ,Telefoonnummer  VARCHAR(180)                           NOT NULL
    ,Werknemerrank   VARCHAR(180)                           NOT NULL
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
        ,Telefoonnummer
        ,Werknemerrank
        ,IsActief
        ,Opmerking
        ,DatumAangemaakt
        ,DatumGewijzigd
)
VALUES
('Ahmed', NULL, 'Khasmiri', '0634127345', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Ismael', 'El', 'Karamari', '0670236044', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Wessel', 'Van der', 'Meer', '0699102045', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Mark', NULL, 'Zuckerberg', '0683213481', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Daniel', NULL, 'Zegveld', '0636936578', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sophie', NULL, 'Jansen', '0612345678', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lucas', 'De', 'Vries', '0623456789', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Emma', NULL, 'Bakker', '0634567890', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Mila', 'Van', 'Dijk', '0645678901', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Noah', NULL, 'Visser', '0656789012', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Eva', NULL, 'Smit', '0667890123', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Liam', 'Van', 'Leeuwen', '0678901234', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Julia', NULL, 'Dekker', '0689012345', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Finn', 'De', 'Jong', '0690123456', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Tess', NULL, 'Bos', '0601234567', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Carlos', NULL, 'Garcia', '0612345678', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Yuki', NULL, 'Tanaka', '0623456789', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Aisha', NULL, 'Khan', '0634567890', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Lars', NULL, 'Hansen', '0645678901', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Sofia', NULL, 'Rossi', '0656789012', '2', 1, NULL, SYSDATE(6), SYSDATE(6));

DROP TABLE IF EXISTS AccountAanmaken;

CREATE TABLE AccountAanmaken (
    Id               INT AUTO_INCREMENT PRIMARY KEY,
    Voornaam        VARCHAR(150) NOT NULL,
    Tussenvoegsel   VARCHAR(50) NULL,
    Achternaam      VARCHAR(150) NOT NULL,
    Email           VARCHAR(180) NOT NULL UNIQUE,
    Wachtwoord      VARCHAR(255) NOT NULL,
    IsActief        BIT NOT NULL DEFAULT 1,
    Opmerking       VARCHAR(255) NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd  DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB;

INSERT INTO AccountAanmaken 
(Voornaam, Tussenvoegsel, Achternaam, Email, Wachtwoord, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES 
('Ahmed', NULL, 'Khasmiri', 'ahmed@example.com', 'Wachtwoord123!', 1, NULL, NOW(6), NOW(6)),
('Ismael', 'El', 'Karamari', 'ismael@example.com', 'Wachtwoord456!', 1, NULL, NOW(6), NOW(6)),
('Wessel', 'Van der', 'Meer', 'wessel@example.com', 'Wachtwoord789!', 1, NULL, NOW(6), NOW(6));


