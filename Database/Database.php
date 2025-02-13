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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
else {
    echo "Connected successfully";
}
?>
