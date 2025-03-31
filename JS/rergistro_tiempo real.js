document.addEventListener("DOMContentLoaded", function () {
    // Función para cargar visitantes
    function cargarVisitantes() {
        fetch("registro_tiempo_real.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al obtener los datos del servidor.");
                }
                return response.json();
            })
            .then(data => {
                console.log("Archivo cargado correctamente:", data); // Depuración: Verifica los datos en la consola
                const tabla = document.getElementById("inviza/visitantes-table");
                tabla.innerHTML = ""; // Limpia el contenido de la tabla antes de agregar los nuevos datos

                // Itera los visitantes y los agrega a la tabla
                data.forEach(visitor => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${visitor.id}</td>
                        <td>
                            <div style="position: relative; text-align: center;">
                                <img src="${visitor.foto || 'placeholder.jpeg'}" alt="Foto" width="80">
                                <button onclick="darSalida(${visitor.id})" 
                                    style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); 
                                    background-color: black; color: white; border: none; cursor: pointer; padding: 3px;">
                                    X
                                </button>
                            </div>
                        </td>
                        <td>${visitor.numero_documento}</td>
                        <td>${visitor.tipo_documento}</td>
                        <td>${visitor.nombres_apellidos}</td>
                        <td>${visitor.telefono || "N/A"}</td>
                        <td>${visitor.vehiculo || "N/A"}</td>
                        <td>${visitor.observaciones || "N/A"}</td>
                        <td>${visitor.visita_a || "N/A"}</td>
                        <td>${visitor.hora_ingreso || "N/A"}</td>
                        <td>${visitor.hora_salida || "Pendiente"}</td>
                        <td>${visitor.fecha_ingreso || "N/A"}</td>
                        <td>${visitor.id_zona || "N/A"}</td>
                    `;
                    tabla.appendChild(row);
                });
            })
            .catch(error => {
                console.error("Error al cargar visitantes:", error);
                alert("Hubo un problema al cargar los datos. Por favor, verifica la conexión.");
            });
    }

    // Función para registrar la salida de un visitante
    function darSalida(id) {
        if (confirm("¿Estás seguro de dar salida a este visitante?")) {
            fetch("actualizar_registro.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `accion=dar_salida&id=${id}`,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Hora de salida registrada correctamente.");
                    cargarVisitantes(); // Actualiza la tabla
                } else {
                    alert("Error: " + data.error);
                }
            })
            .catch(error => console.error("Error:", error));
        }
    }

    // Actualiza los datos cada 5 segundos
    setInterval(cargarVisitantes, 5000);

    // Cargar los visitantes al iniciar la página
    cargarVisitantes();
});
