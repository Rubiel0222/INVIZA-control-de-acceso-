document.addEventListener('DOMContentLoaded', function() {
    // Función para actualizar la hora actual
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
    }
    setInterval(updateTime, 1000);
    updateTime(); // Llama la función al cargar la página

    // Función para permitir la edición de campos
    function makeFieldsEditable() {
        const editableFields = document.querySelectorAll('.editable');
        editableFields.forEach(field => {
            const originalText = field.textContent;
            field.innerHTML = `<input type="text" value="${originalText}">`;
        });
    }

    // Función para guardar los campos editados
    function saveFields() {
        const editableFields = document.querySelectorAll('.editable input');
        editableFields.forEach(field => {
            const originalField = field.parentElement;
            originalField.textContent = field.value;
        });
    }

    // Función para cargar una nueva foto de usuario
    function loadUserPhoto(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const img = document.querySelector('.user-photo img');
            img.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Añadir evento a los botones de editar y guardar
    const editButton = document.querySelector('.edit-button');
    const saveButton = document.querySelector('.save-button');

    editButton.addEventListener('click', makeFieldsEditable);
    saveButton.addEventListener('click', saveFields);

    // Añadir evento al input de carga de foto
    const photoInput = document.querySelector('.photo-input');
    photoInput.addEventListener('change', loadUserPhoto);
});
