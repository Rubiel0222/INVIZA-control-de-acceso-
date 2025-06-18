document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.getElementById("contratistaForm");

    // Validar los campos antes de enviar
    formulario.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío automático

        let idContratista = document.getElementById("id_contratista").value.trim();
        let nombreContratista = document.getElementById("nombre_contratista").value.trim();
        let idEmpresa = document.getElementById("id_empresa").value.trim();
        let estado = document.getElementById("estado").value;
        let seguridadSocial = document.getElementById("seguridad_social").value.trim();

        if (!idContratista || !nombreContratista || !idEmpresa || !seguridadSocial) {
            alert("Todos los campos deben estar completos.");
            return;
        }

        // Enviar datos al servidor
        fetch("guardar_contratista.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id_contratista=${idContratista}&nombre_contratista=${nombreContratista}&id_empresa=${idEmpresa}&estado=${estado}&seguridad_social=${seguridadSocial}`
        })
        .then(response => response.text())
        .then(data => {
            alert("Registro guardado correctamente.");
            formulario.reset(); // Limpiar el formulario después de guardar
        })
        .catch(error => console.error("Error:", error));
    });

    // Botón de limpiar
    document.getElementById("limpiar").addEventListener("click", function () {
        formulario.reset();
    });
});
