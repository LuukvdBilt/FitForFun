<?php
session_start();
require 'config.php';



try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     //happy scenario
    if (isset($_GET['Nummer']) && !empty($_GET['Nummer'])) {
        $Nummer = $_GET['Nummer'];

        $sql = "DELETE FROM LedenOverzicht WHERE Nummer = :Nummer";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':Nummer', $Nummer, PDO::PARAM_STR);
        $result = $stmt->execute();
        $_SESSION['message'] = "Uw account is succesvol verwijderd.";	 
        } else {
            // Unhappy scenario
            $_SESSION['message-error'] = "Er is een fout opgetreden bij het verwijderen van uw account, probeer het later opnieuw.";
        }
    } 
 catch (PDOException $e) {
    $_SESSION['messagedatabase'] = "Databasefout: " . $e->getMessage();
}

header("Refresh: 3; url=../AccountsOverzicht/logout.php");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verwijder record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success text-center" role="alert">
                        <?= $_SESSION['message'] ?>
                        <?php unset($_SESSION['message']); ?>
                </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['message-error'])): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $_SESSION['message-error'] ?>
                            <?php unset($_SESSION['message-error']); ?>
                        </div>
                    <?php endif; ?>
                <?php if (isset($_SESSION['messagedatabase'])): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $_SESSION['messagedatabase'] ?>
                            <?php unset($_SESSION['messagedatabase']); ?>
                        </div>
                    <?php endif; ?>
            </div>
            <div class="col-3"></div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
exit;
?>
