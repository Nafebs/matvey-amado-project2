<?php
require '../vendor/autoload.php';
require '../config/db.php';  // Подключаем к базе данных

// Подключение к базе данных через Singleton
$db = Database::getInstance()->getConnection();

// Проверяем, что запрос был отправлен через AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    // Получаем данные из формы
    $username = $_POST['login'];  // Используем login, чтобы соответствовать полю формы
    $password = $_POST['password'];

    // Проводим проверку (проверка данных, хэширование пароля и т.д.)
    if (empty($username) || empty($password)) {
        // Ответ в формате JSON с ошибкой
        echo json_encode(['success' => false, 'error' => 'Заполните все поля']);
        exit();
    } else {
        // Пример запроса для получения пользователя из базы данных
        $stmt = $db->prepare("SELECT id, password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Успешная авторизация
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            echo json_encode(['success' => true]);  // Ответ об успешной авторизации
            exit();
        } else {
            // Неверный логин или пароль
            echo json_encode(['success' => false, 'error' => 'Неверный логин или пароль']);
            exit();
        }
    }
}

// Отображение шаблона авторизации
$smarty = new Smarty();
$smarty->setTemplateDir('../templates/');
$smarty->setCompileDir('../templates_c/');
$smarty->setCacheDir('../cache/');
$smarty->setConfigDir('../configs/');

$smarty->assign('title', 'Авторизация');
$smarty->display('login.tpl');
?>
