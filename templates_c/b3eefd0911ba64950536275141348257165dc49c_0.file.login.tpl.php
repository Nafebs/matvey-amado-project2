<?php
/* Smarty version 4.3.0, created on 2025-02-28 13:59:55
  from 'C:\xampp\htdocs\amado_project\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_67c1b34b037081_79548136',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3eefd0911ba64950536275141348257165dc49c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\amado_project\\templates\\login.tpl',
      1 => 1740747593,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c1b34b037081_79548136 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <?php echo '<script'; ?>
 src="../public/scripts/login.js" defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../public/scripts/password_button.js" defer><?php echo '</script'; ?>
>
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Войти в систему</h2>

        <?php if ((isset($_smarty_tpl->tpl_vars['error']->value))) {?>
            <?php echo '<script'; ?>
 type="text/javascript">
                alert('<?php echo $_smarty_tpl->tpl_vars['error']->value;?>
');
            <?php echo '</script'; ?>
>
        <?php }?>

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
<?php }
}
