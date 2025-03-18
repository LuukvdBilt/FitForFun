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
,('Sofia', NULL, 'Rossi', '0656789012', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Ming', NULL, 'Li', '0667890123', '2', 1, NULL, SYSDATE(6), SYSDATE(6));
,('Mingo', NULL, 'lido', '0667890123', '2', 1, NULL, SYSDATE(6), SYSDATE(6));

