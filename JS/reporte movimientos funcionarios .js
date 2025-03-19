document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        timeElement.textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime(); // Llama la función al cargar la página

    // Función para manejar la generación del informe
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto
        const formato = document.getElementById('seleccionar').value;
        if (formato === 'excel') {
            alert('Generar informe en Excel');
        } else if (formato === 'pdf') {
            alert('Generar informe en PDF');
        } else {
            alert('Por favor, selecciona un formato de informe');
        }
    });
});
