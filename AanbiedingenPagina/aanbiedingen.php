<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Aanbiedingen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FitForFun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
    rel="stylesheet">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <img class="logo"
              src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png"
              alt="">
            <ul class="navbar-nav me-auto">
              <li class="nav-item"></li>
              <a class="nav-link" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="aanbiedingen.html">Aanbiedingen</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="lessen.html">Geplande lessen</a>
              </li>
              <li>
                <a class="nav-link" href="overzicht.html">Overzicht</a>
              </li>
            </ul>
            <ul class="navbar-nav">
              <a class="nav-link" href="#"><i class="bi bi-cart"></i> Winkelwagen</a>
              <a class="nav-link" href="#">Login</a>
              </li>
              <li>
                <a class="nav-link" href="#">Register</a>
              </li>
            </ul>
          </div>
      </div>
      </nav>
    </div>
  </div>
  </div>
  <h1 class="h1">Aanbiedingen</h1>
  <div class="row">
    <?php

    $sql = "SELECT beschrijving, prijs, kortingsprijs FROM Aanbiedingen";
    $result = $conn->query($sql);

    $emojiArray = [
      "🏋️‍♂️",
      "📌",
      "🏃‍♀️",
      "🎁",
      "🚴",
      "🛒"
    ];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $beschrijving = $row["beschrijving"];
        foreach ($emojiArray as $emoji) {
          $beschrijving = str_replace($emoji, $emoji . "<br>", $beschrijving);
        }
        echo "<div class='col'>";
        echo "  <div class='card'>";
        echo "    <h4>" . $beschrijving . "</h4>";
        echo "    <p class='line'>€" . $row["prijs"] . "</p>";
        echo "    <p>€" . $row["kortingsprijs"] . "</p>";
        echo "    <button class='btn'>Voeg aanbieding toe</button>";
        echo "  </div>";
        echo "</div>";
      }
    } else {
      echo "geen aanbiedingen gevonden";
    }
    $conn->close();

    ?>
  </div>
  <strong>
    <h2 class="WARNING">LET OP: je kunt maar 1 aanbieding gebruiken!</h2>
  </strong>
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>