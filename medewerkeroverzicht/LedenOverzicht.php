<?php
// LedenOverzicht.php
        include('config.php');

        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
        $pdo = new PDO($dsn, $dbUser, $dbPass);

        $sql = "SELECT  LDOZ.Voornaam,
                                        LDOZ.Tussenvoegsel,
                                        LDOZ.Achternaam,
                                        LDOZ.Leeftijd,
                                        LDOZ.Geslacht
                        FROM ledenoverzicht AS LDOZ
                        ORDER BY LDOZ.Voornaam DESC";

        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        //test
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Leden Overzicht</title>
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
                 <a class="nav-link" href="Homepagina/index.php">Home</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="aanbiedingen.php">Aanbiedingen</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="lessen.php">Geplande lessen</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="login.php">Overzicht</a>
               </li>
             </ul>
    
             <ul class="navbar-nav">
               <li class="nav-item">
                 <a class="nav-link" href="#"><i class="bi bi-cart"></i> Winkelwagen</a>
               </li>
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
        <h1>Leden Overzicht</h1>
        <table border="1">
                <tr>
                        <th>Voornaam</th>
                        <th>Tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Leeftijd</th>
                        <th>Geslacht</th>
                </tr>
                <?php foreach ($result as $row): ?>
                <tr>
                        <td><?php echo htmlspecialchars($row->Voornaam); ?></td>
                        <td><?php echo htmlspecialchars($row->Tussenvoegsel ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row->Achternaam); ?></td>
                        <td><?php echo htmlspecialchars($row->Leeftijd); ?></td>
                        <td><?php echo htmlspecialchars($row->Geslacht); ?></td>
                </tr>
                <?php endforeach; ?>
        </table>
</body>
</html>
