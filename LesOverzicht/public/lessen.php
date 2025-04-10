<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlLes = "SELECT Id, Naam, Datum, Tijd, Beschikbaarheid, MinAantalPersonen, MaxAantalPersonen, Prijs, Opmerking FROM Les WHERE Isactief = 1";
$resultLes = $conn->query($sqlLes);

$sqlReservering = "SELECT r.Id, r.Voornaam, r.Tussenvoegsel, r.Achternaam, r.Opmerking, r.Datum, r.Tijd, r.Reserveringstatus, l.Naam as LesNaam FROM Reservering r JOIN Les l ON r.LesId = l.Id WHERE r.Isactief = 1";
$resultReservering = $conn->query($sqlReservering);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="index.php">
            <img class="logo" src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo">
        </a>
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link active" href="lessen.php">Geplande lessen</a></li>
        </ul>
        <div class="nav-dropdown">
            <a class="nav-link" href="#">Menu</a>
            <div class="dropdown-content">
                <a href="profiel.php">Profiel</a>
                <a href="logout.php" class="text-danger">Uitloggen</a>
            </div>
        </div>
        <div class="nav-hamburger">
            <span></span><span></span><span></span>
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
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php
           if ($resultLes && $resultLes->num_rows > 0) {
            while($row = $resultLes->fetch_assoc()) {
                $opmerking = $row["Opmerking"] ?? 'Geen opmerking';
                echo "<tr data-toggle='tooltip' title='" . htmlspecialchars($opmerking, ENT_QUOTES, 'UTF-8') . "'>";
                echo "<td>" . $row["Naam"] . "</td>";
                echo "<td>" . $row["Datum"] . "</td>";
                echo "<td>" . $row["Beschikbaarheid"] . "</td>";
                echo "<td>" . $row["MinAantalPersonen"] . "</td>";
                echo "<td>" . $row["MaxAantalPersonen"] . "</td>";
                echo "<td>" . $row["Prijs"] . "</td>";
                echo "<td>
                        <a href='wijzigen_lesson.php?id=" . $row["Id"] . "' class='text-primary' title='Wijzig les'>
                            <i class='bi bi-pencil-square fs-5'></i>
                        </a>
                        <form action='delete_lesson.php' method='POST' onsubmit='return confirm(\"Weet je zeker dat je deze les wilt verwijderen?\")' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row["Id"] . "' />
                            <button type='submit' class='btn btn-danger' title='Verwijder les'>
                                <i class='bi bi-trash'></i>
                            </button>
                        </form>
                      </td>";
                echo "</tr>";
            }
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
                while ($row = $resultReservering->fetch_assoc()) {
                    echo '<div class="reservation d-flex justify-content-between align-items-start">';
                    echo '<div>';
                    echo '<h3>' . htmlspecialchars($row["Voornaam"] . ' ' . $row["Tussenvoegsel"] . ' ' . $row["Achternaam"], ENT_QUOTES, 'UTF-8') . '</h3>';
                    echo '<p><strong>Les:</strong> ' . htmlspecialchars($row["LesNaam"], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '<p><strong>Opmerking:</strong> ' . htmlspecialchars($row["Opmerking"], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '<p><strong>Datum:</strong> ' . htmlspecialchars($row["Datum"], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '<p><strong>Tijd:</strong> ' . htmlspecialchars($row["Tijd"], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '<p><strong>Status:</strong> ' . htmlspecialchars($row["Reserveringstatus"], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '</div>';
                    echo '<div class="ms-3 mt-2 d-flex gap-2">
                    <a href="wijzigen_reservering.php?id=' . $row["Id"] . '" class="text-primary" title="Wijzig reservering">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </a>
                    <a href="verwijder_reservering.php?id=' . $row["Id"] . '" class="text-danger" title="Verwijder reservering" onclick="return confirm(\'Weet je zeker dat je deze reservering wilt verwijderen?\')">
                        <i class="bi bi-trash fs-5"></i>
                    </a>
                </div>';
                
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>
</html>

<?php
if (isset($conn)) {
    $conn->close();
}
?>
