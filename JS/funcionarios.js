document.addEventListener("DOMContentLoaded", function () {
    cargarFuncionarios();

    document.getElementById("searchButton").addEventListener("click", function () {
        const query = document.getElementById("searchInput").value.toLowerCase();
        document.querySelectorAll("#funcionarios-table tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(query) ? "" : "none";
        });
    });

    document.getElementById("addButton").addEventListener("click", function () {
        window.open("modulo-Creación-Edición-Funcionarios.html", "_blank");
    });
});

function cargarFuncionarios() {
    fetch("funcionarios.php")
        .then(response => response.json())
        .then(data => renderizarTabla(data))
        .catch(error => console.error("❌ Error al cargar datos:", error));
}

function renderizarTabla(data) {
    const tableBody = document.getElementById("funcionarios-table");
    if (!tableBody) return;

    tableBody.innerHTML = "";
    data.forEach(item => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${item.id}</td>
            <td>${item.documento}</td>
            <td>${item.nombres}</td>
            <td>${item.sucursales}</td>
            <td>${item.zona}</td>
            <td>${item.estado}</td>
            <td>${item.fecha_inicio}</td>
            <td>${item.fecha_fin}</td>
            <td>
                <button class="delete-button" data-id="${item.id}">🗑 Borrar</button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    // Agregar funcionalidad para eliminar registros
    document.querySelectorAll(".delete-button").forEach(button => {
        button.addEventListener("click", function () {
            eliminarFuncionario(button.dataset.id);
        });
    });
}

function eliminarFuncionario(id) {
    if (confirm("¿Seguro que deseas eliminar este funcionario?")) {
        fetch(`eliminar_funcionario.php?id=${id}`, {
            method: "GET",
        })
        .then(response => response.json())
        .then(result => {
            alert(result.message || result.error);
            cargarFuncionarios(); // Recargar la tabla
        })
        .catch(error => console.error("❌ Error al eliminar:", error));
    }
}
