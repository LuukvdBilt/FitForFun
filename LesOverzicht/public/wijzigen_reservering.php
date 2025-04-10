<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the reservation details
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $sql = "SELECT * FROM Reservering WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservation = $result->fetch_assoc();
    $stmt->close();

    if (!$reservation) {
        die("Reservering niet gevonden.");
    }
} else {
    die("Geen reserverings-ID opgegeven.");
}

// Update the reservation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $voornaam = $_POST['voornaam'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam = $_POST['achternaam'];
    $datum = $_POST['datum'];
    $tijd = $_POST['tijd'];
    $opmerking = $_POST['opmerking'];
    $status = $_POST['status'];

    $sql = "UPDATE Reservering SET Voornaam = ?, Tussenvoegsel = ?, Achternaam = ?, Datum = ?, Tijd = ?, Opmerking = ?, Reserveringstatus = ? WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $voornaam, $tussenvoegsel, $achternaam, $datum, $tijd, $opmerking, $status, $id);

    if ($stmt->execute()) {
        header("Location: lessen.php?success=1");
        exit();
    } else {
        echo "Er is een fout opgetreden: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Reservering Bewerken</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="formulier.css">
</head>
<body>
<div class="container mt-5">
    <img src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo" class="logo mb-4">
    <h1 class="mb-4">Reservering Bewerken</h1>

    <form method="POST" action="wijzigen_reservering.php?id=<?php echo $reservation['Id']; ?>">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($reservation['Id']); ?>">

        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam</label>
            <input type="text" class="form-control" id="voornaam" name="voornaam" value="<?php echo htmlspecialchars($reservation['Voornaam']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
            <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" value="<?php echo htmlspecialchars($reservation['Tussenvoegsel']); ?>">
        </div>

        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="achternaam" name="achternaam" value="<?php echo htmlspecialchars($reservation['Achternaam']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="datum" class="form-label">Datum</label>
            <input type="date" class="form-control" id="datum" name="datum" value="<?php echo htmlspecialchars($reservation['Datum']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="tijd" class="form-label">Tijd</label>
            <input type="time" class="form-control" id="tijd" name="tijd" value="<?php echo htmlspecialchars($reservation['Tijd']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="opmerking" class="form-label">Opmerking</label>
            <textarea class="form-control" id="opmerking" name="opmerking"><?php echo htmlspecialchars($reservation['Opmerking']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="<?php echo htmlspecialchars($reservation['Reserveringstatus']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="lessen.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
