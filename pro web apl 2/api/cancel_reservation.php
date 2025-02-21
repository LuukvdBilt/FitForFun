<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['reservation_id'])) {
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

try {
    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->execute([$data['reservation_id']]);
    echo json_encode(["message" => "Reservering geannuleerd!"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>