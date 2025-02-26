document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById("current-time");
        timeElement.textContent = now.toLocaleTimeString();
    }
    setInterval(updateTime, 1000);
    updateTime(); // Llama la función al cargar la página

    // Función para generar informes
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto
        
        const fechaInicial = document.getElementById('fecha-inicial').value;
        const fechaFinal = document.getElementById('fecha-final').value;
        const empresa = document.getElementById('empresa').value;
        const sucursal = document.getElementById('sucursal').value;
        const cedula = document.getElementById('cedula').value;
        const placa = document.getElementById('placa').value;
        const formatoExcel = document.getElementById('excel').checked;

        if (!fechaInicial || !fechaFinal) {
            alert('Por favor, seleccione las fechas inicial y final.');
            return;
        }

        // Aquí puedes implementar la lógica para generar el informe en el formato deseado
        if (formatoExcel) {
            alert(`Generar informe en Excel\nFecha inicial: ${fechaInicial}\nFecha final: ${fechaFinal}\nEmpresa: ${empresa}\nSucursal: ${sucursal}\nCédula: ${cedula}\nPlaca: ${placa}`);
        } else {
            alert('Seleccione un formato de informe.');
        }
    });
});
