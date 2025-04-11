<?php
// Database verbinding
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FitForFun";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinden mislukt: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // JavaScript bevestigingsdialoog
    echo "<script>
            var isConfirmed = confirm('Weet je zeker dat je deze les wilt verwijderen?');
            if (isConfirmed) {
                // Als bevestigd, wordt de les verwijderd
                window.location.href = 'verwijder_lesson.php?delete=1&id=" . $id . "';
            } else {
                // Als geannuleerd, ga terug naar de overzichtspagina
                window.location.href = 'lessen.php';
            }
          </script>";
}

// Verwijder de les als de 'delete' parameter is ingesteld
if (isset($_GET['delete']) && $_GET['delete'] == '1' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL-query om de les te verwijderen
    $sql = "DELETE FROM Les WHERE Id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect naar de lespagina met succesmelding
        header("Location: lessen.php?message=Les succesvol verwijderd");
        exit();
    } else {
        echo "Fout bij verwijderen les: " . $conn->error;
    }
}

$conn->close();
?>
