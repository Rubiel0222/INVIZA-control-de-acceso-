
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        const nombre_usuario = document.getElementById("nombre_usuario").value.trim();
        const password = document.getElementById("password").value.trim();

        if (!nombre_usuario || !password) {
            alert("Por favor, completa todos los campos.");
            return;
        }

        try {
            const response = await fetch("inicio_sesion.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ nombre_usuario, password })
            });

            const result = await response.json();

            if (result.status === "success") {
                // Redirige al panel principal
                window.location.href = "index.php";
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Error al conectar con el servidor.");
        }
    });
});
