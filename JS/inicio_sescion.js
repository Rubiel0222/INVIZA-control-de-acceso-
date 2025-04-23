document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");

    if (!loginForm) {
        console.error("Error: No se encontró el formulario 'loginForm'.");
        return;
    }

    loginForm.addEventListener("submit", async function(event) {
        event.preventDefault(); // Evita el envío normal del formulario

        const nombre_usuario = document.querySelector('input[name="nombre_usuario"]').value;
        const password = document.querySelector('input[name="password"]').value;

        console.log("Usuario ingresado:", nombre_usuario);
        console.log("Contraseña ingresada:", password);

        // Validación antes de enviar los datos
        if (!nombre_usuario || !password) {
            alert("Por favor, completa todos los campos.");
            return;
        }

        try {
            const requestBody = JSON.stringify({ nombre_usuario, password });
            console.log("Enviando:", requestBody);

            const response = await fetch("http://localhost/inviza/inicio_sesion.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: requestBody
            });

            // Validar si la respuesta es válida antes de parsearla
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }

            const data = await response.json();
            console.log("Respuesta del servidor:", data);

            if (data.status === "success") {
                alert("Inicio de sesión exitoso");
                window.location.href = "pagina_inicial.html"; // Redirige al usuario
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error("Error al realizar la solicitud:", error);
            alert("Error al conectar con el servidor. Inténtalo de nuevo.");
        }
    });
});
