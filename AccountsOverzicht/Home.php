<?php
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
            

            if (isset($_SESSION['role']) && $_SESSION['role'] == 'Werker') {

                $mysqli = new mysqli("localhost", "root", "", "accounts_overzicht");
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }


                $result = $mysqli->query("SELECT * FROM users");

                echo "<h2>Overzicht van alle Accounts</h2><ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['username'] . " - " . $row['role'] . "</li>";
                }
                echo "</ul>";

                $mysqli->close();
            }
            ?>
        </div>
    </div>
</body>

</html>