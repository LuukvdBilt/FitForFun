````<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FitForFun";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query for Les Overzicht
$sqlLes = "SELECT Id, Naam, Datum, Tijd, Beschikbaarheid, MinAantalPersonen, MaxAantalPersonen, Prijs, Opmerking FROM Les WHERE Isactief = 1";
$resultLes = $conn->query($sqlLes);

// SQL query for Reservering Overzicht
$sqlReservering = "SELECT r.Id, r.Voornaam, r.Tussenvoegsel, r.Achternaam, r.Opmerking, r.Datum, r.Tijd, r.Reserveringstatus, l.Naam as LesNaam FROM Reservering r JOIN Les l ON r.LesId = l.Id WHERE r.Isactief = 1";
$resultReservering = $conn->query($sqlReservering);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="calendersheet.css">
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
            <a class="nav-link" href="../../Homepagina/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../AanbiedingenPagina/aanbiedingen.php">Aanbiedingen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../LesOverzicht/public/lessen.php">Geplande lessen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../AccountsOverzicht/login.php">Management Dashboard</a>
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

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Les Overzicht</h1>
            <a href="add_lesson.php" class="btn btn-warning">Voeg een Les Toe</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Datum</th>
                    <th>Beschikbaarheid</th>
                    <th>Min Aantal Personen</th>
                    <th>Max Aantal Personen</th>
                    <th>Prijs</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultLes && $resultLes->num_rows > 0) {
                    while($row = $resultLes->fetch_assoc()) {
                        $opmerking = $row["Opmerking"] ?? 'Geen opmerking';
                        echo "<tr data-toggle='tooltip' title='" . htmlspecialchars($opmerking, ENT_QUOTES, 'UTF-8') . "'><td>" . $row["Naam"]. "</td><td>" . $row["Datum"]. "</td><td>" . $row["Beschikbaarheid"]. "</td><td>" . $row["MinAantalPersonen"]. "</td><td>" . $row["MaxAantalPersonen"]. "</td><td>" . $row["Prijs"]. "</td></tr>";
                    }
                    // Reset the result pointer for the dropdown
                    $resultLes->data_seek(0);
                } else {
                    echo "<tr><td colspan='6'>Geen lessen gevonden</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <h1 class="mb-0">Reservering Overzicht</h1>
            <a href="add_reserveringen.php" class="btn btn-warning">Maak een Reservering</a>
        </div>
        <div class="reservations">
            <?php
            if ($resultReservering && $resultReservering->num_rows > 0) {
                while($row = $resultReservering->fetch_assoc()) {
                    echo '<div class="reservation">';
                    echo '<h3>' . $row["Voornaam"] . ' ' . $row["Tussenvoegsel"] . ' ' . $row["Achternaam"] . '</h3>';
                    echo '<p><strong>Les:</strong> ' . $row["LesNaam"] . '</p>';
                    echo '<p><strong>Opmerking:</strong> ' . $row["Opmerking"] . '</p>';
                    echo '<p><strong>Datum:</strong> ' . $row["Datum"] . '</p>';
                    echo '<p><strong>Tijd:</strong> ' . $row["Tijd"] . '</p>';
                    echo '<p><strong>Status:</strong> ' . $row["Reserveringstatus"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>Geen reserveringen gevonden</p>';
            }
            ?>
        </div>

        <div class="calendar mt-5" id="calendar">
            <!-- Calendar days will be inserted here -->
        </div>
    </div>

    <script src="calendar.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>

<?php
// Close the database connection
if (isset($conn)) {
    $conn->close();
}
?>````