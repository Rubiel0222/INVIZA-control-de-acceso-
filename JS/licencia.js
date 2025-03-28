// Función para actualizar la hora actual
function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
}

setInterval(updateTime, 1000); // Actualiza cada segundo
updateTime(); // Llama a la función al cargar la página

// Otras funcionalidades que se pueden agregar en el futuro
