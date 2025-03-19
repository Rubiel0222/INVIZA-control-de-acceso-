document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("currentTime");
        timeElement.textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime(); // Llama la función al cargar la página

    // Función de búsqueda
    const searchInput = document.querySelector('.search-container input[aria-label="Buscar"]');
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

    // Función para agregar un nuevo registro
    document.querySelector('.add-button').addEventListener('click', function() {
        const tableBody = document.querySelector('table tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td contenteditable="true">Nuevo ID</td>
            <td contenteditable="true">Nuevo Dato</td>
            <td contenteditable="true">Nueva Información</td>
            <td>
                <button onclick="editRecord(this)">Editar</button>
                <button onclick="deleteRecord(this)">Borrar</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        alert('Nuevo registro agregado');
    });

    // Función para editar un registro
    window.editRecord = function(button) {
        const row = button.closest('tr');
        const cells = row.querySelectorAll('td[contenteditable]');
        
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

    // Función para eliminar un registro
    window.deleteRecord = function(button) {
        const row = button.closest('tr');
        row.remove();
        alert('Registro eliminado');
    };
});
