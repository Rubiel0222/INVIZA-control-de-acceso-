const path = require('path');

module.exports = {
  mode: 'development', // Cambia a 'production' si es necesario
  entry: './src/index.js', // Archivo principal de entrada
  output: {
    path: path.resolve(__dirname, 'dist'), // Carpeta de salida
    filename: 'bundle.js' // Archivo generado
  },
  module: {
    rules: [
      {
        test: /\.js$/, // Procesa archivos .js y JSX
        exclude: /node_modules/, // Ignora node_modules para acelerar la compilación
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react'] // Configuración para Babel
          }
        }
      }
    ]
  },
  stats: 'verbose', // Activa el modo detallado para depuración
  devServer: {
    static: './dist', // Carpeta para servir en desarrollo
    open: true // Abre automáticamente el navegador
  }
};
