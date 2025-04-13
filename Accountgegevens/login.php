<?php
session_start();


$mysqli = new mysqli("localhost", "root", "", "Fitforfun");

if ($mysqli->connect_error) {
    die("Connection failed: {$mysqli->connect_error}");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT * FROM LedenOverzicht WHERE Username = ?");
    $stmt->bind_param("s", $username); 
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && (($user['rol'] == 'Medewerker' || $user['rol'] == 'Administrator') || ($user['rol'] == 'Lid' && $user['password'] == $password))) {
        $stmt = $mysqli->prepare("SELECT * FROM LedenOverzicht WHERE Username = ?");
        $_SESSION['username'] = $user['username'];
        $_SESSION['Voornaam'] = $user['Voornaam'];
        $_SESSION['Tussenvoegsel'] = $user['Tussenvoegsel'];
        $_SESSION['Achternaam'] = $user['Achternaam'];
        $_SESSION['Relatienummer'] = $user['Relatienummer'];
        $_SESSION['Mobiel'] = $user['Mobiel'];
        $_SESSION['Email'] = $user['Email'];
        $_SESSION['Lid_Sinds'] = $user['Lid_Sinds'];
        $_SESSION['rol'] = $user['rol'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id'];
        $stmt->close();
        $mysqli->close();
        header("Location: index.php");
        
        exit;
    } 
    else {
        $_SESSION['error_message'] = "<span style='color: red;'>Ongeldige gebruikersnaam of wachtwoord.</span>";
        header("Refresh: 2; url=login.php");
        $stmt->close();
        $mysqli->close();
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
            <a class="nav-link" href="../LesOverzicht/public/lessen.php">Geplande lessen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../AccountsOverzicht/login.php">Management Dashboard</a>
          </li>
          
            </ul>
     <!-- kijkt of je ingelogd bent of niet, dit geeft ook dan andere displays als 1 van de twee geactiveerd zijn -->
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
              echo '<ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="../Accountgegevens/index.php">Accountinstellingen</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../AccountsOverzicht/logout.php">Uitloggen</a>
                  </li>
                  </ul>';
            } else {
              echo '<ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="../AccountsOverzicht/login.php">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../PerPeriode/create.php">Register</a>
                  </li>
                  </ul>';
            }
            ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
      echo '
        <div class="containerlogin">
          <form action="login.php" method="POST">
            <img class="logo" 
            src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" 
            alt="FitForFun Logo">
            <br>
            <h4>beveiligingscontrole</h4>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required><br>
            <br>
            <input type="submit" value="Inloggen">
          </form>
        </div>
      ';}
        if (isset($_SESSION['error_message'])) {
          echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
          unset($_SESSION['error_message']);
        }

        ?>
      </div>
    
    <script src="script.js"></script>
</body>
</html>