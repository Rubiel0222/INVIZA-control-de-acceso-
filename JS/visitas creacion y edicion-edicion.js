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

    // Obtener referencias a los botones del formulario
    const saveButton = document.querySelector('button[type="submit"]');
    const backButton = document.querySelector('.btn-back');
    const formElement = document.querySelector('form'); // Referencia al formulario

    if (saveButton && backButton && formElement) {
        // Función de guardar información
        saveButton.addEventListener('click', function (event) {
            event.preventDefault();

            const formData = new FormData(formElement); // Capturar datos del formulario

            fetch("visitas-creación y edición-edición.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar mensaje del servidor
                formElement.reset(); // Limpiar el formulario tras guardar la información
            })
            .catch(error => console.error("Error al guardar la información:", error));
        });

        // Función de regreso a la página anterior
        backButton.addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = 'visitas-creación y edición.html'; // Página de regreso
        });
    } else {
        console.error("Error: Los elementos del formulario no se encontraron.");
    }
});
