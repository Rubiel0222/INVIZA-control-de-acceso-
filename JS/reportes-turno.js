document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        timeElement.textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime(); // Llama la función al cargar la página

    // Función de búsqueda
    const searchInput = document.querySelector('.search-container input[type="text"]');
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

    // Función para editar una fila
    window.editarfila = function(button) {
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
        }
    };

    // Función para eliminar una fila
    window.eliminarfila = function(button) {
        const row = button.closest('tr');
        row.remove();
    };

    // Función para manejar la paginación
    const rowsSelect = document.getElementById('rows');
    rowsSelect.addEventListener('change', function() {
        alert(`Mostrar ${rowsSelect.value} filas por página - funcionalidad no implementada aún.`);
    });

    const pageSelect = document.getElementById('page');
    const goToPageButton = document.querySelector('.pagination-container button');
    goToPageButton.addEventListener('click', function() {
        alert(`Ir a página ${pageSelect.value} - funcionalidad no implementada aún.`);
    });
});
