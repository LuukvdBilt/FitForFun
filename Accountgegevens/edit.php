<?php
include('config.php');
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

$errorMessage = '';
$display = 'none';

// Load current data if Nummer is passed via GET
if (isset($_GET['Nummer'])) {
    $nummer = $_GET['Nummer'];
    $sql = "SELECT * FROM LedenOverzicht WHERE Nummer = :nummer";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nummer', $nummer, PDO::PARAM_STR);
    $stmt->execute();
    $lid = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$lid) {
        $errorMessage = "Geen lid gevonden.";
        $display = 'flex';
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    $oldNummer = $_POST['oldNummer'];
    $newNummer = $_POST['nummer'];

    // Check if the new Nummer already exists for another member
    $sql = "SELECT * FROM LedenOverzicht 
            WHERE Nummer = :newNummer AND Nummer <> :oldNummer";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':newNummer', $newNummer, PDO::PARAM_STR);
    $stmt->bindValue(':oldNummer', $oldNummer, PDO::PARAM_STR);
    $stmt->execute();

    if ($conflict = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $errorMessage = "Nummer is al in gebruik door een ander lid.";
        $display = 'flex';
    } else {
        // Update the record, including the new fields
        $sql = "UPDATE LedenOverzicht
                    SET Voornaam = :voornaam,
                        Tussenvoegsel = :tussenvoegsel,
                        Achternaam = :achternaam,
                        Nummer = :nummer,
                        username = :username,
                        Mobiel = :mobiel,
                        Email = :email
                    WHERE Nummer = :oldNummer";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
        $stmt->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
        $stmt->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
        $stmt->bindValue(':nummer', $newNummer, PDO::PARAM_STR);
        $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $stmt->bindValue(':mobiel', $_POST['mobiel'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindValue(':oldNummer', $oldNummer, PDO::PARAM_STR);
        $stmt->execute();

        $display = 'flex';
        header('Refresh:5; url=../AccountsOverzicht/logout.php');
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lidgegevens Wijzigen</title>
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
                            Gegevens zijn bijgewerkt, u wordt eerst uitgelogd en naar de Homepagina teruggestuurd. Daarna kunt u terug naar accountinstellingen om uw data te bekijken.
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="col-3"></div>
            </div>

            <div class="row mb-1">
                <div class="col-3"></div>
                <div class="col-6 text-primary">
                    <h3>Wijzig lid gegevens:</h3>
                </div>
                <div class="col-3"></div>
            </div>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <!-- Ensure the form submits to the same file -->
                    <form action="edit.php" method="POST">
                        <input type="hidden" name="oldNummer" value="<?= isset($lid['Nummer']) ? htmlspecialchars($lid['Nummer'], ENT_QUOTES) : ''; ?>">
                        <div class="mb-3">
                            <label for="usernameLid" class="form-label">Username</label>
                            <input name="username" type="text" class="form-control" id="usernameLid" placeholder="Username" required value="<?= isset($lid['username']) ? htmlspecialchars($lid['username'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="voornaamLid" class="form-label">Voornaam</label>
                            <input name="voornaam" type="text" class="form-control" id="voornaamLid" placeholder="Voornaam van het lid" required value="<?= isset($lid['Voornaam']) ? htmlspecialchars($lid['Voornaam'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tussenvoegselLid" class="form-label">Tussenvoegsel</label>
                            <input name="tussenvoegsel" type="text" class="form-control" id="tussenvoegselLid" placeholder="Tussenvoegsel van het lid" value="<?= isset($lid['Tussenvoegsel']) ? htmlspecialchars($lid['Tussenvoegsel'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="achternaamLid" class="form-label">Achternaam</label>
                            <input name="achternaam" type="text" class="form-control" id="achternaamLid" placeholder="Achternaam van het lid" required value="<?= isset($lid['Achternaam']) ? htmlspecialchars($lid['Achternaam'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nummerLid" class="form-label">Nummer</label>
                            <input name="nummer" type="text" class="form-control" id="nummerLid" placeholder="Nummer" required value="<?= isset($lid['Nummer']) ? htmlspecialchars($lid['Nummer'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mobielLid" class="form-label">Mobiel</label>
                            <input name="mobiel" type="text" class="form-control" id="mobielLid" placeholder="Mobiel nummer" required value="<?= isset($lid['Mobiel']) ? htmlspecialchars($lid['Mobiel'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="emailLid" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="emailLid" placeholder="Email adres" required value="<?= isset($lid['Email']) ? htmlspecialchars($lid['Email'], ENT_QUOTES) : ''; ?>">
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
