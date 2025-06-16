document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.querySelector('.add-button');
    const tbody = document.getElementById('horarios-table');

    if (addButton) {
        addButton.addEventListener('click', addHorario);
    } else {
        console.error("❌ Error: El botón 'add-button' no se encontró en el DOM.");
    }

    function fetchHorarios() {
        fetch('modulo_horarios.php') // Archivo PHP que devuelve los datos
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (!tbody) {
                    console.error("❌ Error: No se encontró el elemento tbody.");
                    return;
                }

                tbody.innerHTML = ""; // Limpia la tabla antes de insertar nuevos datos

                if (data.length === 0) {
                    tbody.innerHTML = "<tr><td colspan='7'>❌ No hay horarios registrados.</td></tr>";
                    return;
                }

                data.forEach(horario => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${horario.id_horario}</td>
                        <td>${horario.nombre}</td>
                        <td>${horario.tiempo_gabela} min</td>
                        <td>${horario.aplicar_horas ? 'Sí' : 'No'}</td>
                        <td>${horario.estado}</td>
                        <td>${horario.horas_laborales}</td>
                        <td class="actions">
                            <button class="edit-button">Editar</button>
                            <button class="delete-button">Borrar</button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error("❌ Error al cargar datos:", error));
    }

    function addHorario() {
        if (!tbody) {
            console.error("❌ Error: No se encontró el elemento tbody.");
            return;
        }

        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td contenteditable="true">Nuevo</td>
            <td contenteditable="true">Nuevo Horario</td>
            <td contenteditable="true">Tiempo Gabela</td>
            <td contenteditable="true">Aplicar Horas</td>
            <td contenteditable="true">Estado</td>
            <td contenteditable="true">Horas Laborales</td>
            <td class="actions">
                <button class="edit-button">Editar</button>
                <button class="delete-button">Borrar</button>
            </td>
        `;
        tbody.appendChild(newRow);
    }

    fetchHorarios(); // Cargar los horarios al iniciar la página
});
