document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    const approveButton = document.getElementById('approveButton');
    const disapproveButton = document.getElementById('disapproveButton');

    registerForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío predeterminado del formulario

        const fullName = document.getElementById('fullName').value;
        const email = document.getElementById('email').value;
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        // Validación básica
        if (fullName && email && username && password === confirmPassword) {
            alert('Registro exitoso');
            approveButton.disabled = false;
            disapproveButton.disabled = true;
            window.location.href = 'inicio.html'; // Redirigir a la página de inicio
        } else {
            alert('Error en el registro. Por favor, revisa los campos.');
            approveButton.disabled = true;
            disapproveButton.disabled = false;
        }
    });
});

