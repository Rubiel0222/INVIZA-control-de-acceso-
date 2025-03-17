document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita el envío predeterminado del formulario

        const nombre_apellido = document.getElementById('nombre_apellido').value.trim();
        const email = document.getElementById('email').value.trim();
        const usuario = document.getElementById('usuario').value.trim();
        const password = document.getElementById('password').value.trim();

        // Validación básica en el lado del cliente
        if (nombre_apellido && email && usuario && password) {
            const formData = new FormData(registerForm); // Automáticamente recoge los campos del formulario

            fetch('usuarios.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Muestra el mensaje del servidor (éxito o error)
                    if (data.includes("Registro exitoso")) {
                        window.location.href = 'inicio_sesion.html'; // Redirige si el registro fue exitoso
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error en el registro. Por favor, intenta nuevamente.');
                });
        } else {
            alert('Error: Todos los campos son obligatorios.');
        }
    });
});
