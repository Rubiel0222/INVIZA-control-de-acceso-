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

    document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".add-button").addEventListener("click", function () {
        window.location.href = "contratista.html";
    });
});


    // Función de búsqueda
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
        const query = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('table tbody tr');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowData = Array.from(cells).map(cell => cell.textContent.toLowerCase());
            const matches = rowData.some(data => data.includes(query));
            row.style.display = matches ? '' : 'none';
        });
    });

    // Funcionalidades de los botones en las filas de la tabla (editar, borrar)
    const tableBody = document.getElementById('contractorTableBody');
    tableBody.addEventListener('click', function(event) {
        if (event.target.tagName === 'BUTTON') {
            const button = event.target;
            const row = button.closest('tr');
            const cells = row.querySelectorAll('td:not(:last-child)');
            
            if (button.textContent === 'Editar') {
                cells.forEach(cell => {
                    const originalText = cell.textContent;
                    cell.innerHTML = `<input type="text" value="${originalText}">`;
                });
                button.textContent = 'Guardar';
            } else if (button.textContent === 'Guardar') {
                cells.forEach(cell => {
                    const input = cell.querySelector('input');
                    cell.textContent = input.value;
                });
                button.textContent = 'Editar';
            } else if (button.textContent === 'Borrar') {
                row.remove();
                alert('Registro eliminado');
            }
        }
    });

    // Función para agregar un nuevo registro
    document.querySelector('.add-button').addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td contenteditable="true">Nuevo ID</td>
            <td contenteditable="true">Nuevo Contratista</td>
            <td contenteditable="true">Estado</td>
            <td contenteditable="true">Seguridad Social</td>
            <td>
                <button>Editar</button>
                <button>Borrar</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        alert('Nuevo registro agregado');
    });

    // Función para manejar la paginación
    const rowsPerPageSelect = document.getElementById('rowsPerPage');
    rowsPerPageSelect.addEventListener('change', function() {
        alert(`Mostrar ${rowsPerPageSelect.value} filas por página - funcionalidad no implementada aún.`);
    });

    const pageNumberSelect = document.getElementById('pageNumber');
    const goToPageButton = document.querySelector('.pagination button');
    goToPageButton.addEventListener('click', function() {
        alert(`Ir a página ${pageNumberSelect.value} - funcionalidad no implementada aún.`);
    });
});
