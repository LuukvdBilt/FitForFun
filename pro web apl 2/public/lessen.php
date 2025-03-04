<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitforfun";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query for Les Overzicht
$sqlLes = "SELECT Id, Naam, Datum, Tijd, Beschikbaarheid, MinAantalPersonen, MaxAantalPersonen FROM Les WHERE Isactief = 1";
$resultLes = $conn->query($sqlLes);

// SQL query for Reservering Overzicht
$sqlReservering = "SELECT Id, Voornaam, Tussenvoegsel, Achternaam, Datum, Tijd, Reserveringstatus FROM Reservering WHERE Isactief = 1";
$resultReservering = $conn->query($sqlReservering);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="calendersheet.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="index.php">
            <img class="logo" src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo">
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="lessen.php">Geplande lessen</a>
            </li>
        </ul>
        <div class="nav-dropdown">
            <a class="nav-link" href="#">Menu</a>
            <div class="dropdown-content">
                <a href="profiel.php">Profiel</a>
                <a href="logout.php" class="text-danger">Uitloggen</a>
            </div>
        </div>
        <div class="nav-hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    
        <div class="container mt-5">
    <h1 class="text-center mb-4">Les Overzicht</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Datum</th>
                <th>Tijd</th>
                <th>Beschikbaarheid</th>
                <th>Min Aantal Personen</th>
                <th>Max Aantal Personen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultLes && $resultLes->num_rows > 0) {
                while($row = $resultLes->fetch_assoc()) {
                    echo "<tr><td>" . $row["Id"]. "</td><td>" . $row["Naam"]. "</td><td>" . $row["Datum"]. "</td><td>" . $row["Tijd"]. "</td><td>" . $row["Beschikbaarheid"]. "</td><td>" . $row["MinAantalPersonen"]. "</td><td>" . $row["MaxAantalPersonen"]. "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Geen lessen gevonden</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h1 class="text-center mb-4 mt-5">Reservering Overzicht</h1>
    <div class="reservations">
        <?php
        if ($resultReservering && $resultReservering->num_rows > 0) {
            while($row = $resultReservering->fetch_assoc()) {
                echo '<div class="reservation">';
                echo '<h3>' . $row["Voornaam"] . ' ' . $row["Achternaam"] . '</h3>';
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


    <script src="script.js"></script>
    <script type="module" src="calendar.js"></script>
</body>
</html>

<?php
// Close the database connection
if (isset($conn)) {
    $conn->close();
}
?>
