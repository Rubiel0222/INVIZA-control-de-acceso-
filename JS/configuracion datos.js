document.addEventListener('DOMContentLoaded', () => {
    updateTime();
    setInterval(updateTime, 1000); // Actualiza la hora cada segundo

    // Función para agregar un nuevo dato
    document.querySelector('button[onclick="alert(\'Agregar nuevo dato\')"]').onclick = agregarDato;

    // Funciones para editar y borrar ya están definidas en HTML
});

function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
}

function agregarDato() {
    const tbody = document.querySelector('table tbody');
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td contenteditable="true"></td>
        <td contenteditable="true"></td>
        <td contenteditable="true"></td>
        <td contenteditable="true"></td>
        <td contenteditable="true"></td>
        <td contenteditable="true"></td>
        <td contenteditable="true"></td>
        <td>
            <button onclick="editarFila(this)">Editar</button>
            <button onclick="borrarFila(this)">Borrar</button>
        </td>
    `;

    tbody.appendChild(newRow);
}

function editarFila(button) {
    const row = button.parentElement.parentElement;
    alert('Editar fila ' + row.rowIndex);
    // Implementa la lógica para editar la fila y sincronizar con la base de datos
    sincronizarConBaseDeDatos('editar', {/* Datos a editar */});
}

function borrarFila(button) {
    const row = button.parentElement.parentElement;
    row.remove();
    alert('Fila borrada');
    // Implementa la lógica para borrar la fila en la base de datos
    sincronizarConBaseDeDatos('borrar', {/* ID de la fila a borrar */});
}

function sincronizarConBaseDeDatos(action, data) {
    // Lógica para realizar operaciones CRUD con la base de datos
    // Puede ser una llamada AJAX, fetch API, etc.
    fetch('URL_DE_TU_API', {
        method: action === 'borrar' ? 'DELETE' : 'POST', // O 'PUT' si es editar
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
}
