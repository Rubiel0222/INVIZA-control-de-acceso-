document.addEventListener('DOMContentLoaded', () => {
    updateTime();
    setInterval(updateTime, 1000); // Actualiza la hora cada segundo

    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault(); // Evita el envío normal del formulario

        const username = document.querySelector('input[name="username"]').value;
        const password = document.querySelector('input[name="password"]').value;

        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);

        try {
            const response = await fetch('inicio_sesion.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.text();

            if (result === 'success') {
                window.location.href = 'pagina_inicial.html';
            } else {
                alert('Usuario o contraseña incorrectos');
            }
        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
            alert('Ocurrió un error. Inténtalo de nuevo más tarde.');
        }
    });
});

function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
}
