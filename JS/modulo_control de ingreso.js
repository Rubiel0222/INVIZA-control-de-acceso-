document.addEventListener('DOMContentLoaded', function() {
    // **Actualizar la Hora Actual**
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('currentTime').textContent = `${hours}:${minutes}`;
    }
    setInterval(updateTime, 1000);
    updateTime();

    // **Captura de Foto desde la Cámara**
    const video = document.getElementById('video');
    const photoPreview = document.getElementById('photoPreview');
    const captureButton = document.getElementById('captureButton');
    const photoData = document.getElementById('photoData');

    // Habilitar la cámara
    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            video.srcObject = stream;
            video.play();
        })
        .catch((error) => {
            console.error("Error al acceder a la cámara:", error);
            alert("No se puede acceder a la cámara. Verifica los permisos del navegador.");
        });

    // Capturar la foto
    captureButton.addEventListener('click', function() {
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imageData = canvas.toDataURL('image/jpeg'); // Usar formato JPEG
        photoPreview.src = imageData;
        photoPreview.style.display = 'block';
        video.style.display = 'none';

        // Guardar la foto en el campo oculto
        photoData.value = imageData;

        alert("Foto capturada con éxito.");
    });
});
