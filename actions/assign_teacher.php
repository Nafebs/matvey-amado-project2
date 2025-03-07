<?php
require '../config/db.php';

$db = Database::getInstance()->getConnection();

$class_id = $_POST['class_id'] ?? null;
$teacher_id = $_POST['teacher_id'] ?? null;

if (empty($class_id) || empty($teacher_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Выберите класс и преподавателя.']);
    exit;
}

// Получаем текущего преподавателя для класса
$stmt = $db->prepare("SELECT teacher_id FROM classes WHERE id = ?");
$stmt->execute([$class_id]);
$current_teacher_id = $stmt->fetchColumn();

// Если текущий преподаватель совпадает с выбранным, ничего не обновляем
if ($current_teacher_id == $teacher_id) {
    echo json_encode(['status' => 'error', 'message' => 'Этот преподаватель уже назначен.']);
    exit;
}

// Обновляем преподавателя
$stmt = $db->prepare("UPDATE classes SET teacher_id = ? WHERE id = ?");
$stmt->execute([$teacher_id, $class_id]);

echo json_encode(['status' => 'success']);
?>
