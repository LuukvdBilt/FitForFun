USE fitforfun;


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




















