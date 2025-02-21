<?php
require 'db.php';
header('Content-Type: application/json');

$stmt = $conn->query("SELECT id, naam AS title, functie AS description FROM Medewerkers");
$lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($lessons);
?>
