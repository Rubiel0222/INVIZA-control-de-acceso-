// Función para actualizar la hora actual
function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
}

// Llama a la función para actualizar la hora cada segundo
setInterval(updateTime, 1000);
updateTime(); // Llama la función al cargar la página

// Función para manejar los botones de navegación
document.querySelectorAll('.actions button, .button-container button').forEach(button => {
    button.addEventListener('click', (event) => {
        window.location.href = event.target.getAttribute('onclick').split("'")[1];
    });
});
