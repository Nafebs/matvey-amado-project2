document.getElementById("toggle-password").addEventListener("click", function() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.textContent = "🙈";
    } else {
        passwordInput.type = "password";
        eyeIcon.textContent = "👁️";
    }
});