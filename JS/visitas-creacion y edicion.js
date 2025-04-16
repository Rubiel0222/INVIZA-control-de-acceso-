document.addEventListener('DOMContentLoaded', function () {
    // Actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString();
        }
    }
<<<<<<< HEAD
    setInterval(updateTime, 1000); // Actualiza cada segundo
    updateTime(); // Llama la función al cargar la página

    // Redirigir para agregar un nuevo registro
    const agregarButton = document.getElementById('btn-agregar'); // Referencia al botón "Agregar nuevo registro"
    if (agregarButton) {
        agregarButton.addEventListener('click', function (event) {
            event.preventDefault(); // Previene cualquier acción predeterminada
            window.location.href = 'visitas-creación-y-edición-edición.html'; // Redirige al formulario de edición
        });
    }

    // Mantener las acciones de la tabla
    const tableBody = document.querySelector('table tbody');
    if (tableBody) {
=======
    setInterval(updateTime, 1000);
    updateTime();

    // Referencias a elementos de la interfaz
    const searchInput = document.querySelector('.search-container input[type="text"]');
    const searchButton = document.querySelector('.search-container button');
    const addRecordButton = document.querySelector('.add-record');
    const tableBody = document.querySelector('table tbody');

    // Validar existencia de elementos antes de agregar eventos
    if (searchInput && searchButton && addRecordButton && tableBody) {
        // Búsqueda en la tabla
        searchButton.addEventListener('click', function (event) {
            event.preventDefault();
            const query = searchInput.value.toLowerCase();
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowData = Array.from(cells).map(cell => cell.textContent.toLowerCase());
                row.style.display = rowData.some(data => data.includes(query)) ? '' : 'none';
            });
        });

        // Agregar un nuevo registro
        addRecordButton.addEventListener('click', function (event) {
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

            fetch("visitas-creación-y-edición.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
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

        // Manejo de acciones en las filas
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
        tableBody.addEventListener('click', function (event) {
            if (event.target.tagName === 'BUTTON') {
                const button = event.target;
                const row = button.closest('tr');
<<<<<<< HEAD
                const documento = row.querySelector('td').textContent;

                if (button.classList.contains('delete-button')) {
                    // Eliminar registro mediante número de documento
                    fetch("visitas-ceación y edición.php", {
                        method: "POST",
                        body: new URLSearchParams({
                            accion: "eliminar",
                            numero_documento: documento
=======

                if (button.classList.contains('delete-button')) {
                    const id = row.querySelector('td').textContent;

                    fetch("visitas-creacion y edicion.php", {
                        method: "POST",
                        body: new URLSearchParams({
                            accion: "eliminar",
                            id_visitas: id
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
                        })
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
<<<<<<< HEAD
                        row.remove(); // Remover la fila de la tabla tras confirmación
=======
                        row.remove();
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
                    })
                    .catch(error => console.error("Error:", error));
                }
            }
        });
<<<<<<< HEAD
=======
    } else {
        console.error("Error: Algunos elementos de la interfaz no se encontraron.");
>>>>>>> 930ce47964a342f1c23adbe71e71de8b45c0a5f0
    }
});
