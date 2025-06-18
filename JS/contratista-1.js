document.addEventListener("DOMContentLoaded", function () {
    fetch("contratista.php")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById("contratista-table");
            tableBody.innerHTML = ""; 

            data.forEach(contratista => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td contenteditable="true">${contratista.id_contratista}</td>
                    <td contenteditable="true">${contratista.nombre_contratista}</td>
                    <td contenteditable="true">${contratista.id_empresa}</td>
                    <td contenteditable="true">${contratista.estado}</td>
                    <td contenteditable="true">${contratista.seguridad_social}</td>
                    <td>
                        <button onclick="editarRegistro(${contratista.id_contratista})">Editar</button>
                        <button onclick="borrarRegistro(${contratista.id_contratista})">Borrar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Error al obtener los datos:", error));
});
function cargarFuncionarios() {
    fetch("contratista.php")
        .then(response => response.json())
        .then(data => renderizarTabla(data))
        .catch(error => console.error("❌ Error al cargar datos:", error));
}


function editarRegistro(id) {
    alert("Editar registro ID: " + id);
}

function borrarRegistro(id) {
    alert("Borrar registro ID: " + id);
}
