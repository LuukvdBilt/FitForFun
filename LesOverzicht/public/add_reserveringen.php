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
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $nummer = rand(100000000, 999999999); // Generate a random number
    $lesId = $_POST['les'];
    $datum = $_POST['datum'];
    $tijd = $_POST['tijd'];
    $opmerking = $_POST['opmerking'];

    // Insert reservation into database
    $sql = "INSERT INTO Reservering (Voornaam, Tussenvoegsel, Achternaam, Nummer, LesId, Datum, Tijd, Reserveringstatus, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd)
            VALUES ('$voornaam', '$tussenvoegsel', '$achternaam', '$nummer', '$lesId', '$datum', '$tijd', 'Gereserveerd', 1, '$opmerking', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reservering succesvol!'); window.location.href='lessen.php';</script>";
    } else {
        echo "<script>alert('Er is een fout opgetreden: " . $conn->error . "');</script>";
    }
}

// SQL query for Les dropdown
$sqlLes = "SELECT Id, Naam, Datum, Tijd FROM Les WHERE Isactief = 1";
$resultLes = $conn->query($sqlLes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maak een Reservering</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="formulier.css">
</head>
<body>
    <div class="container">
        <img src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo" class="logo">
        <h1>Maak een Reservering</h1>
        <form method="POST" action="add_reserveringen.php">
            <div class="mb-3">
                <label for="les" class="form-label">Les</label>
                <select class="form-select" id="les" name="les" required onchange="updateLesDetails()">
                    <option value="">Selecteer een les</option>
                    <?php
                    if ($resultLes && $resultLes->num_rows > 0) {
                        while($row = $resultLes->fetch_assoc()) {
                            echo "<option value='" . $row["Id"] . "' data-datum='" . $row["Datum"] . "' data-tijd='" . $row["Tijd"] . "'>" . $row["Naam"] . " op " . $row["Datum"] . " om " . $row["Tijd"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="datum" class="form-label">Datum</label>
                <input type="date" class="form-control" id="datum" name="datum" required readonly>
            </div>
            <div class="mb-3">
                <label for="tijd" class="form-label">Tijd</label>
                <input type="time" class="form-control" id="tijd" name="tijd" required readonly>
            </div>
            <div class="mb-3">
                <label for="voornaam" class="form-label">Voornaam</label>
                <input type="text" class="form-control" id="voornaam" name="voornaam" required>
            </div>
            <div class="mb-3">
                <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
                <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel">
            </div>
            <div class="mb-3">
                <label for="achternaam" class="form-label">Achternaam</label>
                <input type="text" class="form-control" id="achternaam" name="achternaam" required>
            </div>
            <div class="mb-3">
                <label for="opmerking" class="form-label">Opmerking</label>
                <textarea class="form-control" id="opmerking" name="opmerking"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Reserveer</button>
        </form>
        <a href="lessen.php" class="back-link">Terug naar lessen</a>
    </div>

    <script>
        function updateLesDetails() {
            const lesSelect = document.getElementById('les');
            const selectedOption = lesSelect.options[lesSelect.selectedIndex];
            const datum = selectedOption.getAttribute('data-datum');
            const tijd = selectedOption.getAttribute('data-tijd');

            document.getElementById('datum').value = datum;
            document.getElementById('tijd').value = tijd;
        }
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>