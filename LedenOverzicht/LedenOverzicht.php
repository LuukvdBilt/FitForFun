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
            <a class="nav-link" href="../LesOverzicht/public/lessen.php">Geplande lessen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../AccountsOverzicht/login.php">Management Dashboard</a>
          </li>
        </ul>
 <!-- kijkt of je ingelogd bent of niet, dit geeft ook dan andere displays als 1 van de twee geactiveerd zijn -->
        <?php
            session_start(); 
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

  
  <div class="background">
    <button class="createbutton" onclick="window.location.href='create.php'">Nieuw lid toevoegen</button>
    <button class="searchbutton" onclick="toggleSearch()">zoek op achternaam</button>
    <input type="text" id="searchInput" placeholder="Enter Achternaam" class="search-input" onkeyup="searchTable()" />
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
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php foreach ($result as $row): ?>
        <tr>
          <td><?php echo htmlspecialchars($row->Voornaam); ?></td>
          <td><?php echo htmlspecialchars($row->Tussenvoegsel ?? ''); ?></td>
          <td><?php echo htmlspecialchars($row->Achternaam); ?></td>
          <td><?php echo htmlspecialchars($row->Relatienummer); ?></td>
          <td><?php echo htmlspecialchars($row->Mobiel); ?></td>
          <td><?php echo htmlspecialchars($row->Email); ?></td>
          <td>
            <a href="edit.php?Relatienummer=<?php echo urlencode($row->Relatienummer); ?>" class="btn btn-primary btn-sm">Edit</a>
          </td>
            <td>
              <?php
              // Retrieve the valid pincode from the database once (if not already retrieved)
              if (!isset($validPincode)) {
                $pinStmt = $pdo->query("SELECT Pincode FROM `FitForFun`.`Pincode` LIMIT 1");
                $pinRow = $pinStmt->fetch(PDO::FETCH_OBJ);
                $validPincode = $pinRow ? $pinRow->Pincode : '';
              }
              ?>
              <form action="delete.php" method="POST" onsubmit="var pin = prompt('Voer de pincode in:'); if(pin === '<?php echo htmlspecialchars($validPincode); ?>') { return confirm('Weet je zeker dat je dit lid wilt verwijderen?'); } else { alert('Onjuiste pincode'); return false; }">
              <input type="hidden" name="Relatienummer" value="<?php echo htmlspecialchars($row->Relatienummer); ?>">
              <button type="submit" class="btn btn-danger btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                </svg>
              </button>
              </form>
            </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>