document.addEventListener("DOMContentLoaded", function () {
    const addStudentBtn = document.getElementById("add-student-btn");
    const modal = document.getElementById("add-student-modal");
    const closeModal = document.querySelector(".close");
    const addStudentForm = document.getElementById("add-student-form"); // Инициализация переменной формы

    // Открытие модального окна
    addStudentBtn.addEventListener("click", function () {
        modal.classList.add("show");
    });

    // Закрытие модального окна
    closeModal.addEventListener("click", function () {
        modal.classList.remove("show");
    });

    // Закрытие при клике вне окна
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.classList.remove("show");
        }
    });

    // Обработка отправки формы
    addStudentForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(addStudentForm);
        // console.log(...formData.entries());

        fetch('../actions/add_student.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // При успешном добавлении ученика
                modal.classList.remove("show");
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