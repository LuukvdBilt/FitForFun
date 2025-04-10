<?php
/**
 * We sluiten het configuratiebestand in bij de pagina
 * index.php
 */
include('config.php');

$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

/**
 * Maak een nieuw PDO-object aan zodat we een verbinding
 * kunnen maken met de mysql-server
 */
$pdo = new PDO($dsn, $dbUser, $dbPass);

/**
 * De sql-query om een achtbaan record te verwijderen
 */
$sql = "DELETE FROM medewerkeroverzicht AS MWOz
        WHERE MWOz.Voornaam = :voornaamMedewerker";

/**
 * We moeten de sql-query voorbereiden voor de PDO class
 */
$statement = $pdo->prepare($sql);

/**
 * We koppelen aan de placeholder :id de waarde die we
 * via het $_GET-array hebben binnengekregen
 */
$statement->bindValue(':id', $_GET['Id'], PDO::PARAM_INT);

/**
 * We voeren de geprepareerde sql-query uit
 */
$statement->execute();

/**
 * We sturen de gebruiker door naar de index.php pagina
 */
header('Refresh:3; url=MedewerkerOverzicht.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verwijder record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="alert alert-success text-center" role="alert">
                    Het verwijderen is gelukt
                </div>
            </div>
            <div class="col-3"></div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>