<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Management Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <h1>Management Dashboard</h1>
<?php
 echo str_repeat("<br>", 2);
?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <div class="list-group">
          <a href="../AccountsOverzicht/login.php" class="list-group-item list-group-item-action">Accounts Overzicht</a>
          <a href="#" class="list-group-item list-group-item-action">Overzicht aantal leden per periode</a>
          <a href="../medewerkeroverzicht/MedewerkerOverzicht.php" class="list-group-item list-group-item-action">Medewerker Overzicht</a>
        </div>
      </div>
      <div class="col-4"></div>

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
            <a class="nav-link nav-link-Home" href="../Homepagina/index.php">Home</a>
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
                <a class="nav-link" href="#">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>

</html>