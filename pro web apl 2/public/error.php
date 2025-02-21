<?php
session_start(); // Start de sessie
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fout - FitForFun</title>
    <!-- Styling links -->
    <link rel="stylesheet" href="error.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="error-page">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img class="logo" src="https://www.burda-forward.de/files/images/03_Media/Brands/FitForFun/BF_Media_Brands_FitForFun_logo.png" alt="FitForFun Logo">
            </a>
        </div>
    </nav>
    
</div>

    <!-- Hoofdinhoud -->
    <main class="container mt-5 pt-4 text-center">
        <div class="error-icon">
            <i class="bi bi-x-circle-fill text-danger" style="font-size: 5rem;"></i>
        </div>
        <h1 class="mt-3">Sorry, er is een storing!</h1>
        <p class="lead">Er is een probleem met het laden van de kalender. Probeer het later opnieuw.</p>
        <a href="index.php" class="btn btn-primary">Terug naar Home</a>
    </main>

    <!-- Scripts -->
    <script src="calenderunhappy.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>