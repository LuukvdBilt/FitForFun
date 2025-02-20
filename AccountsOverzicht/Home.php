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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head> 

<body>
    <div class="container mt-4">
        <h1>Welkom bij het Accounts Overzicht</h1>
        <div id="accounts-list">
            <?php
            $result = $mysqli->query("SELECT username, role FROM users");
            if ($result->num_rows > 0) {
                echo "<h2 class='mb-3'>Overzicht van alle Accounts</h2><ul class='list-group'>";

                while ($row = $result->fetch_assoc()) {
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<span>" . htmlspecialchars($row['username']) . " - " . htmlspecialchars($row['role']) . "</span>";
                    echo "<span>";
                    echo "<button class='btn btn-primary btn-sm me-2' onclick=\"window.location.href='update.php?username=" . urlencode($row['username']) . "'\">Bewerken</button>";

                    echo "<button class='btn btn-danger btn-sm' onclick=\"window.location.href='delete.php?username=" . urlencode($row['username']) . "'\">Verwijderen</button>";

                    echo "</span>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<div class='alert alert-warning'>Geen accounts gevonden in de database.</div>";
            }
            $mysqli->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>