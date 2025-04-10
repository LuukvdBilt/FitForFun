<?php
include('config.php');
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

$errorMessage = '';
$display = 'none';

// Load current data if Nummer is passed via GET
if (isset($_GET['Nummer'])) {
    $nummer = $_GET['Nummer'];
    $sql = "SELECT * FROM medewerkeroverzicht WHERE Nummer = :nummer";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nummer', $nummer, PDO::PARAM_STR);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$employee) {
        $errorMessage = "Geen medewerker gevonden.";
        $display = 'flex';
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    $oldNummer = $_POST['oldNummer'];
    $newNummer = $_POST['nummer'];
    $newMedewerkersoort = $_POST['medewerkersoort'];

    // Check if the new Nummer or Medewerkersoort already exists for another employee
    $sql = "SELECT * FROM medewerkeroverzicht 
            WHERE Nummer = :newNummer AND Nummer <> :oldNummer";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':newNummer', $newNummer, PDO::PARAM_STR);
    $stmt->bindValue(':oldNummer', $oldNummer, PDO::PARAM_STR);
    $stmt->execute();

    if ($conflict = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $errorMessage = "Nummer is al in gebruik door een andere medewerker.";
        $display = 'flex';
    } else {
        // Update the record, including the Nummer
        $sql = "UPDATE medewerkeroverzicht
                    SET Voornaam = :voornaam,
                        Tussenvoegsel = :tussenvoegsel,
                        Medewerkersoort = :medewerkersoort,
                        Nummer = :nummer
                    WHERE Nummer = :oldNummer";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
        $stmt->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
        $stmt->bindValue(':medewerkersoort', $_POST['medewerkersoort'], PDO::PARAM_STR);
        $stmt->bindValue(':nummer', $newNummer, PDO::PARAM_STR);
        $stmt->bindValue(':oldNummer', $oldNummer, PDO::PARAM_STR);
        $stmt->execute();

        $display = 'flex';
        header('Refresh:3; url=MedewerkerOverzicht.php');
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Medewerker Gegevens Wijzigen</title>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div class="container mt-3">
            <!-- Display messages -->
            <div class="row" style="display:<?= $display; ?>;">
                <div class="col-3"></div>
                <div class="col-6">
                    <?php if ($errorMessage): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $errorMessage ?>
                        </div>
                    <?php else: ?>
                        <?php if (isset($_POST['submit'])): ?>
                        <div class="alert alert-success text-center" role="alert">
                            Gegevens zijn bijgewerkt, u wordt doorgestuurd naar het overzicht.
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="col-3"></div>
            </div>

            <div class="row mb-1">
                <div class="col-3"></div>
                <div class="col-6 text-primary">
                    <h3>Wijzig medewerker gegevens:</h3>
                </div>
                <div class="col-3"></div>
            </div>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <!-- Ensure the form submits to the same file -->
                    <form action="edit.php" method="POST">
                        <input type="hidden" name="oldNummer" value="<?= isset($employee['Nummer']) ? htmlspecialchars($employee['Nummer'], ENT_QUOTES) : ''; ?>">
                        <div class="mb-3">
                            <label for="voornaamMedewerker" class="form-label">Voornaam</label>
                            <input name="voornaam" type="text" class="form-control" id="voornaamMedewerker" placeholder="Voornaam van de medewerker" required value="<?= isset($employee['Voornaam']) ? htmlspecialchars($employee['Voornaam'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tussenvoegselMedewerker" class="form-label">Tussenvoegsel</label>
                            <input name="tussenvoegsel" type="text" class="form-control" id="tussenvoegselMedewerker" placeholder="Tussenvoegsel van de medewerker" value="<?= isset($employee['Tussenvoegsel']) ? htmlspecialchars($employee['Tussenvoegsel'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="achternaamMedewerker" class="form-label">Achternaam</label>
                            <input name="achternaam" type="text" class="form-control" id="achternaamMedewerker" placeholder="Achternaam van de medewerker" required value="<?= isset($employee['Achternaam']) ? htmlspecialchars($employee['Achternaam'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nummerMedewerker" class="form-label">Nummer</label>
                            <input name="nummer" type="text" class="form-control" id="nummerMedewerker" placeholder="Nummer" required value="<?= isset($employee['Nummer']) ? htmlspecialchars($employee['Nummer'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="medewerkersoortMedewerker" class="form-label">Medewerkersoort</label>
                            <input name="medewerkersoort" type="text" class="form-control" id="medewerkersoortMedewerker" placeholder="Medewerkersoort" required value="<?= isset($employee['Medewerkersoort']) ? htmlspecialchars($employee['Medewerkersoort'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="d-grid gap-2">
                            <button name="submit" value="submit" type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
