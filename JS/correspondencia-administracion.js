document.addEventListener('DOMContentLoaded', function () {
    // 🕐 Actualizar la hora actual en tiempo real
    function updateTime() {
        const timeElement = document.getElementById('currentTime');
        if (!timeElement) return;

        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        timeElement.textContent = `${hours}:${minutes}`;
    }
    setInterval(updateTime, 1000);
    updateTime();

    // 🔗 Obtener referencias a los elementos de la interfaz
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.querySelector('.search button');
    const addCorrespondenceButton = document.querySelector('.add-button');
    const rowsSelect = document.getElementById('showRows');
    const pageSelect = document.getElementById('pageNumber');
    const goToPageButton = document.querySelector('.pagination button');
    const tableBody = document.getElementById('correspondenceTableBody');

    // 🔍 Función de búsqueda optimizada
    searchButton?.addEventListener('click', function (event) {
        event.preventDefault();
        const query = searchInput.value.toLowerCase();
        document.querySelectorAll('#correspondenceTableBody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(query) ? '' : 'none';
        });
    });

    // 🔄 Función para cargar datos desde la base de datos con `fetch()`
    function fetchCorrespondencias() {
        fetch('cargar_correspondencia.php')
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = ""; // Limpia la tabla antes de insertar nuevos datos

                if (!data || data.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="8">❌ No hay correspondencias registradas.</td></tr>`;
                    return;
                }

                data.forEach(correspondencia => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${correspondencia.descripcion || '-'}</td>
                        <td>${correspondencia.destinatario || '-'}</td>
                        <td>${correspondencia.propietario || '-'}</td>
                        <td>${correspondencia.ubicacion || '-'}</td>
                        <td>${correspondencia.telefono || '-'}</td>
                        <td>${correspondencia.codigo_envio || '-'}</td>
                        <td>${correspondencia.entregado_por || '-'}</td>
                        <td>${correspondencia.enviar_correo === "1" ? '✔' : '❌'}</td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error("❌ Error al cargar datos:", error));
    }

    // ➕ Función para agregar nueva correspondencia manualmente
    addCorrespondenceButton?.addEventListener('click', function (event) {
        event.preventDefault();
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
        `;
        tableBody.appendChild(newRow);
        alert('Nueva correspondencia agregada');
    });

    // 📄 Función para actualizar el número de filas mostradas (placeholder)
    rowsSelect?.addEventListener('change', function (event) {
        alert(`Mostrar ${event.target.value} filas por página - funcionalidad pendiente.`);
    });

    // ⏩ Función de paginación (placeholder)
    goToPageButton?.addEventListener('click', function (event) {
        event.preventDefault();
        alert(`Ir a página ${pageSelect.value} - funcionalidad pendiente.`);
    });

    // 🔃 Cargar correspondencias al iniciar la página
    fetchCorrespondencias();
});
