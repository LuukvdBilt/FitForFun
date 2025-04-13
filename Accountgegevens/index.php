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
    
    <div class="container mt-4">
        <div id="accounts-list">
            <?php
            if (isset($_SESSION['username'])) {
                $stmt = $pdo->prepare("SELECT * FROM LedenOverzicht WHERE username = :username");
                $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    echo "<ul class='list-group mb-3'>";
                    echo "<li class='list-group-item'><strong>Gebruikersnaam:</strong> " . htmlspecialchars($row['username']) . "</li>";
                    echo "<li class='list-group-item'><strong>Volledige naam:</strong> " . htmlspecialchars($row['Voornaam']) 
                    . " " . 
                     (!empty($row['Tussenvoegsel']) ? htmlspecialchars($row['Tussenvoegsel']) 
                     . " " : "") . 
                     htmlspecialchars($row['Achternaam']) . "</li>";
                    echo "<li class='list-group-item'><strong>Mobiel:</strong> " . htmlspecialchars($row['Mobiel']) . "</li>";
                    echo "<li class='list-group-item'><strong>Email:</strong> " . htmlspecialchars($row['Email']) . "</li>";
                    echo "<li class='list-group-item'><strong>Lid sinds:</strong> " . htmlspecialchars($row['Lid_Sinds']) . "</li>";
                    echo "<li class='list-group-item'><strong>Rol:</strong> " . htmlspecialchars($row['rol']) . "</li>";
                    echo "<li class='list-group-item text-center'>";
                    echo "<a href='edit.php?Nummer=" . htmlspecialchars($row['Nummer']) . "' class='btn btn-primary me-2'>Wijzigen</a>";
                    echo "<a href='delete.php?Nummer=" . htmlspecialchars($row['Nummer']) . "' class='btn btn-danger'>Verwijderen</a>";
                    echo "</li>";
                    echo "</ul>";
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
