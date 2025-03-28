document.addEventListener('DOMContentLoaded', () => {
<<<<<<< HEAD
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault(); // Evita el envío normal del formulario

        const username = document.querySelector('input[name="username"]').value;
        const password = document.querySelector('input[name="password"]').value;

        // Configurar los datos a enviar al servidor
        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);

        try {
            // Enviar los datos al archivo PHP mediante una solicitud fetch
            const response = await fetch('inicio secion.php', {
                method: 'POST',
                body: formData
            });

            // Procesar la respuesta del servidor
            const result = await response.text();

            if (result === 'success') {
                // Redirigir al usuario si los datos son válidos
                window.location.href = 'pagina_inicial.html';
            } else {
                // Mostrar un mensaje de error si los datos no son válidos
                alert('Usuario o contraseña incorrectos');
            }
        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
            alert('Ocurrió un error. Inténtalo de nuevo más tarde.');
        }
    });
});
=======
    updateTime();
    setInterval(updateTime, 1000); // Actualiza la hora cada segundo

    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto
        iniciarSesion();
    });
});

function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
}

function iniciarSesion() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Aquí puedes añadir la lógica para verificar el usuario y la contraseña
    // Ejemplo simple:
    if (username === "admin" && password === "1234") {
        window.location.href = 'modulos.html'; // Redirige a los módulos
    } else {
        alert('Usuario o contraseña incorrectos');
    }
}
>>>>>>> 944b20541e68cd4c295093a72d664e7473037f61
