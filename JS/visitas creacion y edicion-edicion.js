document.addEventListener('DOMContentLoaded', function () {
<<<<<<< HEAD
    const formElement = document.querySelector('form'); // Formulario principal

    if (formElement) {
        formElement.addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar el envío predeterminado

            const formData = new FormData(formElement); // Capturar los datos del formulario

            fetch("visitas-creación-y-edición-edición.php", { // Ruta correcta
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("Información guardada con éxito")) {
                    alert("Información guardada correctamente.");
                    formElement.reset(); // Limpia el formulario tras el guardado
                    window.location.href = 'visitas-ceación y edición.html'; // Redirige a la página principal
                } else {
                    alert("Error del servidor: " + data);
                }
            })
            .catch(error => {
                console.error("Error al guardar la información:", error);
                alert("Hubo un problema al guardar la información. Intenta de nuevo.");
            });
        });
=======
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

    // Obtener referencias a los elementos del formulario
    const formElement = document.querySelector('form'); // Referencia al formulario
    const saveButton = document.querySelector('button[type="submit"]');
    const backButton = document.querySelector('.btn-back');

    if (formElement && saveButton && backButton) {
        // Función para enviar información al servidor
        saveButton.addEventListener('click', function (event) {
            event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

            const formData = new FormData(formElement); // Capturar los datos del formulario

            fetch("visitas-creación y edición-edición.php", { // Ruta del archivo PHP
                method: "POST", // Método POST para enviar los datos
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.text(); // Obtener texto de la respuesta
            })
            .then(data => {
                if (data.includes("Información guardada con éxito")) { // Verificar el mensaje del servidor
                    alert("Información guardada correctamente.");
                    formElement.reset(); // Limpia el formulario tras el guardado exitoso
                    window.location.href = 'visitas-creación-y-edición.html'; // Redirige después de guardar
                } else {
                    alert("Error del servidor: " + data); // Muestra cualquier mensaje de error del servidor
                }
            })
            .catch(error => {
                console.error("Error al enviar los datos:", error);
                alert("Ocurrió un error al intentar guardar la información. Por favor, inténtalo nuevamente.");
            });
        });

        // Función para regresar a la página anterior
        backButton.addEventListener('click', function () {
            window.location.href = 'visitas-creación-y-edición.html'; // Página de regreso
        });
    } else {
        console.error("Error: Elementos del formulario no encontrados.");
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
    }
});
