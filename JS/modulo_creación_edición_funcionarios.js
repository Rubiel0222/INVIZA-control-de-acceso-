document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const resetButton = document.querySelector("button[type='reset']");
    const submitButton = document.querySelector("button[type='submit']");

    // Validaciones antes de enviar el formulario
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        let documento = document.querySelector("#documento").value.trim();
        let nombres = document.querySelector("#nombres").value.trim();
        let sucursales = document.querySelector("#sucursales").value.trim();
        let fechaInicio = document.querySelector("#fecha_inicio").value;
        let fechaFin = document.querySelector("#fecha_fin").value;

        if (documento === "" || nombres === "" || sucursales === "" || fechaInicio === "" || fechaFin === "") {
            alert("Por favor, complete todos los campos obligatorios.");
            return;
        }

        alert("Información guardada correctamente.");
        form.reset();
    });

    // Función para limpiar el formulario
    resetButton.addEventListener("click", function () {
        form.reset();
    });
});
