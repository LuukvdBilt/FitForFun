<?php
session_start(); // Start de sessie

// Simpele PHP-logica voor lessen (vervang dit door echte databasequery's)
$lessons = [
    ['id' => 1, 'title' => 'Yoga', 'start' => '2025-02-16T08:00:00', 'end' => '2025-02-16T09:00:00'],
    ['id' => 2, 'title' => 'Fitness', 'start' => '2025-02-17T10:00:00', 'end' => '2025-02-17T11:00:00']
];
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geplande Lessen - FitForFun</title>
    <!-- Styling links -->
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.5/main.min.css">
</head>
<body class="calendar-page">
<nav class="navbar">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
        <img class="logo" src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo">
    </a>

    <!-- Navigatielinks -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../Homepagina/index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="lessen.php">Geplande lessen</a>
        </li>
        
        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'docent'): ?>
            <li class="nav-item">
                <a class="nav-link" href="beheer.php">Lesbeheer</a>
            </li>
        <?php endif; ?>
    </ul>

    <!-- Rechterkant van de navbar -->
    <ul class="navbar-nav">
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item nav-dropdown">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['username']) ?>
                </a>
                <div class="dropdown-content">
                    <a href="profiel.php">Profiel</a>
                    <a href="logout.php" class="text-danger">Uitloggen</a>
                </div>
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
</nav>

    <!-- Hoofdinhoud -->
    <main class="container mt-5 pt-4">
        <h1 class="mb-4">Geplande Lessen</h1>
        
        <!-- Navigatieknoppen voor kalender -->
        <div id="nav-buttons" class="mb-3">
            <button class="btn btn-primary" id="prevWeek">Vorige Week</button>
            <button class="btn btn-primary" id="nextWeek">Volgende Week</button>
        </div>

        <!-- Kalender -->
        <div id="calendar"></div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.5/main.min.js"></script>
    <script>
        // Geef de lessen door aan JavaScript
        const lessons = <?php echo json_encode($lessons); ?>;
    </script>
    <script src="calendar.js"></script>
</body>
</html>