document.addEventListener("DOMContentLoaded", function () {
  // Botón Editar
  document.querySelectorAll(".editar").forEach(boton => {
    boton.addEventListener("click", function () {
      const id = this.dataset.id;
      alert(`Editar empresa ID: ${id}`);
      // Puedes abrir un modal o redirigir a un formulario de edición
    });
  });

  // Botón Eliminar
  document.querySelectorAll(".eliminar").forEach(boton => {
    boton.addEventListener("click", function () {
      const id = this.dataset.id;
      if (confirm(`¿Estás seguro de eliminar la empresa con ID ${id}?`)) {
        // Aquí puedes hacer una llamada AJAX para eliminar la empresa
        console.log(`Eliminar empresa ID: ${id}`);
      }
    });
  });

  // Cambio en la cantidad de filas
  document.getElementById("rows").addEventListener("change", function () {
    const cantidad = this.value;
    console.log(`Mostrar ${cantidad} filas por página`);
    // Puedes implementar lógica de paginación aquí
  });
});

// Navegar a otra página
function irPagina() {
  const pagina = prompt("Ingresa el número de página:");
  if (pagina) {
    console.log(`Ir a la página ${pagina}`);
    // Lógica futura de paginación dinámica
  }
}
