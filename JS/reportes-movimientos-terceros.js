document.querySelector("form").addEventListener("submit", function(event) {
    const fechaInicial = document.getElementById("fecha-inicial").value;
    const fechaFinal = document.getElementById("fecha-final").value;

    if (!fechaInicial || !fechaFinal) {
        alert("Por favor, completa las fechas inicial y final.");
        event.preventDefault(); // Detiene el envío del formulario
    }
});
