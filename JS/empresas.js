document.getElementById('empresaForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('insertar_empresa.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if (data.includes('exitosamente')) {
      // Redirige automáticamente a la página deseada
      window.location.href = 'terceros-empresas.html';
    } else {
      document.getElementById('mensaje').innerText = data;
    }
    this.reset();
  })  
  .catch(error => {
    console.error('Error:', error);
    document.getElementById('mensaje').innerText = 'Ocurrió un error inesperado.';
  });
});
