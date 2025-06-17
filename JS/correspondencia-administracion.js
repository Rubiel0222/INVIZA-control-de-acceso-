document.addEventListener("DOMContentLoaded", function () {
    cargarCorrespondencia();

    document.getElementById("searchButton").addEventListener("click", function () {
        const query = document.getElementById("searchInput").value.toLowerCase();
        document.querySelectorAll("#correspondencia-table tr").forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(query) ? "" : "none";
        });
    });

    document.getElementById("addButton").addEventListener("click", function () {
        window.open("Correspondencia-administracion-Creación.html", "_blank");
    });
});

function cargarCorrespondencia() {
    fetch("cargar_correspondencia.php")
        .then(response => response.json())
        .then(data => renderizarTabla(data))
        .catch(error => console.error("❌ Error al cargar datos:", error));
}

function renderizarTabla(data) {
    const tableBody = document.getElementById("correspondencia-table");
    if (!tableBody) return;

    tableBody.innerHTML = "";
    data.forEach(item => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${item.descripcion}</td>
            <td>${item.destinatario}</td>
            <td>${item.propietario}</td>
            <td>${item.ubicacion}</td>
            <td>${item.telefono}</td>
            <td>${item.codigo_envio}</td>
            <td>${item.entregado_por}</td>
            <td>${item.enviar_correo ? "✅" : "❌"}</td>
            <td>
                <button class="delete-button">🗑 Borrar</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
