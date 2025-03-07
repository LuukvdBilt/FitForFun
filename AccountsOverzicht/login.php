<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mysqli = new mysqli("localhost", "root", "", "Fitforfun");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <img class="logo"
          src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png"
          alt="FitForFun Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="../Homepagina/index.php">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="../AanbiedingenPagina/aanbiedingen.php">Aanbiedingen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../lessonkalender/lessen.php">Geplande lessen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../AccountsOverzicht/login.php">Overzicht</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Register</a>
          </li>
        </ul>
      </div>
    </div>

</nav>

    <?php if (!isset($_SESSION['username'])) : ?>
        <div class="containerlogin">
          
        <form action="login.php" method="POST">
          <img class="logo" 
          src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" 
          alt="FitForFun Logo">
          <br>
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required><br>
                <br>
                <input type="submit" value="Inloggen">
            </form>

            <?php elseif (isset($_SESSION['username'])) : ?>
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
            




        <?php endif; ?>
    </div>
    <script src="script.js"></script>
</body>
</html>