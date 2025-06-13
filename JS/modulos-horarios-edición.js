document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nombreHorario = document.querySelector("#nombre_horario");
    const gabela = document.querySelector("#gabela");
    const horasLaborales = document.querySelector("#horas_laborales");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita que la página se recargue

        if (nombreHorario.value.trim() === "" || gabela.value.trim() === "" || horasLaborales.value.trim() === "") {
            alert("⚠️ Todos los campos obligatorios deben completarse.");
            return;
        }

        enviarDatos();
    });
    document.querySelector(".back-button").addEventListener("click", function () {
    window.location.href = "menu_principal.html";
});


    function enviarDatos() {
        let formData = new FormData(form);

        fetch("guardar_horario.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert("✅ " + data);
            form.reset(); // Limpia el formulario después de guardar
        })
        .catch(error => console.error("Error al enviar:", error));
    }
});
