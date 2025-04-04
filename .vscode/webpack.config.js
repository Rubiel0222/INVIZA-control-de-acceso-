const path = require('path');

module.exports = {
  mode: 'development', // Cambiar a 'production' si es necesario
  entry: './src/index.js', // Archivo principal de entrada
  output: {
    path: path.resolve(__dirname, 'dist'), // Carpeta de salida donde se generará el archivo
    filename: 'bundle.js' // Nombre del archivo generado
  },
  module: {
    rules: [
      {
        test: /\.js$/, // Procesar archivos .js y JSX
        exclude: /node_modules/, // Ignora node_modules para acelerar la compilación
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react'] // Configuración para React y JavaScript moderno
          }
        }
      }
    ]
  },
  devServer: {
    static: path.resolve(__dirname, 'dist'), // Servir archivos desde la carpeta `dist`
    open: true, // Abrir automáticamente el navegador
    port: 8082 // Configurar el puerto para el servidor de desarrollo
  },
  stats: 'verbose' // Información detallada para depuración
};
