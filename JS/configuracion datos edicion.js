document.addEventListener('DOMContentLoaded', () => {
    updateTime();
    setInterval(updateTime, 1000); // Actualiza la hora cada segundo
});

function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
}

function guardarInformacion() {
    const form = document.getElementById('dataForm');
    const formData = new FormData(form);

    const data = {
        tipoVisualizacion: formData.get('tipoVisualizacion'),
        etiqueta: formData.get('etiqueta'),
        nombre: formData.get('nombre'),
        activo: formData.get('activo'),
        campoObligatorio: formData.get('campoObligatorio'),
        tipo: formData.get('tipo'),
        apareceEnImpresion: formData.get('apareceEnImpresion'),
        orden: formData.get('orden'),
        style: formData.get('style'),
        valores: formData.get('valores')
    };

    // Aquí puedes añadir la lógica para guardar la información en la base de datos
    console.log(data); // Imprime los datos en la consola para verificar

    // Simulación de guardado
    alert('Información guardada: ' + JSON.stringify(data));
}

// Función para sincronizar con la base de datos
function sincronizarConBaseDeDatos(action, data) {
    // Lógica para realizar operaciones CRUD con la base de datos
    // Puede ser una llamada AJAX, fetch API, etc.
    // Ejemplo:
    /*
    fetch('URL_DE_TU_API', {
        method: 'POST', // o 'PUT', 'DELETE' según la acción
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Éxito:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    */
}
