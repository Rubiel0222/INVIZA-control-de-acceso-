document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        timeElement.textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime(); // Llama la función al cargar la página

    // Obtener referencias a los elementos de la interfaz
    const searchInput = document.querySelector('.search-container input[type="text"]');
    const searchButton = document.querySelector('.search-container button');
    const addRecordButton = document.querySelector('.add-record');
    const rowsSelect = document.getElementById('rows');
    const pageSelect = document.getElementById('page');
    const goToPageButton = document.querySelector('.pagination-container button');
    const tableBody = document.querySelector('table tbody');

    // Función de búsqueda
    searchButton.addEventListener('click', function(event) {
        event.preventDefault();
        const query = searchInput.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowData = Array.from(cells).map(cell => cell.textContent.toLowerCase());
            const matches = rowData.some(data => data.includes(query));
            
            if (matches) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Función para agregar un nuevo registro
    addRecordButton.addEventListener('click', function(event) {
        event.preventDefault();
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>2</td>
            <td contenteditable="true">Nuevo</td>
            <td contenteditable="true">Usuario</td>
            <td contenteditable="true">2024-12-01 09:00</td>
            <td contenteditable="true">2024-12-01 18:00</td>
            <td contenteditable="true">Nueva Empresa</td>
            <td contenteditable="true">Activo</td>
            <td contenteditable="true">No</td>
            <td>
                <button class="edit-button">Editar</button>
                <button class="delete-button">Borrar</button>
                <button class="movements-button">Movimientos</button>
                <button class="save-button" style="display: none;">Guardar</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        alert('Nuevo registro agregado');
    });

    // Función para manejar los cambios en la selección de filas mostradas
    rowsSelect.addEventListener('change', function(event) {
        const selectedValue = event.target.value;
        alert(`Mostrar ${selectedValue} filas por página`);
    });

    // Función para manejar la paginación
    goToPageButton.addEventListener('click', function(event) {
        event.preventDefault();
        const selectedPage = pageSelect.value;
        alert(`Ir a página ${selectedPage}`);
    });

    // Funcionalidades de los botones en las filas de la tabla (editar, borrar, movimientos)
    tableBody.addEventListener('click', function(event) {
        if (event.target.tagName === 'BUTTON') {
            const button = event.target;
            const row = button.closest('tr');
            const id = row.querySelector('td').textContent;
            
            if (button.classList.contains('edit-button')) {
                const cells = row.querySelectorAll('td[contenteditable]');
                cells.forEach(cell => cell.contentEditable = 'true');
                row.querySelector('.edit-button').style.display = 'none';
                row.querySelector('.save-button').style.display = 'inline-block';
            } else if (button.classList.contains('delete-button')) {
                row.remove();
                alert(`Registro con ID ${id} borrado`);
            } else if (button.classList.contains('movements-button')) {
                alert(`Ver movimientos del registro con ID ${id}`);
            } else if (button.classList.contains('save-button')) {
                const cells = row.querySelectorAll('td[contenteditable]');
                cells.forEach(cell => cell.contentEditable = 'false');
                row.querySelector('.edit-button').style.display = 'inline-block';
                row.querySelector('.save-button').style.display = 'none';
                alert(`Registro con ID ${id} guardado`);
            }
        }
    });
});
