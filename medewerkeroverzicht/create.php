<?php
  $display = 'none';
  $errorMessage = '';

  if (isset($_POST['submit'])) {
    include('config.php');

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    // Check if the person already exists
    $checkSql = "SELECT COUNT(*) FROM medewerkeroverzicht WHERE Voornaam = :voornaam AND Tussenvoegsel = :tussenvoegsel AND Achternaam = :achternaam";
    $checkStatement = $pdo->prepare($checkSql);
    $checkStatement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
    $checkStatement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
    $checkStatement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
    $checkStatement->execute();
    $count = $checkStatement->fetchColumn();

    if ($count > 0) {
      $errorMessage = 'Dit persoon bestaat al';
      $display = 'flex';
    } else {
      $sql = "INSERT INTO medewerkeroverzicht
          (
            Voornaam,
            Tussenvoegsel,
            Achternaam,
            Telefoonnummer,
            Werknemerrank,
            IsActief,
            Opmerking,
            DatumAangemaakt,
            DatumGewijzigd
          )
          VALUES
          (
            :voornaam,
            :tussenvoegsel,
            :achternaam,
            :telefoonnummer,
            :werknemerrank,
            1,
            NULL,
            SYSDATE(6),
            SYSDATE(6)
          )";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
      $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
      $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
      $statement->bindValue(':telefoonnummer', $_POST['telefoonnummer'], PDO::PARAM_STR);
      $statement->bindValue(':werknemerrank', $_POST['werknemerrank'], PDO::PARAM_INT);
      $statement->execute();

      $display = 'flex';
      header('Refresh:3; url=MedewerkerOverzicht.php');
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medewerker Overzicht</title>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
  <div class="container mt-3">

    <div class="row" style="display:<?= $display ?? 'none'; ?>">
    <div class="col-3"></div>
    <div class="col-6">
      <?php if ($errorMessage): ?>
      <div class="alert alert-danger text-center" role="alert">
        <?= $errorMessage ?>
      </div>
      <?php else: ?>
      <div class="alert alert-success text-center" role="alert">
        De nieuwe medewerker is opgeslagen, u wordt doorgestuurd naar het overzicht.
      </div>
      <?php endif; ?>
    </div>
    <div class="col-3"></div>
    </div>

    <div class="row mb-1">
    <div class="col-3"></div>
    <div class="col-6 text-primary"><h3>Voer een nieuwe medewerker in</h3></div>
    <div class="col-3"></div>
    </div>

    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">              
        <form action="create.php" method="POST">
        <div class="mb-3">
          <label for="voornaam" class="form-label">Voornaam</label>
          <input name="voornaam" type="text" class="form-control" id="voornaamMedewerker" placeholder="Naam van de medewerker">
        </div>
        <div class="mb-3">
          <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
          <input name="tussenvoegsel" type="text" class="form-control" id="tussenvoegselMedewerker" placeholder="Tussenvoegsel van de medewerker">
        </div>
        <div class="mb-3">
          <label for="achternaamMedewerker" class="form-label">Achternaam</label>
          <input name="achternaam" type="text" class="form-control" id="achternaamMedewerker" placeholder="Achternaam van de medewerker">
        </div>
        <div class="mb-3">
          <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
          <input name="telefoonnummer" type="number" class="form-control" id="telefoonnummerMedwerker" placeholder="Telefoonnummer van de medewerker" min="0" max="100000000000000">
        </div>
        <div class="mb-3">
          <label for="werknemerrank" class="form-label">Werknemerrank</label>
          <input name="werknemerrank" type="number" class="form-control" id="werknemerrank" placeholder="Rank van de medewerker" min="0" max="255">
        </div>
        
        <div class="d-grid gap-2">
          <button name="submit" value="submit" type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
        </form>
      </div>
      <div class="col-3"></div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
