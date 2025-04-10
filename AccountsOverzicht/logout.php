<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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


<?php
session_start();
session_unset();
session_destroy();
header("Location: ../Homepagina/index.php");
exit();
?>
