<?php
require_once '../config/db.php';

header('Content-Type: application/json');

try {
    $pdo = Database::getInstance()->getConnection();

    // Самый младший ученик (связь с таблицей classes для получения названия класса)
    $stmt = $pdo->query("SELECT s.id, CONCAT(s.second_name, ' ', s.first_name, ' ', s.patronymic) AS name, s.birth_date, CONCAT(c.grade, '-', c.section) AS class
                     FROM students s
                     JOIN classes c ON s.class_id = c.id
                     ORDER BY s.birth_date DESC LIMIT 1");
    $youngest_student = $stmt->fetch(PDO::FETCH_ASSOC);

    // Количество учеников во вторых классах (связь с таблицей classes)
    $stmt = $pdo->query("SELECT CONCAT(c.grade, '-', c.section) AS class, COUNT(*) AS count
                         FROM students s
                         JOIN classes c ON s.class_id = c.id
                         WHERE c.grade = 2
                         GROUP BY c.grade, c.section");
    $second_grades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Количество учеников у преподавателей
    $stmt = $pdo->query("SELECT CONCAT(t.second_name, ' ', t.first_name, ' ', t.patronymic) AS name, COUNT(s.id) AS count
                         FROM teachers t
                         LEFT JOIN classes c ON t.id = c.teacher_id
                         LEFT JOIN students s ON c.id = s.class_id
                         GROUP BY t.id");
    $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "youngest_student" => $youngest_student,
        "second_grades" => $second_grades,
        "teachers" => $teachers
    ]);
} catch (PDOException $e) {
    // Выводим подробности ошибки
    echo json_encode(["error" => "Ошибка базы данных: " . $e->getMessage()]);
}
?>
