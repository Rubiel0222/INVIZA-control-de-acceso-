document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
    }
    setInterval(updateTime, 1000); // Actualiza cada segundo
    updateTime(); // Llama la función al cargar la página

    // Obtener referencias a los elementos del formulario y botones
    const documentType = document.getElementById('documentType');
    const documentNumber = document.getElementById('documentNumber');
    const fullName = document.getElementById('fullName');
    const phone = document.getElementById('phone');
    const vehicle = document.getElementById('vehicle');
    const observations = document.getElementById('observations');
    const visitTo = document.getElementById('visitTo');
    const form = document.querySelector('form');
    const ingresarButton = document.querySelector('.form-footer button:nth-child(1)');
    const limpiarButton = document.querySelector('.form-footer button:nth-child(2)');
    const visitantesButton = document.querySelector('.form-footer button:nth-child(3)');
    const funcionariosButton = document.querySelector('.form-footer button:nth-child(4)');
    const contratistasButton = document.querySelector('.form-footer button:nth-child(5)');
    const photoButton = document.querySelector('.photo-container button');
    const photo = document.querySelector('.photo-container img');

    // Funcionalidad del botón "Ingresar"
    ingresarButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (documentNumber.value && fullName.value && phone.value && visitTo.value) {
            alert('Datos ingresados correctamente');
            // Aquí puedes agregar lógica para enviar los datos o cualquier otra acción
        } else {
            alert('Por favor, complete todos los campos obligatorios');
        }
    });

    // Funcionalidad del botón "Limpiar"
    limpiarButton.addEventListener('click', function(event) {
        event.preventDefault();
        form.reset(); // Limpia todos los campos del formulario
    });

    // Funcionalidad del botón "Visitantes"
    visitantesButton.addEventListener('click', function(event) {
        event.preventDefault();
        // Redirigir a la página de visitantes
        window.location.href = 'visitantes.html';
    });

    // Funcionalidad del botón "Funcionarios"
    funcionariosButton.addEventListener('click', function(event) {
        event.preventDefault();
        // Redirigir a la página de funcionarios
        window.location.href = 'funcionarios.html';
    });

    // Funcionalidad del botón "Contratistas"
    contratistasButton.addEventListener('click', function(event) {
        event.preventDefault();
        // Redirigir a la página de contratistas
        window.location.href = 'contratistas.html';
    });

    // Funcionalidad del botón "Tomar Foto"
    photoButton.addEventListener('click', function(event) {
        event.preventDefault();
        // Simulación de toma de foto (puedes reemplazar esta parte con integración a la cámara real)
        photo.src = 'https://cdn-icons-png.flaticon.com/512/149/149071.png';
        alert('Foto tomada (simulada)');
    });
});