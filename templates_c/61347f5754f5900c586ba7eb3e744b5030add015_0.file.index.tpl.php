<?php
/* Smarty version 4.3.0, created on 2025-03-09 17:23:47
  from 'C:\xampp\htdocs\amado_project\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.0',
  'unifunc' => 'content_67cdc093e18d29_94717065',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '61347f5754f5900c586ba7eb3e744b5030add015' => 
    array (
      0 => 'C:\\xampp\\htdocs\\amado_project\\templates\\index.tpl',
      1 => 1741537424,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67cdc093e18d29_94717065 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
    <meta charset="utf-8">
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

    <link rel="stylesheet" href="css/main_style.css">
    <?php echo '<script'; ?>
 src="scripts/main.js" defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="scripts/modal.js" defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="scripts/delete.js" defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="scripts/assign_teacher.js" defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="scripts/stats_modal.js" defer><?php echo '</script'; ?>
>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <h1 class="page-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
            <?php if ((isset($_smarty_tpl->tpl_vars['username']->value))) {?>
                <p class="user-info">Вы вошли как <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
            <?php }?>
        </div>
        <div class="header">
            <div class="header-buttons">
                <div class="buttons-container">
                    <form id="delete-form" method="POST" action="../actions/delete.php">
                        <input type="hidden" name="delete_ids" id="delete-ids">
                        <button type="submit" id="delete-button" class="btn btn-danger" disabled>Удалить</button>
                    </form>
                    <button id="add-student-btn" class="btn btn-success">Добавить ученика</button>
                    <button id="assign-teacher-btn" class="btn btn-success">Назначить учителя</button>
                    <button id="stats-btn" class="btn btn-primary stats-btn">Статистика</button>
                    <form action="../actions/logout.php" method="POST">
                        <button type="submit" class="btn btn-danger">Выйти из системы</button>
                    </form>
                </div>

                <form method="GET" class="filter-form">
                    <input type="text" name="search" value="<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
" placeholder="Поиск по ID, имени, фамилии и отчеству" />
                    <select name="class" id="class">
                        <option value="">Выберите класс</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classes']->value, 'class');
$_smarty_tpl->tpl_vars['class']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['class']->value) {
$_smarty_tpl->tpl_vars['class']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['class']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['class']->value['id'] == $_smarty_tpl->tpl_vars['class_filter']->value) {?>selected<?php }?>>
                                <?php echo $_smarty_tpl->tpl_vars['class']->value['class_name'];?>

                            </option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                    <button type="submit" class="btn btn-primary">Найти</button>
                    <a href="index.php" class="btn btn-danger reset-button">Сбросить</a>
                </form>
            </div>
        </div>

        <div class="table-container">
            <table>
                <tr class="ignore-hover">
                    <th>
                        <div class="student-checkbox-container">
                            <input type="checkbox" id="select-all" class="student-main-checkbox">
                        </div>
                    </th>
                    <th>
                        <a href="?sort=id&order=<?php echo $_smarty_tpl->tpl_vars['next_order']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&class=<?php echo $_smarty_tpl->tpl_vars['class_filter']->value;?>
">
                            ID <span class="sort-icon"><?php if ($_smarty_tpl->tpl_vars['sort']->value == 'id') {
if ($_smarty_tpl->tpl_vars['order']->value == 'ASC') {?>▲<?php } else { ?>▼<?php }
}?></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=second_name&order=<?php echo $_smarty_tpl->tpl_vars['next_order']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&class=<?php echo $_smarty_tpl->tpl_vars['class_filter']->value;?>
">
                            Фамилия <span class="sort-icon"><?php if ($_smarty_tpl->tpl_vars['sort']->value == 'second_name') {
if ($_smarty_tpl->tpl_vars['order']->value == 'ASC') {?>▲<?php } else { ?>▼<?php }
}?></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=first_name&order=<?php echo $_smarty_tpl->tpl_vars['next_order']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&class=<?php echo $_smarty_tpl->tpl_vars['class_filter']->value;?>
">
                            Имя <span class="sort-icon"><?php if ($_smarty_tpl->tpl_vars['sort']->value == 'first_name') {
if ($_smarty_tpl->tpl_vars['order']->value == 'ASC') {?>▲<?php } else { ?>▼<?php }
}?></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=patronymic&order=<?php echo $_smarty_tpl->tpl_vars['next_order']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&class=<?php echo $_smarty_tpl->tpl_vars['class_filter']->value;?>
">
                            Отчество <span class="sort-icon"><?php if ($_smarty_tpl->tpl_vars['sort']->value == 'patronymic') {
if ($_smarty_tpl->tpl_vars['order']->value == 'ASC') {?>▲<?php } else { ?>▼<?php }
}?></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=birth_date&order=<?php echo $_smarty_tpl->tpl_vars['next_order']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&class=<?php echo $_smarty_tpl->tpl_vars['class_filter']->value;?>
">
                            Дата рождения <span class="sort-icon"><?php if ($_smarty_tpl->tpl_vars['sort']->value == 'birth_date') {
if ($_smarty_tpl->tpl_vars['order']->value == 'ASC') {?>▲<?php } else { ?>▼<?php }
}?></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=class_name&order=<?php echo $_smarty_tpl->tpl_vars['next_order']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&class=<?php echo $_smarty_tpl->tpl_vars['class_filter']->value;?>
">
                            Класс <span class="sort-icon"><?php if ($_smarty_tpl->tpl_vars['sort']->value == 'class_name') {
if ($_smarty_tpl->tpl_vars['order']->value == 'ASC') {?>▲<?php } else { ?>▼<?php }
}?></span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=teacher_name&order=<?php echo $_smarty_tpl->tpl_vars['next_order']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
&class=<?php echo $_smarty_tpl->tpl_vars['class_filter']->value;?>
">
                            Учитель <span class="sort-icon"><?php if ($_smarty_tpl->tpl_vars['sort']->value == 'teacher_name') {
if ($_smarty_tpl->tpl_vars['order']->value == 'ASC') {?>▲<?php } else { ?>▼<?php }
}?></span>
                        </a>
                    </th>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['students']->value, 'student');
$_smarty_tpl->tpl_vars['student']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['student']->value) {
$_smarty_tpl->tpl_vars['student']->do_else = false;
?>
                <tr>
                    <td>
                        <div class="student-checkbox-container">
                            <input type="checkbox" class="student-checkbox" value="<?php echo $_smarty_tpl->tpl_vars['student']->value['id'];?>
">
                        </div>
                    </td>
                    <td><?php echo $_smarty_tpl->tpl_vars['student']->value['id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['student']->value['second_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['student']->value['first_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['student']->value['patronymic'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['student']->value['birth_date'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['student']->value['class_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['student']->value['teacher_name'];?>
</td>
                </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </table>
        </div>

        <!-- Модальное окно для добавления ученика -->
        <div id="add-student-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Добавить ученика</h2>
                <form id="add-student-form">
                    <label for="first_name">Имя:</label>
                    <input type="text" id="first_name" name="first_name" required>

                    <label for="second_name">Фамилия:</label>
                    <input type="text" id="second_name" name="second_name" required>

                    <label for="patronymic">Отчество:</label>
                    <input type="text" id="patronymic" name="patronymic" required>

                    <label for="birth_date">Дата рождения:</label>
                    <input type="date" id="birth_date" name="birth_date" required>

                    <label for="class_id">Класс:</label>
                    <select id="class_id" name="class_id" required>
                        <option value="">Выберите класс</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classes']->value, 'class');
$_smarty_tpl->tpl_vars['class']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['class']->value) {
$_smarty_tpl->tpl_vars['class']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['class']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['class']->value['class_name'];?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>

                    <button type="submit" class="btn btn-success">Добавить</button>
                </form>
            </div>
        </div>

        <!-- Модальное окно для назначения преподавателя -->
        <div id="assign-teacher-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Назначить учителя</h2>
                <form id="assign-teacher-form">
                    <label for="modal_class_id">Класс:</label>
                    <select id="modal_class_id" name="class_id" required>
                        <option value="">Выберите класс</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classes']->value, 'class');
$_smarty_tpl->tpl_vars['class']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['class']->value) {
$_smarty_tpl->tpl_vars['class']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['class']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['class']->value['class_name'];?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>

                    <label for="teacher_id">Преподаватель:</label>
                    <select id="teacher_id" name="teacher_id" required>
                        <option value="">Выберите преподавателя</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['teachers']->value, 'teacher');
$_smarty_tpl->tpl_vars['teacher']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['teacher']->value) {
$_smarty_tpl->tpl_vars['teacher']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['teacher']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['teacher']->value['name'];?>
</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>

                    <button type="submit" class="btn btn-success">Назначить</button>
                </form>
            </div>
        </div>

        <!-- Модальное окно статистики -->
        <div id="stats-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Статистика</h2>

                <!-- Таблица для младшего ученика -->
                <h3>Самый младший ученик</h3>
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Дата рождения</th>
                            <th>Класс</th>
                        </tr>
                    </thead>
                    <tbody id="youngest-student">
                        <!-- Данные вставляются через JS -->
                    </tbody>
                </table>

                <!-- Таблица для количества учеников во вторых классах -->
                <h3>Ученики во вторых классах</h3>
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>Классы</th>
                            <th>Количество учеников</th>
                        </tr>
                    </thead>
                    <tbody id="second-grade-count">
                        <!-- Данные вставляются через JS -->
                    </tbody>
                </table>

                <!-- Таблица для количества учеников у учителей -->
                <h3>Количество учеников у учителей</h3>
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>Преподаватель</th>
                            <th>Количество учеников</th>
                        </tr>
                    </thead>
                    <tbody id="teachers-stats">
                        <!-- Данные вставляются через JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php }
}
