<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <a class="nav-link" href="../Dashboard/Dashboard.php">Management Dashboard</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Uitloggen</a>
          </li>
        </ul>
      </div>
    </div>
    </nav>
        <div class="container">
        <?php
            $mysqli = new mysqli("localhost", "root", "", "FitForFun");
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $result = $mysqli->query("SELECT Voornaam,Tussenvoegsel,Achternaam, Lid_Sinds  FROM LidOverzicht ORDER BY Lid_Sinds DESC");
            if ($result->num_rows > 0) {
                echo str_repeat("<br>", 2);
                echo "<h2 class='mb-3 text-center'>Overzicht van alle Accounts Per Periode</h2><ul class='list-group'>";

                while ($row = $result->fetch_assoc()) {
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<span>" . htmlspecialchars($row['Voornaam'] ) . " " .htmlspecialchars($row['Tussenvoegsel'] ?? '') . " " . htmlspecialchars($row['Achternaam']) . " - Lid sinds: " . htmlspecialchars($row['Lid_Sinds']) . "</span>";
                    echo "<span>";

              
                }
                echo "</ul>";
            } else {
                echo "";
            }
            $mysqli->close();
            ?>
                            
                </div>
            </div>
            </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>