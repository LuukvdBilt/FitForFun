<?php
require 'db.php';
header('Content-Type: application/json');

try {
    $stmt = $conn->query("SELECT r.id, l.title, l.start_time 
                         FROM reservations r
                         JOIN lessons l ON r.lesson_id = l.id");
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($reservations);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>