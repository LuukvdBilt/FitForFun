<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['lesson_id'])) {
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

try {
    // Check if lesson exists
    $stmt = $conn->prepare("SELECT id FROM lessons WHERE id = ?");
    $stmt->execute([$data['lesson_id']]);
    if (!$stmt->fetch()) {
        echo json_encode(["error" => "Les niet gevonden"]);
        exit;
    }

    // Reserve lesson
    $stmt = $conn->prepare("INSERT INTO reservations (user_id, lesson_id) VALUES (?, ?)");
    $stmt->execute([1, $data['lesson_id']]); // Replace 1 with actual user ID
    echo json_encode(["message" => "Les gereserveerd!"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>