document.addEventListener('DOMContentLoaded', function () {
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
    }
});
