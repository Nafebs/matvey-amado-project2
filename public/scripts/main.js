document.addEventListener("DOMContentLoaded", function () {
    // Общие действия на странице
    const selectAllCheckbox = document.getElementById("select-all");
    const checkboxes = document.querySelectorAll(".student-checkbox");
    const deleteButton = document.getElementById("delete-button");

    // Логика обновления кнопки "Удалить"
    function updateDeleteButton() {
        let selected = Array.from(checkboxes).filter(cb => cb.checked).length;
        let buttonText = "Удалить";
        if (selected > 0) {
            buttonText = `Удалить ${selected} ${getDeclension(selected)}`;
            deleteButton.disabled = false;
            deleteButton.style.background = "#dc3545";
        } else {
            deleteButton.disabled = true;
            deleteButton.style.background = "#ccc";
        }
        deleteButton.textContent = buttonText;
    }

    // Получение склонения
    function getDeclension(number) {
        if (number % 10 === 1 && number % 100 !== 11) {
            return "ученика";
        } else {
            return "учеников";
        }
    }

    // Обработчик для выбора всех учеников
    selectAllCheckbox.addEventListener("change", function () {
        checkboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
        updateDeleteButton();
    });

    // Обработчик для каждого чекбокса
    checkboxes.forEach(cb => {
        cb.addEventListener("change", updateDeleteButton);
    });
});

