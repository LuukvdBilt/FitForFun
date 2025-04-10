<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $conn = new mysqli("localhost", "root", "", "fitforfun");

    if ($conn->connect_error) {
        die("Verbinding mislukt: " . $conn->connect_error);
    }

    // Soft delete: zet Isactief op 0
    $sql = "UPDATE Reservering SET Isactief = 0 WHERE Id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: lessen.php"); // Terug naar overzicht
        exit();
    } else {
        echo "Fout bij verwijderen: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Geen ID opgegeven.";
}
?>