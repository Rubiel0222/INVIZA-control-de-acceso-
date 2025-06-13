document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#funcionarioForm");
    const resetButton = document.querySelector("button[type='reset']");

    form.addEventListener("submit", function (event) {
        let documento = document.querySelector("#documento").value.trim();
        let nombres = document.querySelector("#nombres").value.trim();
        let sucursales = document.querySelector("#sucursales").value.trim();
        let fechaInicio = document.querySelector("#fecha_inicio").value;
        let fechaFin = document.querySelector("#fecha_fin").value;

        // Validar que los campos no estén vacíos
        if (documento === "" || nombres === "" || sucursales === "" || fechaInicio === "") {
            alert("Por favor, complete todos los campos obligatorios.");
            event.preventDefault(); // Evita el envío del formulario si hay errores
            return;
        }

        alert("Datos listos para enviar.");
    });

    // Función para limpiar el formulario
    resetButton.addEventListener("click", function () {
        form.reset();
    });
});
