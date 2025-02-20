DELETE DATABASE IF EXISTS Aanbiedingen;

CREATE DATABASE Aanbiedingen;

USE Aanbiedingen;

CREATE TABLE Aanbiedingen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    beschrijving TEXT NOT NULL,
    prijs DECIMAL(10, 2) NOT NULL,
    kortingsprijs DECIMAL(10, 2) NOT NULL
);

INSERT INTO Aanbiedingen (beschrijving, prijs, kortingsprijs) VALUES
('Aanbieding 1:
🏋️‍♂️ FitForFun Deal: 3 Maanden Sportschoolabonnement
📌 Krijg 3 maanden onbeperkt toegang tot de sportschool
💰 Nu voor slechts', 
€80.00 * 0.70 'i.p.v',€80.00 ),


('🏃‍♀️ FitForFun Deal: 2 Hardloopschoenen Voor de Prijs van 1!
📌 Koop één paar hardloopschoenen en krijg de tweede gratis.
🎁 Perfect voor jou en je sportmaatje!
', €70.00 'voor' 2 'i.p.v', €140.00),

('🚴 FitForFun Deal: 30% Korting op Sportkleding en Accessoires!
📌 Van sportleggings tot fietshandschoenen—shop nu met korting!
🛒 Gebruik code: FIT30 bij het afrekenen!', 
€80.00 * 0.70 'i.p.v',€80.00 );