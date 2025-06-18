document.addEventListener("DOMContentLoaded", function() {
    fetch("get_contratistas.php")
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById("contratista-table");
            tableBody.innerHTML = ""; // Limpiar contenido previo

            data.forEach(contratista => {
                let row = document.createElement("tr");

                row.innerHTML = `
                    <td>${contratista.id_contratista}</td>
                    <td>${contratista.nombre_contratista}</td>
                    <td>${contratista.id_empresa}</td>
                    <td>${contratista.estado}</td>
                    <td>${contratista.seguridad_social ? "✔️" : "❌"}</td>
                    <td>
                        <button onclick="editContratista(${contratista.id_contratista})">✏️</button>
                        <button onclick="deleteContratista(${contratista.id_contratista})">🗑️</button>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Error al obtener datos:", error));
});
