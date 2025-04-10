const express = require('express'); // Importa Express
const app = express(); // Crea una instancia de Express

const PORT = 3000; // Define el puerto donde se ejecutará el servidor

// Ruta de ejemplo
app.get('/', (req, res) => {
  res.send('¡Servidor Express funcionando correctamente!');
});

// Escucha en el puerto definido
app.listen(PORT, () => {
  console.log(`Servidor ejecutándose en http://localhost:${PORT}`);
});
