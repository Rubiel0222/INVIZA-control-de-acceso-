document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
    }
    setInterval(updateTime, 1000);
    updateTime(); // Llama la función al cargar la página

    // Obtener referencias a los elementos de la interfaz
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.querySelector('.search button');
    const addCorrespondenceButton = document.querySelector('.add-button');
    const rowsSelect = document.getElementById('showRows');
    const pageSelect = document.getElementById('pageNumber');
    const goToPageButton = document.querySelector('.pagination button');
    const tableBody = document.getElementById('correspondenceTableBody');

    // Función de búsqueda
    searchButton.addEventListener('click', function(event) {
        event.preventDefault();
        const query = searchInput.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowData = Array.from(cells).map(cell => cell.textContent.toLowerCase());
            const matches = rowData.some(data => data.includes(query));

            row.style.display = matches ? '' : 'none';
        });
    });

    // Función para agregar nueva correspondencia
    addCorrespondenceButton.addEventListener('click', function(event) {
        event.preventDefault();
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td contenteditable="true">3</td>
            <td contenteditable="true">Nueva Correspondencia</td>
            <td contenteditable="true">Nuevo Responsable</td>
            <td contenteditable="true">Nuevo Destino</td>
            <td>
                <button class="edit-button">Editar</button>
                <button class="delete-button">Borrar</button>
                <button class="save-button" style="display: none;">Guardar</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        alert('Nueva correspondencia agregada');
    });

    // Funcionalidades de los botones en las filas de la tabla (editar, borrar)
    tableBody.addEventListener('click', function(event) {
        if (event.target.tagName === 'BUTTON') {
            const button = event.target;
            const row = button.closest('tr');

            if (button.classList.contains('edit-button')) {
                const cells = row.querySelectorAll('td[contenteditable]');
                cells.forEach(cell => cell.contentEditable = 'true');
                row.querySelector('.edit-button').style.display = 'none';
                row.querySelector('.save-button').style.display = 'inline-block';
            } else if (button.classList.contains('delete-button')) {
                row.remove();
                alert('Correspondencia eliminada');
            } else if (button.classList.contains('save-button')) {
                const cells = row.querySelectorAll('td[contenteditable]');
                cells.forEach(cell => cell.contentEditable = 'false');
                row.querySelector('.edit-button').style.display = 'inline-block';
                row.querySelector('.save-button').style.display = 'none';
                alert('Correspondencia guardada');
            }
        }
    });

    // Función para actualizar el número de filas mostradas (placeholder)
    rowsSelect.addEventListener('change', function(event) {
        const selectedValue = event.target.value;
        alert(`Mostrar ${selectedValue} filas por página - funcionalidad no implementada aún.`);
    });

    // Función para manejar la paginación (placeholder)
    goToPageButton.addEventListener('click', function(event) {
        event.preventDefault();
        const selectedPage = pageSelect.value;
        alert(`Ir a página ${selectedPage} - funcionalidad no implementada aún.`);
    });
});
