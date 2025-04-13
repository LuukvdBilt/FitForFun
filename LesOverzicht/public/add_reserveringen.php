<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connectie mislukt: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voornaam = $_POST['voornaam'] ?? '';
    $tussenvoegsel = $_POST['tussenvoegsel'] ?? '';
    $achternaam = $_POST['achternaam'] ?? '';
    $nummer = rand(100000000, 999999999);
    $lesId = $_POST['les'] ?? '';
    $datum = $_POST['datum'] ?? '';
    $tijd = $_POST['tijd'] ?? '';
    $opmerking = $_POST['opmerking'] ?? '';

    $stmt = $conn->prepare("INSERT INTO Reservering 
        (Voornaam, Tussenvoegsel, Achternaam, Nummer, LesId, Datum, Tijd, Reserveringstatus, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Gereserveerd', 1, ?, NOW(), NOW())");

    $stmt->bind_param("sssissss", $voornaam, $tussenvoegsel, $achternaam, $nummer, $lesId, $datum, $tijd, $opmerking);

    if ($stmt->execute()) {
        echo "<script>alert('Reservering succesvol!'); window.location.href='lessen.php';</script>";
    } else {
        echo "<script>alert('Fout bij reserveren: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$sqlLes = "SELECT Id, Naam, Datum, Tijd FROM Les WHERE Isactief = 1";
$resultLes = $conn->query($sqlLes);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Maak een Reservering</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
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
                        while ($row = $resultLes->fetch_assoc()) {
                            echo "<option value='" . $row["Id"] . "' data-datum='" . $row["Datum"] . "' data-tijd='" . $row["Tijd"] . "'>" .
                                htmlspecialchars($row["Naam"]) . " op " . $row["Datum"] . " om " . $row["Tijd"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="datum" class="form-label">Datum</label>
                <input type="date" class="form-control" id="datum" name="datum" readonly required>
            </div>

            <div class="mb-3">
                <label for="tijd" class="form-label">Tijd</label>
                <input type="time" class="form-control" id="tijd" name="tijd" readonly required>
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
                <textarea class="form-control" id="opmerking" name="opmerking" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Reserveer</button>
        </form>

        <a href="lessen.php" class="back-link">← Terug naar lessen</a>
    </div>

    <script>
        function updateLesDetails() {
            const select = document.getElementById('les');
            const datum = select.options[select.selectedIndex].getAttribute('data-datum');
            const tijd = select.options[select.selectedIndex].getAttribute('data-tijd');
            document.getElementById('datum').value = datum;
            document.getElementById('tijd').value = tijd;
        }
    </script>
</body>
</html>
