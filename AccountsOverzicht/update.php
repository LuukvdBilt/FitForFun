<?php
session_start();
require 'config.php';

$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);


if (!isset($_GET['username'])) {
    header("Location: Home.php");
    exit;
}

$username = $_GET['username'];


$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['message'] = "Gebruiker niet gevonden.";
    header("Location: Home.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['newUsername'];
    $newRole = $_POST['role'];


    $updateSql = "UPDATE users SET username = :newUsername, role = :newRole WHERE username = :oldUsername";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
    $updateStmt->bindParam(':newRole', $newRole, PDO::PARAM_STR);
    $updateStmt->bindParam(':oldUsername', $username, PDO::PARAM_STR);

    if ($updateStmt->execute()) {
        $_SESSION['message'] = "Gebruiker succesvol bijgewerkt.";
        header("Location: Home.php");
        exit;
    } else {
        $_SESSION['message'] = "Er is een fout opgetreden bij het bijwerken.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Gebruiker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Bewerk Gebruiker</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="newUsername" class="form-label">Gebruikersnaam:</label>
                <input type="text" class="form-control" id="newUsername" name="newUsername"
                    value="<?= htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rol:</label>
                <select class="form-control" id="role" name="role">
                    <option value="Administrator" <?= $user['role'] == "Administrator" ? "selected" : ""; ?>>Administrator
                    </option>
                    <option value="Medewerker" <?= $user['role'] == "Medewerker" ? "selected" : ""; ?>>Medewerker</option>
                    <option value="Lid" <?= $user['role'] == "Lid" ? "selected" : ""; ?>>Lid</option>
                    <option value="GastGebruiker" <?= $user['role'] == "GastGebruiker" ? "selected" : ""; ?>>GastGebruiker
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Opslaan</button>
            <a href="Home.php" class="btn btn-secondary">Annuleren</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>