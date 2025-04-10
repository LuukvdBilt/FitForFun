<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

// Maak de verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Controleer of er een ID is verzonden via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);  // Zorg ervoor dat het ID een integer is om SQL-injecties te voorkomen

    // Controleer of de les bestaat
    $sqlCheck = "SELECT Id FROM Les WHERE Id = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("i", $id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows === 0) {
        echo "<script>alert('De opgegeven les bestaat niet.'); window.location.href='overzicht_lessen.php';</script>";
        exit;
    }
    $stmtCheck->close();

    // SQL-query om de les te verwijderen op basis van het opgegeven ID
    $sql = "DELETE FROM Les WHERE Id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind de parameter
        $stmt->bind_param("i", $id);

        // Voer de query uit
        if ($stmt->execute()) {
            // Les succesvol verwijderd, terugsturen naar de overzichtspagina
            header("Location: overzicht_lessen.php?message=Les succesvol verwijderd.");
            exit;  // Stop verdere uitvoering van de code
        } else {
            // Fout bij het uitvoeren van de query
            echo "<script>alert('Er is een fout opgetreden bij het verwijderen van de les.');</script>";
        }

        $stmt->close();
    } else {
        // Fout bij het voorbereiden van de query
        echo "<script>alert('Fout bij het voorbereiden van de query.');</script>";
    }
} else {
    // Geen ID verzonden, of niet de juiste methode gebruikt
    echo "<script>alert('Ongeldig verzoek.'); window.location.href='overzicht_lessen.php';</script>";
}

$conn->close();
?>