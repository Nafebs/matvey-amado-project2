<?php
session_start();
session_unset(); // Очистка всех переменных сессии
session_destroy(); // Уничтожение сессии

header('Location: ..\actions\login.php'); // Перенаправление на страницу входа
exit();