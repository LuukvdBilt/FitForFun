<?php
  $display = 'none';
  $errorMessage = '';

  if (isset($_POST['submit'])) {
    include('config.php');

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    // Check if the person or email already exists
    $checkSql = "SELECT COUNT(*) FROM AccountAanmaken WHERE (Voornaam = :voornaam AND Tussenvoegsel = :tussenvoegsel AND Achternaam = :achternaam) OR Email = :email";
    $checkStatement = $pdo->prepare($checkSql);
    $checkStatement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
    $checkStatement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
    $checkStatement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
    $checkStatement->bindValue(':email', $_POST['Email'], PDO::PARAM_STR);
    $checkStatement->execute();
    $count = $checkStatement->fetchColumn();

    if ($count > 0) {
      $errorMessage = 'Dit persoon bestaat al';
      $display = 'flex';
    } else {
      $sql = "INSERT INTO AccountAanmaken
          (
              Voornaam,
            Tussenvoegsel,
            Achternaam,
            Email,
            Wachtwoord,
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
            :email,
            :wachtwoord,
            1,
            NULL,
            SYSDATE(6),
            SYSDATE(6)
          )";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
      $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
      $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
      $statement->bindValue(':email', $_POST['Email'], PDO::PARAM_STR);
      $statement->bindValue(':wachtwoord', $_POST['Wachtwoord'], PDO::PARAM_STR);

   
      $statement->execute();

      $display = 'flex';
      header('Refresh:3; url=../Homepagina/index.php');
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Account Aanmaken</title>
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
        De nieuwe gastgebruiker is opgeslagen, u wordt doorgestuurd naar de Homepagina.
      </div>
      <?php endif; ?>
    </div>
    <div class="col-3"></div>
    </div>

    <div class="row mb-1">
    <div class="col-3"></div>
    <div class="col-6 text-primary"><h3>Voer een nieuwe gastgebruiker in</h3></div>
    <div class="col-3"></div>
    </div>

    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">              
        <form action="create.php" method="POST">
        <div class="mb-3">
          <label for="voornaam" class="form-label">Voornaam</label>
          <input name="voornaam" type="text" class="form-control" id="voornaamGastgebruiker" placeholder="Naam van de gastgebruiker">
        </div>
        <div class="mb-3">
          <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
          <input name="tussenvoegsel" type="text" class="form-control" id="tussenvoegselGastgebruiker" placeholder="Tussenvoegsel van de van de gastgebruiker">
        </div>
        <div class="mb-3">
          <label for="achternaam" class="form-label">Achternaam</label>
          <input name="achternaam" type="text" class="form-control" id="achternaamGastgebruiker" placeholder="Achternaam van de gastgebruiker">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="Email" type="email" class="form-control" id="emailGastgebruiker" placeholder="email van de gastgebruiker" min="0" max="100">
        </div>
        <div class="mb-3">
          <label for="wachtwoord" class="form-label">Wachtwoord</label>
          <input name="Wachtwoord" type="password" class="form-control" id="wachtwoordGastgebruiker" placeholder="Wachtwoord van de gastgebruiker">

        <div class="d-grid gap-4">
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
