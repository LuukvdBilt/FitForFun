<?php
$display = 'none';
$errorMessage = '';

if (isset($_POST['submit'])) {
  include('config.php');

  try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Controleer of de gebruikersnaam al bestaat
    $usernameCheckSql = "SELECT COUNT(*) FROM LedenOverzicht WHERE username = :username";
    $usernameCheckStatement = $pdo->prepare($usernameCheckSql);
    $usernameCheckStatement->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
    $usernameCheckStatement->execute();
    $usernameCount = $usernameCheckStatement->fetchColumn();

    if ($usernameCount > 0) {
      $errorMessage = 'De gebruikersnaam bestaat al. Kies een andere gebruikersnaam.';
      $display = 'flex';
    } else {
      // Controleer of de gebruiker al bestaat op basis van andere gegevens
      $checkSql = "SELECT COUNT(*) FROM LedenOverzicht 
           WHERE Voornaam = :voornaam 
           AND Tussenvoegsel = :tussenvoegsel 
           AND Achternaam = :achternaam 
           AND Email = :email 
           AND Nummer = :nummer 
           AND Mobiel = :mobiel 
           AND password = :password";
      $checkStatement = $pdo->prepare($checkSql);

      $checkStatement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
      $checkStatement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
      $checkStatement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
      $checkStatement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
      $checkStatement->bindValue(':nummer', $_POST['Nummer'], PDO::PARAM_INT);
      $checkStatement->bindValue(':mobiel', $_POST['mobiel'], PDO::PARAM_STR);
      $checkStatement->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
      $checkStatement->execute();
      $count = $checkStatement->fetchColumn();

      if ($count > 0) {
        $errorMessage = 'Dit persoon bestaat al';
        $display = 'flex';
      } else {
        // Voer de query uit om de gegevens op te slaan
        $sql = "INSERT INTO LedenOverzicht
          (
            username,
            Voornaam,
            Tussenvoegsel,
            Achternaam,
            Nummer,
            Mobiel,
            Email,
            password,
            rol,
            lid_sinds
          )
          VALUES
          (
            :username,
            :voornaam,
            :tussenvoegsel,
            :achternaam,
            :nummer,
            :mobiel,
            :email,
            :password,
            :rol,
            CURDATE()
          )";

        $statement = $pdo->prepare($sql);
        $statement->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $statement->bindValue(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
        $statement->bindValue(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
        $statement->bindValue(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
        $statement->bindValue(':nummer', $_POST['Nummer'], PDO::PARAM_INT);
        $statement->bindValue(':mobiel', $_POST['mobiel'], PDO::PARAM_STR);
        $statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $statement->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
        $statement->bindValue(':rol', 'lid', PDO::PARAM_STR);

        $statement->execute();

        $display = 'flex';
        header('Refresh:3; url=../Homepagina/index.php');
      }
    }
  } catch (PDOException $e) {
    $errorMessage = 'Er is een fout opgetreden: ' . $e->getMessage();
    $display = 'flex';
  }
}
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Account Aanmaken</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
  <!-- Alert Section -->
  <div class="row justify-content-center" style="display:<?= $display ?? 'none'; ?>">
    <div class="col-md-6">
      <?php if ($errorMessage): ?>
        <div class="alert alert-danger text-center" role="alert">
          <?= $errorMessage ?>
        </div>
      <?php else: ?>
        <div class="alert alert-success text-center" role="alert">
          De nieuwe lid is opgeslagen, u wordt doorgestuurd naar de Homepagina.
        </div>
      <?php endif; ?>
    </div>
  </div>


  <div class="row text-center mb-4">
    <div class="col">
      <h2 class="text-primary">Wordt nu lid van onze website!</h2>
      <p class="text-muted">Vul het onderstaande formulier in om een account aan te maken.</p>
    </div>
  </div>


  <div class="row justify-content-center">
    <div class="col-md-6">
      <form action="create.php" method="POST" class="p-4 border rounded shadow-sm bg-light">
        <div class="mb-3">
          <label for="username" class="form-label">Gebruikersnaam</label>
          <input name="username" type="text" class="form-control" id="username" placeholder="Gebruikersnaam" required>
        </div>
        <div class="mb-3">
          <label for="voornaam" class="form-label">Voornaam</label>
          <input name="voornaam" type="text" class="form-control" id="voornaam" placeholder="Voornaam" required>
        </div>
        <div class="mb-3">
          <label for="tussenvoegsel" class="form-label">Tussenvoegsel</label>
          <input name="tussenvoegsel" type="text" class="form-control" id="tussenvoegsel" placeholder="Tussenvoegsel">
        </div>
        <div class="mb-3">
          <label for="achternaam" class="form-label">Achternaam</label>
          <input name="achternaam" type="text" class="form-control" id="achternaam" placeholder="Achternaam" required>
        </div>
        <div class="mb-3">
          <?php
          // dit maakt een unieke nummer voor een lid aan, ook kan dezelfde nummer niet meer gebruikt worden
          include('config.php');
          try {
            $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";
            $pdo = new PDO($dsn, $dbUser, $dbPass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            do {
              $uniqueNumber = rand(100000, 999999); 
              $checkSql = "SELECT COUNT(*) FROM LedenOverzicht WHERE Nummer = :nummer";
              $checkStatement = $pdo->prepare($checkSql);
              $checkStatement->bindValue(':nummer', $uniqueNumber, PDO::PARAM_INT);
              $checkStatement->execute();
              $count = $checkStatement->fetchColumn();
            } while ($count > 0); 
          } catch (PDOException $e) {
            $uniqueNumber = ''; 
          }
          ?>
          <label for="Nummer" class="form-label">Nummer</label>
          <input name="Nummer" type="number" class="form-control" id="Nummer" placeholder="Nummer" value="<?= htmlspecialchars($uniqueNumber) ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="mobiel" class="form-label">Mobiele telefoonnummer</label>
          <input name="mobiel" type="number" class="form-control" id="mobiel" placeholder="Mobiel" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Wachtwoord</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Wachtwoord" required>
        </div>
        <div class="d-grid gap-4">
          <button name="submit" value="submit" type="submit" class="btn btn-primary btn-lg">Opslaan</button>
        </di>
      </form>
    </div>
    <div class="col-3"></div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
