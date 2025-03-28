// Obtener los elementos del DOM
const currentTime = document.getElementById('currentTime');
const addButton = document.querySelector('.add-button');
const editButtons = document.querySelectorAll('.edit-button');
const deleteButtons = document.querySelectorAll('.delete-button');
const searchInput = document.querySelector('.footer-controls input[type="text"]');
const rowsPerPageSelect = document.querySelector('.footer-controls select');
const pageNumberSelect = document.querySelector('.footer-controls select:nth-of-type(2)');
const goToPageButton = document.querySelector('.footer-controls button');

// Función para mostrar la hora actual
function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    currentTime.textContent = `${hours}:${minutes}`;
}

setInterval(updateTime, 1000);
updateTime();

// Función para agregar un nuevo horario
function addHorario() {
    const tbody = document.querySelector('tbody');
    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td contenteditable="true">Nuevo</td>
        <td contenteditable="true">Nuevo Horario</td>
        <td contenteditable="true">Asignado a</td>
        <td contenteditable="true">Estado</td>
        <td class="actions">
            <button class="edit-button">Editar</button>
            <button class="delete-button">Borrar</button>
        </td>
    `;
    tbody.appendChild(newRow);

    // Añadir eventos a los nuevos botones
    const newEditButton = newRow.querySelector('.edit-button');
    const newDeleteButton = newRow.querySelector('.delete-button');
    newEditButton.addEventListener('click', editHorario);
    newDeleteButton.addEventListener('click', deleteHorario);
}

// Función para editar un horario
function editHorario(event) {
    const row = event.target.closest('tr');
    const cells = row.querySelectorAll('td[contenteditable]');

    cells.forEach(cell => {
        cell.style.backgroundColor = '#fff3cd';
        cell.style.border = '1px solid #f1c40f';
    });
    alert('Puedes editar los campos directamente.');
}

// Función para borrar un horario
function deleteHorario(event) {
    const row = event.target.closest('tr');
    row.remove();
    alert('Horario borrado.');
}

// Función de búsqueda
function searchHorarios() {
    const query = searchInput.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
        row.style.display = rowText.includes(query) ? '' : 'none';
    });
}

// Función para manejar la paginación (simplificado)
function goToPage() {
    alert(`Ir a página: ${pageNumberSelect.value}`);
}

// Agregar eventos a los botones
addButton.addEventListener('click', addHorario);
editButtons.forEach(button => button.addEventListener('click', editHorario));
deleteButtons.forEach(button => button.addEventListener('click', deleteHorario));
searchInput.addEventListener('input', searchHorarios);
goToPageButton.addEventListener('click', goToPage);
