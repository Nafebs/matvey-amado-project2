<?php
require '../config/db.php';

$db = Database::getInstance()->getConnection();

// Запрос на получение всех учеников с классом
$stmt = $db->prepare("SELECT students.id, students.first_name, students.second_name, 
                            students.patronymic, students.birth_date, 
                            CONCAT(classes.grade, '-', classes.section) AS class_name
                       FROM students
                       JOIN classes ON students.class_id = classes.id
                       ORDER BY students.id");

$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Выводим таблицу
foreach ($students as $student) {
    echo "<tr>
            <td><input type='checkbox' class='student-checkbox' value='{$student['id']}'></td>
            <td>{$student['id']}</td>
            <td>{$student['second_name']}</td>
            <td>{$student['first_name']}</td>
            <td>{$student['patronymic']}</td>
            <td>{$student['birth_date']}</td>
            <td>{$student['class_name']}</td>
          </tr>";
}
?>