document.addEventListener("DOMContentLoaded", function () {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        timeElement.textContent = now.toLocaleTimeString();
    }

    setInterval(updateTime, 1000);
    updateTime(); // Llama a la función al cargar la página

    // Manejo de la generación del informe con botón y formulario
    document.getElementById("generarInformeBtn").addEventListener("click", async function () {
        const formato = document.querySelector('select[name="formato"]').value;

        if (!formato) {
            alert("Por favor, selecciona un formato de informe.");
            return;
        }

        try {
            // Enviar la solicitud al servidor
            const response = await fetch("http://localhost/inviza/generar_informe.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ formato: formato })
            });

            const data = await response.json();
            console.log("Respuesta del servidor:", data); // Verifica la respuesta en la consola

            if (data.status === "success") {
                window.location.href = data.file_url; // Descargar archivo automáticamente
            } else {
                alert("Error al generar el informe.");
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
            alert("Ocurrió un problema. Inténtalo nuevamente más tarde.");
        }
    });

    // Manejo de envío del formulario
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío del formulario por defecto
        const formato = document.getElementById("seleccionar").value;

        if (formato === "excel") {
            alert("Generando informe en Excel...");
        } else if (formato === "pdf") {
            alert("Generando informe en PDF...");
        } else {
            alert("Por favor, selecciona un formato válido.");
        }
    });
});

