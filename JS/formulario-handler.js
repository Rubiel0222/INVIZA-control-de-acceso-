// Función para manejar el envío del formulario
async function enviarFormulario(formulario, formatoJSON = false) {
    const url = "http://localhost/inviza/procesar-informes.php"; // Cambia por tu ruta correcta
    let datos;

    if (formatoJSON) {
        // Recoger datos del formulario en formato JSON
        datos = {};
        const inputs = formulario.querySelectorAll("input, select");
        inputs.forEach(input => {
            datos[input.name] = input.value;
        });
    } else {
        // Recoger datos del formulario en formato form-urlencoded
        datos = new URLSearchParams();
        const inputs = formulario.querySelectorAll("input, select");
        inputs.forEach(input => {
            datos.append(input.name, input.value);
        });
    }

    try {
        // Realizar solicitud POST
        const respuesta = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": formatoJSON ? "application/json" : "application/x-www-form-urlencoded"
            },
            body: formatoJSON ? JSON.stringify(datos) : datos.toString()
        });

        const resultado = await respuesta.text(); // Recibir respuesta del servidor
        console.log("Respuesta del servidor:", resultado);
        alert("Formulario enviado correctamente. Revise la consola para más detalles.");
    } catch (error) {
        console.error("Error al enviar el formulario:", error);
        alert("Hubo un problema al enviar el formulario.");
    }
}

// Asociar eventos a los formularios
document.addEventListener("DOMContentLoaded", () => {
    // Seleccionar los formularios HTML
    const formularios = document.querySelectorAll("form");

    // Asociar evento de envío a cada formulario
    formularios.forEach(formulario => {
        formulario.addEventListener("submit", (evento) => {
            evento.preventDefault(); // Prevenir el envío por defecto
            const formatoJSON = formulario.dataset.json === "true"; // Usar JSON si el formulario lo indica
            enviarFormulario(formulario, formatoJSON); // Llamar a la función para enviar datos
        });
    });
});
