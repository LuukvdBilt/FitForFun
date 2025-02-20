<?php
session_start();

// 1. Controleer of de pagina al eerder geladen is
if (!isset($_SESSION['page_loaded'])) {
    // Eerste keer: zet de vlag
    $_SESSION['page_loaded'] = true;
    // Voer de normale logica uit
} else {
    // 2. Als de pagina al eens geladen is, vernietig de sessie en redirect
    session_destroy();
    header("Location: login.php");
    exit;
}

// Je login-logica (en db-verbinding) blijft actief
require 'login.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts Overzicht</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welkom bij het Accounts Overzicht</h1>
        <div id="accounts-list">
            <?php
            // LET OP: Zorg dat $mysqli (db-verbinding) beschikbaar is.
            // Mogelijk heb je dit in login.php of elders geregeld.
            // Hier gaan we ervan uit dat de verbinding al bestaat via $mysqli.

            $result = $mysqli->query("SELECT username, role FROM users");

            if ($result->num_rows > 0) {
                echo "<h2>Overzicht van alle Accounts</h2><ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['username'] . " - " . $row['role'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "Geen accounts gevonden in de database.";
            }

            $mysqli->close();
            ?>
        </div>
    </div>
</body>
</html>
