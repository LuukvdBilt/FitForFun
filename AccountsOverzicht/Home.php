<?php
session_start();


if (!isset($_SESSION['page_loaded'])) {
    $_SESSION['page_loaded'] = true;
} else {
    session_destroy();
    header("Location: login.php");
    exit;
}

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
