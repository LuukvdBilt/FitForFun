<?php
include('config.php');
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

$errorMessage = '';
$display = 'none';

// Load current data if Relatienummer is passed via GET
if (isset($_GET['Relatienummer'])) {
    $relatienummer = $_GET['Relatienummer'];
    $sql = "SELECT * FROM ledenoverzicht WHERE Relatienummer = :relatienummer";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':relatienummer', $relatienummer, PDO::PARAM_STR);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$member) {
        $errorMessage = "Geen lid gevonden.";
        $display = 'flex';
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    $oldRelatienummer = $_POST['oldRelatienummer'];
    $newRelatienummer = $_POST['relatienummer'];
    $newMobiel = $_POST['mobiel'];
    $newEmail = $_POST['email'];
    
    // Check if the new Relatienummer, Mobiel of Email al bestaat voor een ander lid
    $sql = "SELECT * FROM ledenoverzicht 
            WHERE (Relatienummer = :newRelatienummer OR Mobiel = :newMobiel OR Email = :newEmail)
              AND Relatienummer <> :oldRelatienummer";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':newRelatienummer', $newRelatienummer, PDO::PARAM_STR);
    $stmt->bindValue(':newMobiel', $newMobiel, PDO::PARAM_STR);
    $stmt->bindValue(':newEmail', $newEmail, PDO::PARAM_STR);
    $stmt->bindValue(':oldRelatienummer', $oldRelatienummer, PDO::PARAM_STR);
    $stmt->execute();

    if ($conflict = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $errorMessage = "";
        if ($conflict['Relatienummer'] == $newRelatienummer) {
            $errorMessage .= "Relatienummer is al in gebruik door een ander lid. ";
        }
        if ($conflict['Mobiel'] == $newMobiel) {
            $errorMessage .= "Mobiel nummer is al in gebruik door een ander lid. ";
        }
        if ($conflict['Email'] == $newEmail) {
            $errorMessage .= "Email is al in gebruik door een ander lid.";
        }
        $display = 'flex';
    } else {
        // Update the record, including the Relatienummer
        $sql = "UPDATE ledenoverzicht
                    SET Voornaam = :voornaam,
                        Tussenvoegsel = :tussenvoegsel,
                        Achternaam = :achternaam,
                        Mobiel = :mobiel,
                        Email = :email,
                        Relatienummer = :relatienummer
                    WHERE Relatienummer = :oldRelatienummer";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
        $stmt->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
        $stmt->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
        $stmt->bindValue(':mobiel', $_POST['mobiel'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindValue(':relatienummer', $newRelatienummer, PDO::PARAM_STR);
        $stmt->bindValue(':oldRelatienummer', $oldRelatienummer, PDO::PARAM_STR);
        $stmt->execute();

        $display = 'flex';
        header('Refresh:3; url=LedenOverzicht.php');
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lid Gegevens Wijzigen</title>
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
                    <h3>Wijzig lid gegevens:</h3>
                </div>
                <div class="col-3"></div>
            </div>

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <!-- Ensure the form submits to the same file -->
                    <form action="edit.php" method="POST">
                        <input type="hidden" name="oldRelatienummer" value="<?= isset($member['Relatienummer']) ? htmlspecialchars($member['Relatienummer'], ENT_QUOTES) : ''; ?>">
                        <div class="mb-3">
                            <label for="voornaamLid" class="form-label">Voornaam</label>
                            <input name="voornaam" type="text" class="form-control" id="voornaamLid" placeholder="Voornaam van het lid" required value="<?= isset($member['Voornaam']) ? htmlspecialchars($member['Voornaam'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tussenvoegselLid" class="form-label">Tussenvoegsel</label>
                            <input name="tussenvoegsel" type="text" class="form-control" id="tussenvoegselLid" placeholder="Tussenvoegsel van het lid" value="<?= isset($member['Tussenvoegsel']) ? htmlspecialchars($member['Tussenvoegsel'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="achternaamLid" class="form-label">Achternaam</label>
                            <input name="achternaam" type="text" class="form-control" id="achternaamLid" placeholder="Achternaam van het lid" required value="<?= isset($member['Achternaam']) ? htmlspecialchars($member['Achternaam'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="relatienummerLid" class="form-label">Relatienummer</label>
                            <input name="relatienummer" type="text" class="form-control" id="relatienummerLid" placeholder="Relatienummer" required value="<?= isset($member['Relatienummer']) ? htmlspecialchars($member['Relatienummer'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="mobielLid" class="form-label">Mobiel</label>
                            <input name="mobiel" type="text" class="form-control" id="mobielLid" placeholder="Mobiel nummer" required value="<?= isset($member['Mobiel']) ? htmlspecialchars($member['Mobiel'], ENT_QUOTES) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="emailLid" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="emailLid" placeholder="Email adres" required value="<?= isset($member['Email']) ? htmlspecialchars($member['Email'], ENT_QUOTES) : ''; ?>">
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
