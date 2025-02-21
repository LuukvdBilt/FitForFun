<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['title']) || empty($data['start']) || empty($data['end'])) {
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO lessons (title, start_time, end_time) VALUES (?, ?, ?)");
    $stmt->execute([$data['title'], $data['start'], $data['end']]);
    echo json_encode(["message" => "Les toegevoegd!"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>