document.addEventListener('DOMContentLoaded', function () {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString();
        }
    }
    setInterval(updateTime, 1000); // Actualiza cada segundo
    updateTime(); // Llama la función al cargar la página

    // Referencias a los elementos clave
    const formElement = document.querySelector('form'); // Formulario principal o de edición
    const saveButton = document.querySelector('button[type="submit"]'); // Botón para guardar
    const backButton = document.querySelector('.btn-back'); // Botón para regresar
    const agregarButton = document.getElementById('btn-agregar'); // Botón para agregar nuevo registro

    // Función para enviar información al servidor desde el formulario de edición
    if (formElement && saveButton) {
        saveButton.addEventListener('click', function (event) {
            event.preventDefault(); // Evita el envío predeterminado del formulario

            const formData = new FormData(formElement); // Capturar los datos del formulario

            fetch("guardar-datos.php", { // Ruta del archivo PHP para guardar datos
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("Información guardada con éxito")) {
                    alert("Información guardada correctamente.");
                    formElement.reset(); // Limpia el formulario tras el guardado
                    window.location.href = 'visitas-creación-y-edición.html'; // Redirige a la página principal
                } else {
                    alert("Error del servidor: " + data);
                }
            })
            .catch(error => {
                console.error("Error al guardar la información:", error);
                alert("Hubo un problema al guardar la información. Intenta de nuevo.");
            });
        });
    }

    // Función para regresar a la página principal desde cualquier acción
    if (backButton) {
        backButton.addEventListener('click', function () {
            window.location.href = 'visitas-creación-y-edición.html'; // Página de regreso
        });
    }

    // Función para redirigir al formulario de edición al hacer clic en "Agregar nuevo registro"
    if (agregarButton) {
        agregarButton.addEventListener('click', function (event) {
            event.preventDefault(); // Previene cualquier acción predeterminada
            window.location.href = 'visitas-creación-y-edición-edición.html'; // Redirige al formulario de edición
        });
    }
});
