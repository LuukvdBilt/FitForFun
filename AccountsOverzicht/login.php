<?php
session_start();

// Verbinding maken met de database
$mysqli = new mysqli("localhost", "root", "", "accounts_overzicht");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Zoek gebruiker op
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Controleer of de gebruiker bestaat en of het wachtwoord klopt
    if ($user && $user['password'] == $password) {
        // Start sessie en sla rol op
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: Home.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Ongeldige gebruikersnaam of wachtwoord.";
        header("Location: login.php");
        exit;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="containerlogin">
    <?php
    if (isset($_SESSION['error_message'])) {
        
        echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
        echo "<script>
            setTimeout(function() {
                document.querySelector('.error-message').style.display = 'none';
            }, 2000);
              </script>";
              unset($_SESSION['error_message']);
    }
    ?>
    <form action="login.php" method="POST">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Inloggen">
    </form>
    </div>
</body>
</html>
