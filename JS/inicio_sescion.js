document.addEventListener('DOMContentLoaded', () => {
    updateTime();
    setInterval(updateTime, 1000); // Actualiza la hora cada segundo

    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault(); // Evita el envío normal del formulario

        const username = document.querySelector('input[name="username"]').value;
        const password = document.querySelector('input[name="password"]').value;

        // Validación utilizando fetch y la API en validate.php
        try {
            const response = await fetch("http://localhost/inviza/inicio_sesion.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: new URLSearchParams({
                    username: username,
                    password: password
                })
            });

            const data = await response.json();

            // Manejo de la respuesta
            if (data.status === "success") {
                alert(data.message);
                window.location.href = 'pagina_inicial.html'; // Redirige al usuario
            } else {
                alert(data.message); // Muestra mensaje de error
            }
        } catch (error) {
            console.error("Error al realizar la solicitud:", error);
            alert("Ocurrió un error. Inténtalo de nuevo más tarde.");
        }
    });
});

function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
}
