document.addEventListener('DOMContentLoaded', () => {
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
