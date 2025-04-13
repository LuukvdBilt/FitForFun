<?php

// connectie met de database en login pagina
require_once 'config.php';
require_once 'login.php';

try {
  $pdo = new PDO('mysql:host=localhost;dbname=Fitforfun', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}
var_dump($_SESSION)

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accountgegevens</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>

  <?php
  echo str_repeat("<br>", 2);
  ?>
  <!-- onze navbar !-->
  <nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <a href="#" class="navbar-brand">
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
    </div>
  </div>
</nav>
    <div class="container col-8 mt-5">
        <h2 class="mb-3">Accountinstellingen</h2>
    
        <!-- Hier komt de code voor het ophalen van de gegevens van de ingelogde gebruiker -->
    
    <div class="container mt-4">
        <div id="accounts-list">
            <?php
            if (isset($_SESSION['user_id'])) {
              $userId = $_SESSION['user_id'];
              $stmt = $mysqli->prepare("SELECT voornaam, tussenvoegsel, achternaam, email, relatienummer FROM LedenOverzicht WHERE id = ?");
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                echo str_repeat("<br>", 2);
                while ($row = $result->fetch_assoc()) {
                  echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";

                  echo "<span>Volledige naam: " . htmlspecialchars($row['voornaam']) 
                  . " " . 
                     (!empty($row['tussenvoegsel']) ? htmlspecialchars($row['tussenvoegsel']) 
                     . " " : "") . 
                     htmlspecialchars($row['achternaam']) . "</span>";

                  echo "<span>Email: " . htmlspecialchars($row['email']) . "</span>";

                  echo "<span>Relatienummer: " . htmlspecialchars($row['relatienummer']) . "</span>";
                  echo "</li>";
                }
              } else {
                echo "Geen gegevens gevonden.";
              }
            } 
            if (isset($stmt)) {
              $stmt->close();
            }
            $mysqli->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>