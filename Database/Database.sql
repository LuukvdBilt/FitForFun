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



   CREATE TABLE MedewerkerOverzicht (
    Id              INT AUTO_INCREMENT                    NOT NULL,
    Voornaam        VARCHAR(150)                          NOT NULL,
    Tussenvoegsel   VARCHAR(50)                           NULL,
    Achternaam      VARCHAR(150)                          NOT NULL,
    Telefoonnummer  VARCHAR(180)                          NOT NULL,
    Werknemerrank   VARCHAR(180)                          NOT NULL,
    IsActief        BIT                                   NOT NULL DEFAULT 1,
    Opmerking       VARCHAR(255)                          NULL DEFAULT NULL,
    DatumAangemaakt DATETIME(6)                           NOT NULL,
    DatumGewijzigd  DATETIME(6)                           NOT NULL,
    CONSTRAINT PK_MedewerkerOverzicht_Id PRIMARY KEY CLUSTERED (Id)
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
,('Ming', NULL, 'Li', '0667890123', '2', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Mingo', NULL, 'lido', '0667890123', '2', 1, NULL, SYSDATE(6), SYSDATE(6));

CREATE TABLE LedenOverzicht
(
    Id               TINYINT(3)          UNSIGNED           NOT NULL   AUTO_INCREMENT,
    Voornaam         VARCHAR(150)                           NOT NULL,
    Tussenvoegsel    VARCHAR(50)                            NULL,
    Achternaam       VARCHAR(150)                           NOT NULL,
    Relatienummer    VARCHAR(50)                            NOT NULL,
    Mobiel           VARCHAR(180)                           NOT NULL,
    Email            VARCHAR(255)                           NOT NULL,
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
    IsActief,
    Opmerking,
    DatumAangemaakt,
    DatumGewijzigd
)
VALUES
('Jeroen', 'van', 'Bakker', 'REL001', '0612345678', 'jeroen.bakker@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Jesse', NULL, 'Jansen', 'REL002', '0623456789', 'jesse.jansen@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Ahmed', NULL, 'Ali', 'REL003', '0634567890', 'ahmed.ali@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Ismael', 'el', 'Hassan', 'REL004', '0645678901', 'ismael.hassan@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Wessel', 'de', 'Vries', 'REL005', '0656789012', 'wessel.devries@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Mark', NULL, 'Johnson', 'REL006', '0667890123', 'mark.johnson@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Daniel', NULL, 'Smith', 'REL007', '0678901234', 'daniel.smith@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Sophie', NULL, 'Williams', 'REL008', '0689012345', 'sophie.williams@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Lucas', 'de', 'Brown', 'REL009', '0690123456', 'lucas.brown@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Emma', 'van der', 'Jones', 'REL010', '0601234567', 'emma.jones@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Mila', NULL, 'Davis', 'REL011', '0612345678', 'mila.davis@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Noah', 'de', 'Martinez', 'REL012', '0623456789', 'noah.martinez@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Eva', 'del', 'Garcia', 'REL013', '0634567890', 'eva.garcia@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Liam', NULL, 'Rodriguez', 'REL014', '0645678901', 'liam.rodriguez@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Julia', 'van', 'Wilson', 'REL015', '0656789012', 'julia.wilson@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Finn', NULL, 'Anderson', 'REL016', '0667890123', 'finn.anderson@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Tess', NULL, 'Thomas', 'REL017', '0678901234', 'tess.thomas@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Carlos', 'de', 'Taylor', 'REL018', '0689012345', 'carlos.taylor@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Yuki', NULL, 'Moore', 'REL019', '0690123456', 'yuki.moore@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Aisha', NULL, 'Jackson', 'REL020', '0601234567', 'aisha.jackson@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Lars', 'van', 'White', 'REL021', '0612345678', 'lars.white@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Sofia', 'de', 'Harris', 'REL022', '0623456789', 'sofia.harris@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Ming', NULL, 'Martin', 'REL023', '0634567890', 'ming.martin@example.com', 1, NULL, SYSDATE(6), SYSDATE(6)),
('Mingo', 'van der', 'Lee', 'REL024', '0645678901', 'mingo.lee@example.com', 1, NULL, SYSDATE(6), SYSDATE(6));
