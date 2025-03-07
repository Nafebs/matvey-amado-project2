<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <script src="../public/scripts/login.js" defer></script>
    <script src="../public/scripts/password_button.js" defer></script>
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Войти в систему</h2>

        {if isset($error)}
            <script type="text/javascript">
                alert('{$error}');
            </script>
        {/if}

        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="login" required>
            </div>

            <div class="input-group">
                <label for="password">Пароль:</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required>
                    <span id="toggle-password" class="password-icon">
                        <span id="eye-icon">👁️</span>
                    </span>
                </div>
            </div>

            <!-- Кнопка входа -->
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
