document.addEventListener("DOMContentLoaded", function () {
    const assignTeacherBtn = document.getElementById("assign-teacher-btn");
    const assignTeacherModal = document.getElementById("assign-teacher-modal");
    const closeModal = assignTeacherModal.querySelector(".close");
    const assignTeacherForm = document.getElementById("assign-teacher-form");
    const classSelect = document.getElementById("class"); // Для фильтрации
    const modalClassSelect = document.getElementById("modal_class_id"); // Для модального окна
    const teacherSelect = document.getElementById("teacher_id");

    // Открытие модального окна
    assignTeacherBtn.addEventListener("click", function () {
        assignTeacherModal.classList.add("show");
    });

    // Закрытие модального окна
    closeModal.addEventListener("click", function () {
        assignTeacherModal.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        if (event.target === assignTeacherModal) {
            assignTeacherModal.classList.remove("show");
        }
    });

    // Функция для загрузки преподавателя по выбранному классу
    function loadTeacherForClass(classId) {
        if (classId) {
            fetch(`../actions/get_teacher.php?class_id=${classId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Выбираем преподавателя, если он есть
                        teacherSelect.value = data.teacher_id || ''; // Если преподаватель не найден, сбрасываем
                    } else {
                        alert('Ошибка при получении преподавателя.');
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Произошла ошибка. Попробуйте снова.');
                });
        } else {
            // Если класс не выбран, сбрасываем поле преподавателя
            teacherSelect.value = '';
        }
    }

    // Обработчик изменения класса в фильтре
    classSelect.addEventListener("change", function () {
        loadTeacherForClass(classSelect.value);
    });

    // Обработчик изменения класса в модальном окне
    modalClassSelect.addEventListener("change", function () {
        loadTeacherForClass(modalClassSelect.value);
    });

    // Если класс уже выбран при открытии модального окна
    if (modalClassSelect.value) {
        loadTeacherForClass(modalClassSelect.value);
    }

    // Обработка отправки формы
    assignTeacherForm.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(assignTeacherForm);

        fetch('../actions/assign_teacher.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                assignTeacherModal.classList.remove("show");
                location.reload();
            } else {
                alert('Ошибка: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка. Попробуйте снова.');
        });
    });
});
