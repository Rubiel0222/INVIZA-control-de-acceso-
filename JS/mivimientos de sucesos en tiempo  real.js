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

    // Función de búsqueda
    const searchInput = document.querySelector('.options input[type="text"]');
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
    const tableBody = document.querySelector('table tbody');
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

    // Función para manejar la paginación
    const rowsSelect = document.querySelector('.options select:nth-of-type(1)');
    rowsSelect.addEventListener('change', function() {
        alert(`Mostrar ${rowsSelect.value} filas por página - funcionalidad no implementada aún.`);
    });

    const pageSelect = document.querySelector('.options select:nth-of-type(2)');
    const goToPageButton = document.querySelector('.options .go-button:nth-of-type(2)');
    goToPageButton.addEventListener('click', function() {
        alert(`Ir a página ${pageSelect.value} - funcionalidad no implementada aún.`);
    });
});
