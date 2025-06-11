document.addEventListener("DOMContentLoaded", function () {
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString();
        }
    }
    setInterval(updateTime, 1000);
    updateTime();

    const agregarButton = document.getElementById('btn-agregar');
    if (agregarButton) {
        agregarButton.addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = 'visitas-creación-y-edición-edición.html';
        });
    }

    // Obtener y mostrar los datos en la tabla
    fetch("visitas-ceación-y-edición.php")
        .then(response => response.json())
        .then(data => {
            let tbody = document.querySelector("tbody");
            tbody.innerHTML = "";

            console.log("Datos recibidos:", data); // Depuración

            if (!data.length) {
                tbody.innerHTML = `<tr><td colspan="10">No hay visitas registradas</td></tr>`;
                return;
            }

            data.forEach(row => {
                tbody.innerHTML += `
                    <tr>
                        <td>${row.documento}</td>
                        <td contenteditable="true">${row.nombres}</td>
                        <td contenteditable="true">${row.apellidos}</td>
                        <td contenteditable="true">${row.fecha_ingreso}</td>
                        <td contenteditable="true">${row.fecha_fin}</td>
                        <td contenteditable="true">${row.estado_visita}</td>
                        <td contenteditable="true">${row.arl_checkbox}</td>
                        <td contenteditable="true">${row.placa}</td>
                        <td contenteditable="true">${row.id_zona}</td>
                        <td>
                            <button class="save-button" onclick="guardarEdicion(event)">Guardar</button>
                            <button class="delete-button" onclick="eliminarRegistro('${row.documento}')">Eliminar</button>
                        </td>
                    </tr>`;
            });
        })
        .catch(error => console.error("❌ Error al obtener datos:", error));

    // Evento para mantener las acciones de la tabla
    const tableBody = document.querySelector('table tbody');
    if (tableBody) {
        tableBody.addEventListener('click', function (event) {
            const button = event.target;
            const row = button.closest('tr');
            if (!row) return;
            const documento = row.children[0].textContent;

            if (button.classList.contains('delete-button')) {
                eliminarRegistro(documento);
            }
        });
    }
});

// Función para guardar edición
function guardarEdicion(event) {
    let fila = event.target.closest("tr"); 
    if (!fila) return;

    let datos = {
        documento: fila.children[0].innerText,
        nombres: fila.children[1].innerText,
        apellidos: fila.children[2].innerText,
        fecha_ingreso: fila.children[3].innerText,
        fecha_fin: fila.children[4].innerText,
        estado_visita: fila.children[5].innerText,
        arl_checkbox: fila.children[6].innerText,
        placa: fila.children[7].innerText,
        id_zona: fila.children[8].innerText
    };

    fetch("visitas-ceación-y-edición.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(datos)
    })
    .then(response => response.text())
    .then(data => alert(data))
    .catch(error => console.error("❌ Error al actualizar:", error));
}

// Función para eliminar registros
function eliminarRegistro(documento) {
    fetch("visitas-creación-y-edición.php", {
        method: "POST",
        body: new URLSearchParams({
            accion: "eliminar",
            numero_documento: documento
        })
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        document.querySelectorAll("tbody tr").forEach(row => {
            if (row.children[0].textContent === documento) {
                row.remove();
            }
        });
    })
    .catch(error => console.error("❌ Error al eliminar:", error));
}
