document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("button[onclick='saveData()']").addEventListener("click", function () {
        saveData();
    });
});

function saveData() {
    let destinatario = document.getElementById("destinatario").value.trim();
    let propietario = document.getElementById("propietario").value.trim();
    let ubicacion = document.getElementById("ubicacion").value.trim();
    let telefono = document.getElementById("telefono").value.trim();
    let codigoEnvio = document.getElementById("codigoEnvio").value.trim();
    let entregadoPor = document.getElementById("entregadoPor").value.trim();
    let descripcion = document.getElementById("descripcion").value.trim();
    let enviarCorreo = document.getElementById("enviarCorreo").checked ? 1 : 0;

    // Validar que los campos no estén vacíos
    if (!destinatario || !propietario || !ubicacion || !telefono || !codigoEnvio || !entregadoPor || !descripcion) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Crear objeto de datos
    let formData = new FormData();
    formData.append("destinatario", destinatario);
    formData.append("propietario", propietario);
    formData.append("ubicacion", ubicacion);
    formData.append("telefono", telefono);
    formData.append("codigoEnvio", codigoEnvio);
    formData.append("entregadoPor", entregadoPor);
    formData.append("descripcion", descripcion);
    formData.append("enviarCorreo", enviarCorreo);

    // Enviar datos mediante Fetch API a PHP
    fetch("guardar_correspondencia.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        limpiarFormulario();
    })
    .catch(error => console.error("Error:", error));
}

// Limpiar los campos después de guardar
function limpiarFormulario() {
    document.getElementById("destinatario").value = "";
    document.getElementById("propietario").value = "";
    document.getElementById("ubicacion").value = "";
    document.getElementById("telefono").value = "";
    document.getElementById("codigoEnvio").value = "";
    document.getElementById("entregadoPor").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("enviarCorreo").checked = false;
}
