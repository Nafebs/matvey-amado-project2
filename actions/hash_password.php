<?php

// Проверим, передан ли пароль через консоль
if ($argc !== 2) {
    echo "Использование: php hash_password.php <password>\n";
    exit(1); // Выход с ошибкой
}

$password = $argv[1]; // Пароль, переданный в консоли

// Хеширование пароля
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Вывод в консоль
echo "Хешированный пароль: " . $hashedPassword . "\n";
?>
