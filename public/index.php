<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    // Если не авторизован, перенаправляем на страницу логина
    header('Location: ../actions/login.php');
    exit();
}

require '../vendor/autoload.php';
require '../config/db.php';

// Подключаемся к базе данных через Singleton
$db = Database::getInstance()->getConnection();

// Получаем параметры фильтрации
$search = $_GET['search'] ?? '';
$class_filter = $_GET['class'] ?? '';
$sort = $_GET['sort'] ?? 'id';
$order = $_GET['order'] ?? 'ASC';
$next_order = ($order === 'ASC') ? 'DESC' : 'ASC';

// Запрос для получения классов (для фильтра)
$class_stmt = $db->prepare("SELECT id, CONCAT(grade, '-', section) AS class_name FROM classes ORDER BY grade, section");
$class_stmt->execute();
$classes = $class_stmt->fetchAll(PDO::FETCH_ASSOC);

// Базовый SQL-запрос
$sql = "SELECT students.id, students.second_name, students.first_name, 
               students.patronymic, students.birth_date, 
               CONCAT(classes.grade, '-', classes.section) AS class_name,
               CONCAT(teachers.second_name, ' ', teachers.first_name, ' ', teachers.patronymic) AS teacher_name
        FROM students 
        JOIN classes ON students.class_id = classes.id
        JOIN teachers ON classes.teacher_id = teachers.id"; // Добавлен JOIN с учителями

// Условия фильтрации
$conditions = [];
$params = [];

if (!empty($search)) {
    $conditions[] = "(students.id LIKE :search OR students.second_name LIKE :search OR 
                      students.first_name LIKE :search OR students.patronymic LIKE :search OR 
                      students.birth_date LIKE :search OR teachers.second_name LIKE :search OR 
                      teachers.first_name LIKE :search OR teachers.patronymic LIKE :search)";
    $params['search'] = "%$search%";
}

if (!empty($class_filter)) {
    $conditions[] = "students.class_id = :class_filter";
    $params['class_filter'] = $class_filter;
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Сортировка
$allowed_sort = ['id', 'second_name', 'first_name', 'patronymic', 'birth_date', 'class_name', 'teacher_name'];
if (in_array($sort, $allowed_sort)) {
    $sql .= " ORDER BY $sort $order";
} else {
    $sql .= " ORDER BY id ASC";
}

$stmt = $db->prepare($sql);
$stmt->execute($params);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Инициализируем Smarty
$smarty = new Smarty();
$smarty->setTemplateDir('../templates/');
$smarty->setCompileDir('../templates_c/');
$smarty->setCacheDir('../cache/');
$smarty->setConfigDir('../configs/');

// Передаем данные в шаблон
$smarty->assign('title', 'Система учёта учеников');
$smarty->assign('students', $students);
$smarty->assign('classes', $classes);
$smarty->assign('search', $search);
$smarty->assign('class_filter', $class_filter);
$smarty->assign('sort', $sort);
$smarty->assign('order', $order);
$smarty->assign('next_order', $next_order);
$smarty->assign('username', $_SESSION['username']);

// Запрос для получения преподавателей
$teacher_stmt = $db->prepare("SELECT id, CONCAT(second_name, ' ', first_name, ' ', patronymic) AS name FROM teachers");
$teacher_stmt->execute();
$teachers = $teacher_stmt->fetchAll(PDO::FETCH_ASSOC);

// Передаем преподавателей в шаблон
$smarty->assign('teachers', $teachers);

// Выводим страницу
$smarty->display('index.tpl');
?>
