document.addEventListener("DOMContentLoaded", function () {
    const statsModal = document.getElementById("stats-modal");
    const closeBtn = statsModal.querySelector(".close");
    const statsContent = document.getElementById("stats-content");

    document.querySelector(".stats-btn").addEventListener("click", function () {
        statsModal.classList.add("show");
        loadStatistics();
    });

    closeBtn.addEventListener("click", function () {
        statsModal.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        if (event.target === statsModal) {
            statsModal.classList.remove("show");
        }
    });

    function loadStatistics() {
        fetch("../actions/get_statistics.php") // Запрос к серверу
            .then(response => response.json())
            .then(data => {
                // Nаблица с младшим учеником
                const youngest = data.youngest_student;
                document.getElementById("youngest-student").innerHTML = `
                    <tr>
                        <td>${youngest.id}</td>
                        <td>${youngest.name}</td>
                        <td>${youngest.birth_date}</td>
                        <td>${youngest.class}</td>
                    </tr>
                `;

                // Таблица с количеством учеников в вторых классов
                let secondGradeHtml = "";
                data.second_grades.forEach(item => {
                    secondGradeHtml += `
                        <tr>
                            <td>${item.class}</td>
                            <td>${item.count}</td>
                        </tr>
                    `;
                });
                document.getElementById("second-grade-count").innerHTML = secondGradeHtml;

                // Таблица с количеством учеников у преподавателя
                let teachersHtml = "";
                data.teachers.forEach(teacher => {
                    teachersHtml += `
                        <tr>
                            <td>${teacher.name}</td>
                            <td>${teacher.count}</td>
                        </tr>
                    `;
                });
                document.getElementById("teachers-stats").innerHTML = teachersHtml;
            })
            .catch(error => {
                console.error("Ошибка загрузки статистики:", error);
                statsContent.innerHTML = "Ошибка загрузки данных.";
            });
    }
});
