document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        event.preventDefault();  // Предотвращение стандартной отправки формы

        const formData = new FormData(form);

        fetch('login.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'  // Запрос отправляется через AJAX
            }
        })
        .then(response => response.json())  // Ожидание JSON-ответа
        .then(data => {
            if (data.success) {
                window.location.href = '../public/index.php';  // Перенаправление на главную страницу
            } else {
                alert(data.error);
            }
        })
        .catch(() => {
            alert('Произошла ошибка при отправке формы.');
        });
    });
});
