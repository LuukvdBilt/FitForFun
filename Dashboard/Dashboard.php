

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
  <br>
  <br>
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
    </div>
  </div>
</nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <div class="list-group">
          <!-- linking naar de Overzichten !-->
          <a href="../AccountsOverzicht/Home.php" class="list-group-item list-group-item-action">Accounts Overzicht</a>
          <a href="../PerPeriode/AccountPerPeriode.php" class="list-group-item list-group-item-action">Overzicht aantal leden per periode</a>
          <a href="../MedewerkerOverzicht/MedewerkerOverzicht.php" class="list-group-item list-group-item-action">Medewerker Overzicht</a>
          <a href="../LedenOverzicht/LedenOverzicht.php" class="list-group-item list-group-item-action">Leden Overzicht</a>
        </div>
      </div>
      <div class="col-4"></div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>