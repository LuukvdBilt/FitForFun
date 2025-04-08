<?php
  $display = 'none';
  $errorMessage = '';

  if (isset($_POST['submit'])) {
    include('config.php');

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    // Check of de persoon al bestaat
    $checkSql = "SELECT COUNT(*) FROM LedenOverzicht WHERE Voornaam = :voornaam AND Tussenvoegsel = :tussenvoegsel AND Achternaam = :achternaam";
    $checkStatement = $pdo->prepare($checkSql);
    $checkStatement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
    $checkStatement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
    $checkStatement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
    $checkStatement->execute();
    $count = $checkStatement->fetchColumn();

    if ($count > 0) {
      $errorMessage = 'Deze persoon bestaat al';
      $display = 'flex';
    } else {
      // Pas de kolomnamen aan zodat deze overeenkomen met LedenOverzicht.php
      $sql = "INSERT INTO ledenoverzicht
              (
                Voornaam,
                Tussenvoegsel,
                Achternaam,
                Relatienummer,
                Mobiel,
                Email
              )
              VALUES
              (
                :voornaam,
                :tussenvoegsel,
                :achternaam,
                :relatienummer,
                :mobiel,
                :email
              )";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
      $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
      $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
      $statement->bindValue(':relatienummer', $_POST['relatienummer'], PDO::PARAM_STR);
      $statement->bindValue(':mobiel', $_POST['mobiel'], PDO::PARAM_STR);
      $statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
      $statement->execute();

      $display = 'flex';
      header('Refresh:3; url=LedenOverzicht.php');
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>leden Overzicht</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-3">
      <div class="row" style="display:<?= $display; ?>">
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
        <div class="col-6 text-primary">
          <h3>Voeg een nieuw lid toe</h3>
        </div>
        <div class="col-3"></div>
      </div>

      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">              
          <form action="create.php" method="POST">
        <div class="mb-3">
          <label for="voornaamLid" class="form-label">Voornaam</label>
          <input name="voornaam" type="text" class="form-control" id="voornaamLid" placeholder="Voornaam van het lid" required>
        </div>
        <div class="mb-3">
          <label for="tussenvoegselLid" class="form-label">Tussenvoegsel</label>
          <input name="tussenvoegsel" type="text" class="form-control" id="tussenvoegselLid" placeholder="Tussenvoegsel van het lid">
        </div>
        <div class="mb-3">
          <label for="achternaamLid" class="form-label">Achternaam</label>
          <input name="achternaam" type="text" class="form-control" id="achternaamLid" placeholder="Achternaam van het lid" required>
        </div>
        <div class="mb-3">
          <label for="relatienummerLid" class="form-label">Relatienummer</label>
          <input name="relatienummer" type="text" class="form-control" id="relatienummerLid" placeholder="Relatienummer" required>
        </div>
        <div class="mb-3">
          <label for="mobielLid" class="form-label">Mobiel</label>
          <input name="mobiel" type="text" class="form-control" id="mobielLid" placeholder="Mobiel nummer" required>
        </div>
        <div class="mb-3">
          <label for="emailLid" class="form-label">Email</label>
          <input name="email" type="email" class="form-control" id="emailLid" placeholder="Email adres" required>
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
