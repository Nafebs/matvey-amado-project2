<?php
require '../config/db.php';

$db = Database::getInstance()->getConnection();

// Получаем данные
$first_name = trim($_POST['first_name']);
$second_name = trim($_POST['second_name']);
$patronymic = trim($_POST['patronymic']);
$birth_date = $_POST['birth_date'];
$class_id = $_POST['class_id'];

// Проверка заполнения всех полей
if (empty($first_name) || empty($second_name) || empty($birth_date) || empty($class_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Заполните все обязательные поля.']);
    exit;
}

// Проверка на дублирование (ФИО + дата рождения)
$stmt = $db->prepare("SELECT COUNT(*) FROM students WHERE first_name = ? AND second_name = ? AND patronymic = ? AND birth_date = ?");
$stmt->execute([$first_name, $second_name, $patronymic, $birth_date]);

if ($stmt->fetchColumn() > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Такой ученик уже существует.']);
    exit;
}

// Добавление ученика
$stmt = $db->prepare("INSERT INTO students (first_name, second_name, patronymic, birth_date, class_id) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$first_name, $second_name, $patronymic, $birth_date, $class_id]);

echo json_encode(['status' => 'success']);
?>
