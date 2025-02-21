<?php
// Hier onder staat de SQL code die de database aanmaakt en de tabellen met de gegevens
// Als je iets verandert aan de database, zet hier dan het laatste script in!
// Als je meer naar beneden scrolt gaan we de verbinding maken met de database in Phpmyadmin

// SQL:

/*
    DROP DATABASE if EXISTS fitforfun;
    CREATE DATABASE if not EXISTS fitforfun;
    USE fitforfun;
    CREATE TABLE Medewerkers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    functie VARCHAR(255)
);

*/


// hier staat het script om te verbinden met de database

$host = 'localhost';
$dbname = 'fitforfun';
$username = 'root';    // Standaard WAMP-gebruiker
$password = '';        // Standaard WAMP-wachtwoord (leeg)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>