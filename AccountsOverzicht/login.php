<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mysqli = new mysqli("localhost", "root", "", "accounts_overzicht");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && ($user['role'] == 'Medewerker' || $user['role'] == 'Administrator') && $user['password'] == $password) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $stmt->close();
        $mysqli->close();
        header("Location: Home.php");
        exit;
    } else if ($user && ($user['role'] == "GastGebruiker" || $user['role'] == "Lid") && $user['password'] == $password) {
        $_SESSION['error_message'] = "<span style='color: red;'>U heeft geen toegang tot deze pagina.</span>";
        $stmt->close();
        $mysqli->close();
        header("Location: login.php");
        exit;
    } else { 
        $_SESSION['error_message2'] = "<span style='color: red;'>Onjuiste gebruikersnaam of wachtwoord.</span>";
        $stmt->close();
        $mysqli->close();
        header("Location: login.php");
        exit;
    }
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
<?php if (!isset($_SESSION['username'])): ?>
    <div class="containerlogin">
    <?php
    
    if (isset($_SESSION['error_message'])) {
        echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']); 
    }

    if (isset($_SESSION['error_message2'])) {
        echo "<div class='error-message'>" . $_SESSION['error_message2'] . "</div>";
        unset($_SESSION['error_message2']); 
    }
    ?>

   
        <form action="login.php" method="POST">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Inloggen">
        </form>
    <?php endif; ?>
    </div>
    <script src="script.js"></script>
</body>
</html>
