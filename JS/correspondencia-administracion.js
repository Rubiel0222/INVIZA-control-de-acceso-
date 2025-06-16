document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.querySelector('.search-button');
    const addCorrespondenceButton = document.querySelector('.add-button');
    const rowsSelect = document.getElementById('showRows');
    const pageSelect = document.getElementById('pageNumber');
    const goToPageButton = document.getElementById('goToPage');
    const tableBody = document.getElementById('correspondencia-table');

    if (!tableBody) {
        console.error("❌ Error: Tabla no encontrada.");
        return;
    }

    // 🔍 Búsqueda optimizada
    searchButton?.addEventListener('click', function () {
        const query = searchInput.value.toLowerCase();
        document.querySelectorAll('#correspondencia-table tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(query) ? '' : 'none';
        });
    });

    // ➕ Agregar nueva correspondencia
    addCorrespondenceButton?.addEventListener('click', function () {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td contenteditable="true">Nueva</td>
            <td contenteditable="true">Descripción</td>
            <td contenteditable="true">Propietario</td>
            <td contenteditable="true">Ubicación</td>
            <td contenteditable="true">Teléfono</td>
            <td contenteditable="true">Código de Envío</td>
            <td contenteditable="true">Entregado por</td>
            <td contenteditable="true">Enviar Correo</td>
            <td>
                <button class="edit-button">Editar</button>
                <button class="delete-button">Borrar</button>
                <button class="save-button" style="display: none;">Guardar</button>
            </td>
        `;
        tableBody.appendChild(newRow);
        alert('Nueva correspondencia agregada');
    });

    // ✏️ Editar, borrar y guardar filas
    tableBody.addEventListener('click', function (event) {
        const button = event.target;
        const row = button.closest('tr');

        if (!row) return;

        if (button.classList.contains('edit-button')) {
            const cells = row.querySelectorAll('td[contenteditable]');
            cells.forEach(cell => cell.contentEditable = 'true');
            button.style.display = 'none';
            row.querySelector('.save-button').style.display = 'inline-block';
        } else if (button.classList.contains('delete-button')) {
            row.remove();
            alert('Correspondencia eliminada');
        } else if (button.classList.contains('save-button')) {
            const cells = row.querySelectorAll('td[contenteditable]');
            cells.forEach(cell => cell.contentEditable = 'false');
            row.querySelector('.edit-button').style.display = 'inline-block';
            button.style.display = 'none';
            alert('Correspondencia guardada');
        }
    });

    // 🔄 Paginación y filas
    rowsSelect?.addEventListener('change', function () {
        alert(`Mostrar ${rowsSelect.value} filas por página - funcionalidad pendiente.`);
    });

    goToPageButton?.addEventListener('click', function () {
        alert(`Ir a página ${pageSelect.value} - funcionalidad pendiente.`);
    });
});
