USE fitforfun;


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




















