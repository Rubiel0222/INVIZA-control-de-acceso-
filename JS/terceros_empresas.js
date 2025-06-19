document.addEventListener('DOMContentLoaded', () => {
  const tabla = document.getElementById('empresa-table-body');

  // Delegación de eventos para botones generados dinámicamente
  tabla.addEventListener('click', function (e) {
    const btn = e.target.closest('button');
    if (!btn) return;

    const row = btn.closest('tr');
    const id = btn.dataset.id;

    if (btn.classList.contains('eliminar')) {
      if (confirm("¿Deseas eliminar esta empresa?")) {
        fetch('eliminar_empresa.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'id=' + encodeURIComponent(id)
        })
        .then(res => res.text())
        .then(data => {
          alert(data);
          if (data.toLowerCase().includes("eliminado")) {
            location.reload();
          }
        })
        .catch(err => console.error('Error:', err));
      }
    }

    if (btn.classList.contains('editar')) {
      const cells = row.children;
      const form = document.getElementById('empresaForm');
      if (form) {
        form['nombre_empresa'].value = cells[1].textContent;
        form['nit'].value = cells[2].textContent;
        form['telefono_empresa'].value = cells[3].textContent;
        form['direccion_empresa'].value = cells[4].textContent;
        form.setAttribute('data-edit-id', id);
      }
    }
  });
});
