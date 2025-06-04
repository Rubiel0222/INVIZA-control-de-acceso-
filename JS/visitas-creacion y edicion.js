document.addEventListener('DOMContentLoaded', function () {
    // Actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString();
        }
    }
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
        tableBody.addEventListener('click', function (event) {
            if (event.target.tagName === 'BUTTON') {
                const button = event.target;
                const row = button.closest('tr');
                const documento = row.querySelector('td').textContent;

                if (button.classList.contains('delete-button')) {
                    // Eliminar registro mediante número de documento
                    fetch("visitas-ceación y edición.php", {
                        method: "POST",
                        body: new URLSearchParams({
                            accion: "eliminar",
                            numero_documento: documento
                        })
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        row.remove(); // Remover la fila de la tabla tras confirmación
                    })
                    .catch(error => console.error("Error:", error));
                }
            }
        });
    }
});
