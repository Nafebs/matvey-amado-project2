document.addEventListener("DOMContentLoaded", function () {
    const deleteButton = document.getElementById("delete-button");
    const checkboxes = document.querySelectorAll(".student-checkbox");

    // Удаление выбранных учеников
    deleteButton.addEventListener("click", function (e) {
        e.preventDefault();
        let selectedIds = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        // Подтверждение удаления
        if (selectedIds.length > 0 && confirm("Вы уверены, что хотите удалить выбранных учеников?")) {
            fetch("../actions/delete.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `ids=${encodeURIComponent(selectedIds.join(","))}`,
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert("Ошибка при удалении учеников");
                }
            })
            .catch(error => {
                alert("Ошибка при удалении учеников: " + error);
            });
        }
    });
});
