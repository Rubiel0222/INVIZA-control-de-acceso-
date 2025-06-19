document.getElementById('empresaForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('insertar_empresa.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    document.getElementById('mensaje').innerText = data;
    this.reset();
  })
  .catch(error => {
    console.error('Error:', error);
  });
});
