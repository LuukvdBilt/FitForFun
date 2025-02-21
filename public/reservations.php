<?php
session_start(); // Start de sessie om gebruikersgegevens te controleren

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Stuur niet-ingelogde gebruikers naar de loginpagina
    exit();
}

// Simpele PHP-logica voor reserveringen (vervang dit door echte databasequery's)
$reservations = [
    ['id' => 1, 'title' => 'Yoga', 'date' => '2025-02-16', 'time' => '08:00 - 09:00'],
    ['id' => 2, 'title' => 'Fitness', 'date' => '2025-02-17', 'time' => '10:00 - 11:00']
];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Reserveringen - FitForFun</title>
    <!-- Styling links -->
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
  <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img class="logo" src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo">
        </a>

        <!-- Hamburger menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigatielinks -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lessen.php">Geplande lessen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="overzicht.php">Mijn Reserveringen</a>
                </li>
                <!-- Voeg dit alleen voor docenten -->
                <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'docent'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="beheer.php">Lesbeheer</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Rechterkant -->
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['username']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profiel.php">Profiel</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Uitloggen</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Inloggen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Registreren</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
    <!-- Hoofdinhoud -->
    <main class="container mt-5 pt-4">
        <h1 class="mb-4">Mijn Reserveringen</h1>
        
        <!-- Reserveringenlijst -->
        <div id="reservations-list">
            <?php if (empty($reservations)): ?>
                <p>Je hebt nog geen reserveringen.</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach ($reservations as $reservation): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($reservation['title']) ?></strong><br>
                            <small><?= htmlspecialchars($reservation['date']) ?> | <?= htmlspecialchars($reservation['time']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>