document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        timeElement.textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000); // Actualiza cada segundo
    updateTime(); // Llama la función al cargar la página

    // Obtener referencias a los botones del formulario
    const saveButton = document.querySelector('button[type="submit"]');
    const backButton = document.querySelector('.btn-back');

    // Función de guardar información
    saveButton.addEventListener('click', function(event) {
        event.preventDefault();
        // Aquí puedes añadir la lógica para guardar la información, por ahora solo muestra una alerta
        alert('Información guardada correctamente');
    });

    // Función de regreso a la página anterior
    backButton.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'visitas_creacion_y_edicion.html';
    });
});
