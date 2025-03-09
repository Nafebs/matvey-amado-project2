<html>
<head>
    <meta charset="utf-8">
    <title>{$title}</title>

    <link rel="stylesheet" href="css/main_style.css">
    <script src="scripts/main.js" defer></script>
    <script src="scripts/modal.js" defer></script>
    <script src="scripts/delete.js" defer></script>
    <script src="scripts/assign_teacher.js" defer></script>
    <script src="scripts/stats_modal.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <h1 class="page-title">{$title}</h1>
            {if isset($username)}
                <p class="user-info">Вы вошли как {$username}</p>
            {/if}
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
                    <input type="text" name="search" value="{$search}" placeholder="Поиск по ID, имени, фамилии и отчеству" />
                    <select name="class" id="class">
                        <option value="">Выберите класс</option>
                        {foreach from=$classes item=class}
                            <option value="{$class.id}" {if $class.id == $class_filter}selected{/if}>
                                {$class.class_name}
                            </option>
                        {/foreach}
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
                        <a href="?sort=id&order={$next_order}&search={$search}&class={$class_filter}">
                            ID <span class="sort-icon">{if $sort == 'id'}{if $order == 'ASC'}▲{else}▼{/if}{/if}</span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=second_name&order={$next_order}&search={$search}&class={$class_filter}">
                            Фамилия <span class="sort-icon">{if $sort == 'second_name'}{if $order == 'ASC'}▲{else}▼{/if}{/if}</span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=first_name&order={$next_order}&search={$search}&class={$class_filter}">
                            Имя <span class="sort-icon">{if $sort == 'first_name'}{if $order == 'ASC'}▲{else}▼{/if}{/if}</span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=patronymic&order={$next_order}&search={$search}&class={$class_filter}">
                            Отчество <span class="sort-icon">{if $sort == 'patronymic'}{if $order == 'ASC'}▲{else}▼{/if}{/if}</span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=birth_date&order={$next_order}&search={$search}&class={$class_filter}">
                            Дата рождения <span class="sort-icon">{if $sort == 'birth_date'}{if $order == 'ASC'}▲{else}▼{/if}{/if}</span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=class_name&order={$next_order}&search={$search}&class={$class_filter}">
                            Класс <span class="sort-icon">{if $sort == 'class_name'}{if $order == 'ASC'}▲{else}▼{/if}{/if}</span>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=teacher_name&order={$next_order}&search={$search}&class={$class_filter}">
                            Учитель <span class="sort-icon">{if $sort == 'teacher_name'}{if $order == 'ASC'}▲{else}▼{/if}{/if}</span>
                        </a>
                    </th>
                </tr>
                {foreach from=$students item=student}
                <tr>
                    <td>
                        <div class="student-checkbox-container">
                            <input type="checkbox" class="student-checkbox" value="{$student.id}">
                        </div>
                    </td>
                    <td>{$student.id}</td>
                    <td>{$student.second_name}</td>
                    <td>{$student.first_name}</td>
                    <td>{$student.patronymic}</td>
                    <td>{$student.birth_date}</td>
                    <td>{$student.class_name}</td>
                    <td>{$student.teacher_name}</td>
                </tr>
                {/foreach}
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
                        {foreach from=$classes item=class}
                            <option value="{$class.id}">{$class.class_name}</option>
                        {/foreach}
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
                        {foreach from=$classes item=class}
                            <option value="{$class.id}">{$class.class_name}</option>
                        {/foreach}
                    </select>

                    <label for="teacher_id">Преподаватель:</label>
                    <select id="teacher_id" name="teacher_id" required>
                        <option value="">Выберите преподавателя</option>
                        {foreach from=$teachers item=teacher}
                            <option value="{$teacher.id}">{$teacher.name}</option>
                        {/foreach}
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
