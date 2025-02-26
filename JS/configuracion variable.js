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
        licencia: formData.get('licencia'),
        rutaOperadores: formData.get('rutaOperadores'),
        ingresoFormulario: formData.get('ingresoFormulario'),
        salidaFacil: formData.get('salidaFacil'),
        usarCitofonia: formData.get('usarCitofonia'),
        tipoCarnetVisitantes: formData.get('tipoCarnetVisitantes'),
        tipoCarnetInscripcion: formData.get('tipoCarnetInscripcion'),
        detalleFuncionarios: formData.get('detalleFuncionarios'),
        festivos: formData.get('festivos'),
        horarioDiurno: formData.get('horarioDiurno'),
        minutos: formData.get('minutos'),
        maximaHoras: formData.get('maximaHoras'),
        recordarCampo: formData.get('recordarCampo'),
        logoEtiquetas: formData.get('logoEtiquetas')
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
