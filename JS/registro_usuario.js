<<<<<<< HEAD
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita el envío predeterminado del formulario

        // Recopila los datos del formulario
        const formData = new FormData(registerForm);

        fetch('usuarios.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Procesar la respuesta JSON del servidor
        .then(data => {
            if (data.status === "success") {
                alert(data.message); // Mostrar mensaje de éxito
                window.location.href = 'inicio_sesion.html'; // Redirigir al inicio de sesión
            } else {
                alert(data.message); // Mostrar mensaje de error
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al procesar el registro. Intenta nuevamente.');
        });
    });
});
=======
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita el envío predeterminado del formulario

        // Recopila los datos del formulario
        const formData = new FormData(registerForm);

        fetch('usuarios.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json()) // Procesar la respuesta JSON del servidor
            .then(data => {
                if (data.status === "success") {
                    alert(data.message); // Mostrar mensaje de éxito
                    window.location.href = 'inicio_sesion.html'; // Redirigir al inicio de sesión
                } else {
                    alert(data.message); // Mostrar mensaje de error
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar el registro. Intenta nuevamente.');
            });
    });
});
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
