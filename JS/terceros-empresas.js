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

    // Funcionalidades de los botones en las filas de la tabla (editar, eliminar)
    tableBody.addEventListener('click', function(event) {
        if (event.target.tagName === 'BUTTON') {
            const button = event.target;
            const row = button.closest('tr');

            if (button.textContent === 'Editar') {
                const cells = row.querySelectorAll('td:not(:last-child)');
                cells.forEach(cell => {
                    const originalText = cell.textContent;
                    cell.innerHTML = `<input type="text" value="${originalText}">`;
                });
                button.textContent = 'Guardar';
            } else if (button.textContent === 'Guardar') {
                const cells = row.querySelectorAll('td:not(:last-child)');
                cells.forEach(cell => {
                    const input = cell.querySelector('input');
                    cell.textContent = input.value;
                });
                button.textContent = 'Editar';
            } else if (button.textContent === 'Eliminar') {
                row.remove();
                alert('Registro eliminado');
            }
        }
    });

    // Función para manejar los cambios en la selección de filas mostradas
    rowsSelect.addEventListener('change', function(event) {
        const selectedValue = event.target.value;
        alert(`Mostrar ${selectedValue} filas por página - funcionalidad no implementada aún.`);
    });

    // Función para manejar la paginación
    goToPageButton.addEventListener('click', function(event) {
        event.preventDefault();
        const selectedPage = pageSelect.value;
        alert(`Ir a página ${selectedPage} - funcionalidad no implementada aún.`);
    });
});
