document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        timeElement.textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime();

    // Obtener referencias a los elementos de la interfaz
    const searchInput = document.querySelector('.search-container input[type="text"]');
    const searchButton = document.querySelector('.search-container button');
    const addRecordButton = document.querySelector('.add-record');
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

        const formData = new FormData();
        formData.append("accion", "agregar");
        formData.append("id_usuario", "123");
        formData.append("numero_documento", "789456123");
        formData.append("fecha_inicio", "2025-04-01 08:00:00");
        formData.append("fecha_fin", "2025-04-01 17:00:00");
        formData.append("estado_visita", "activa");
        formData.append("sucursal", "Empresa XYZ");
        formData.append("id_zona", "2");
        formData.append("hora_ingreso", "2025-04-01 08:00:00");

        fetch("visitas-ceación y edición.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            // Agregar fila a la tabla si se registra correctamente
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>Nuevo</td>
                <td>123</td>
                <td>789456123</td>
                <td>2025-04-01 08:00:00</td>
                <td>2025-04-01 17:00:00</td>
                <td>activa</td>
                <td>Empresa XYZ</td>
                <td>2</td>
                <td>2025-04-01 08:00:00</td>
                <td>
                    <button class="edit-button">Editar</button>
                    <button class="delete-button">Borrar</button>
                    <button class="save-button" style="display: none;">Guardar</button>
                </td>
            `;
            tableBody.appendChild(newRow);
        })
        .catch(error => console.error("Error:", error));
    });

    // Función para manejar los botones en las filas
    tableBody.addEventListener('click', function(event) {
        if (event.target.tagName === 'BUTTON') {
            const button = event.target;
            const row = button.closest('tr');

            if (button.classList.contains('delete-button')) {
                const id = row.querySelector('td').textContent;

                fetch("visitas-ceación y edición.php", {
                    method: "POST",
                    body: new URLSearchParams({
                        accion: "eliminar",
                        id_visitas: id
                    })
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    row.remove();
                })
                .catch(error => console.error("Error:", error));
            }
        }
    });
});
