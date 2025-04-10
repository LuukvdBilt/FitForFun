<?php
// database connectie
$host = 'localhost';
$db   = 'fitforfun'; // vervang met jouw database naam
$user = 'root';      // of jouw db-gebruiker
$pass = '';          // wachtwoord, laat leeg als er geen is
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connectie faalde: " . $e->getMessage());
}

// check of het relatienummer is meegegeven
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Nummer'])) {
    $Nummer = $_POST['Nummer'];

    // delete query
    $stmt = $pdo->prepare("DELETE FROM MedewerkerOverzicht WHERE Nummer = :nummer");
    $stmt->bindParam(':nummer', $Nummer, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: MedewerkerOverzicht.php?status=verwijderd");
        exit;
    } else {
        echo "Fout bij verwijderen.";
    }
} else {
    echo "Ongeldige aanvraag.";
}
?>
