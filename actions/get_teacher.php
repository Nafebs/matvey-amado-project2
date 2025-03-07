<?php
require '../config/db.php';

$db = Database::getInstance()->getConnection();

$class_id = $_GET['class_id'] ?? null;

if (empty($class_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Не выбран класс.']);
    exit;
}

// Получаем ID преподавателя для выбранного класса
$stmt = $db->prepare("SELECT teacher_id FROM classes WHERE id = ?");
$stmt->execute([$class_id]);
$teacher_id = $stmt->fetchColumn();

echo json_encode([
    'status' => 'success',
    'teacher_id' => $teacher_id
]);
?>
