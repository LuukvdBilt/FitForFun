<?php
// Databaseverbinding
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindingscheck
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Haal les op
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $sql = "SELECT * FROM Les WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $les = $result->fetch_assoc();
    $stmt->close();

    if (!$les) {
        die("Les niet gevonden.");
    }
} else {
    die("Geen les-ID opgegeven.");
}

// Werk de les bij
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $naam = $_POST["naam"];
    $datum = $_POST["datum"];
    $tijd = $_POST["tijd"];
    $beschikbaarheid = $_POST["beschikbaarheid"];
    $minAantalPersonen = $_POST["minAantalPersonen"];
    $maxAantalPersonen = $_POST["maxAantalPersonen"];
    $prijs = $_POST["prijs"];

    $sql = "UPDATE Les SET Naam = ?, Datum = ?, Tijd = ?, Beschikbaarheid = ?, MinAantalPersonen = ?, MaxAantalPersonen = ?, Prijs = ? WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiii", $naam, $datum, $tijd, $beschikbaarheid, $minAantalPersonen, $maxAantalPersonen, $prijs, $id);

    if ($stmt->execute()) {
        header("Location: lessen.php?success=1");
        exit();
    } else {
        echo "Fout bij bijwerken: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Les Wijzigen</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="formulier.css">
</head>
<body>
    <div class="container mt-5">
    <img src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo" class="logo">    
        <h1 class="mb-4">Les Wijzigen</h1>

        <form method="POST" action="wijzigen_lesson.php?id=<?php echo $les['Id']; ?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($les['Id']); ?>">

            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="naam" name="naam" value="<?php echo htmlspecialchars($les['Naam']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="datum" class="form-label">Datum</label>
                <input type="date" class="form-control" id="datum" name="datum" value="<?php echo htmlspecialchars($les['Datum']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="tijd" class="form-label">Tijd</label>
                <input type="time" class="form-control" id="tijd" name="tijd" value="<?php echo htmlspecialchars($les['Tijd']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="beschikbaarheid" class="form-label">Beschikbaarheid</label>
                <input type="text" class="form-control" id="beschikbaarheid" name="beschikbaarheid" value="<?php echo htmlspecialchars($les['Beschikbaarheid']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="minAantalPersonen" class="form-label">Minimaal aantal personen</label>
                <input type="number" class="form-control" id="minAantalPersonen" name="minAantalPersonen" value="<?php echo htmlspecialchars($les['MinAantalPersonen']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="maxAantalPersonen" class="form-label">Maximaal aantal personen</label>
                <input type="number" class="form-control" id="maxAantalPersonen" name="maxAantalPersonen" value="<?php echo htmlspecialchars($les['MaxAantalPersonen']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="prijs" class="form-label">Prijs (€)</label>
                <input type="number" step="0.01" class="form-control" id="prijs" name="prijs" value="<?php echo htmlspecialchars($les['Prijs']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
            <a href="lessen.php" class="btn btn-secondary">Annuleren</a>
        </form>
    </div>
</body>
</html>
