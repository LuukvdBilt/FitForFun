<?php
// LedenOverzicht.php
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
$pdo = new PDO($dsn, $dbUser, $dbPass);

$sql = "SELECT  LDOZ.Voornaam,
                                        LDOZ.Tussenvoegsel,
                                        LDOZ.Achternaam,
                                        LDOZ.Relatienummer,
                                        LDOZ.Mobiel,
                                        LDOZ.Email
                                FROM ledenoverzicht AS LDOZ
                                ORDER BY LDOZ.Voornaam DESC";

$statement = $pdo->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);
//test
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Leden Overzicht</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <a class="nav-link" href="../Geplande-lessen/index.php">Geplande lessen</a>
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
            <a class="nav-link" href="PerPeriode/AccountPerPeriode.php">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="background">
  <button class="createbutton" onclick="window.location.href='create.php'">Nieuw lid toevoegen</button>
  <button class="searchbutton" onclick="toggleSearch()">zoek op achternaam</button>
  <input type="text" id="searchInput" placeholder="Enter Achternaam" class="search-input" onkeyup="searchTable()"/>
  <div id="noResultsAlert" class="alert alert-danger" role="alert" style="display: none;">
    <span>Geen overeenkomende achternaam gevonden.</span>
  </div>

    <h1>Leden Overzicht</h1>
    <table border="1">
      <tr>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Relatienummer</th>
        <th>Mobiel</th>
        <th>Email</th>
      </tr>
      <?php foreach ($result as $row): ?>
        <tr>
          <td><?php echo htmlspecialchars($row->Voornaam); ?></td>
          <td><?php echo htmlspecialchars($row->Tussenvoegsel ?? ''); ?></td>
          <td><?php echo htmlspecialchars($row->Achternaam); ?></td>
          <td><?php echo htmlspecialchars($row->Relatienummer); ?></td>
          <td><?php echo htmlspecialchars($row->Mobiel); ?></td>
          <td><?php echo htmlspecialchars($row->Email); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>