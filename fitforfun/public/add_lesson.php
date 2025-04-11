<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $lesNaam = $_POST['lesNaam'];
    $lesDatum = $_POST['lesDatum'];
    $lesTijd = $_POST['lesTijd'];
    $lesBeschikbaarheid = $_POST['lesBeschikbaarheid'];
    $lesMinAantalPersonen = $_POST['lesMinAantalPersonen'];
    $lesMaxAantalPersonen = $_POST['lesMaxAantalPersonen'];
    $lesPrijs = $_POST['lesPrijs'];
    $lesOpmerking = $_POST['lesOpmerking'];

    // Insert lesson into database
    $sql = "INSERT INTO Les (Naam, Datum, Tijd, Beschikbaarheid, MinAantalPersonen, MaxAantalPersonen, Prijs, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd)
            VALUES ('$lesNaam', '$lesDatum', '$lesTijd', '$lesBeschikbaarheid', '$lesMinAantalPersonen', '$lesMaxAantalPersonen', '$lesPrijs', 1, '$lesOpmerking', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Les succesvol toegevoegd!'); window.location.href='lessen.php';</script>";
    } else {
        echo "<script>alert('Er is een fout opgetreden: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg een Les Toe</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="formulier.css">
</head>
<body>
    <div class="container">
        <img src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo" class="logo">
        <h1>Voeg een Les Toe</h1>
        <form method="POST" action="add_lesson.php">
            <div class="mb-3">
                <label for="lesNaam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="lesNaam" name="lesNaam" required>
            </div>
            <div class="mb-3">
                <label for="lesDatum" class="form-label">Datum</label>
                <input type="date" class="form-control" id="lesDatum" name="lesDatum" required>
            </div>
            <div class="mb-3">
                <label for="lesTijd" class="form-label">Tijd</label>
                <input type="time" class="form-control" id="lesTijd" name="lesTijd" required>
            </div>
            <div class="mb-3">
                <label for="lesBeschikbaarheid" class="form-label">Beschikbaarheid</label>
                <select class="form-select" id="lesBeschikbaarheid" name="lesBeschikbaarheid" required>
                    <option value="Ingepland">Ingepland</option>
                    <option value="Uitgepland">Uitgepland</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="lesMinAantalPersonen" class="form-label">Min Aantal Personen</label>
                <input type="number" class="form-control" id="lesMinAantalPersonen" name="lesMinAantalPersonen" required>
            </div>
            <div class="mb-3">
                <label for="lesMaxAantalPersonen" class="form-label">Max Aantal Personen</label>
                <input type="number" class="form-control" id="lesMaxAantalPersonen" name="lesMaxAantalPersonen" required>
            </div>
            <div class="mb-3">
                <label for="lesPrijs" class="form-label">Prijs</label>
                <input type="number" class="form-control" id="lesPrijs" name="lesPrijs" required>
            </div>
            <div class="mb-3">
                <label for="lesOpmerking" class="form-label">Opmerking</label>
                <textarea class="form-control" id="lesOpmerking" name="lesOpmerking"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Voeg Toe</button>
        </form>
        <a href="lessen.php" class="back-link">Terug naar lessen</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>