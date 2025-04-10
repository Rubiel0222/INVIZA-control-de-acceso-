const path = require('path');

module.exports = {
  entry: './src/index.js', // Archivo de entrada principal
  output: {
    path: path.resolve(__dirname, 'dist'), // Carpeta de salida
    filename: 'bundle.js', // Nombre del archivo compilado
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/, // Procesa archivos JS y JSX
        exclude: /node_modules/, // Excluye la carpeta node_modules
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env', '@babel/preset-react'],
          },
        },
      },
    ],
  },
  resolve: {
    extensions: ['.js', '.jsx'], // Extensiones que manejará Webpack
  },
  devServer: {
    static: path.resolve(__dirname, 'dist'), // Carpeta a servir
    port: 3000, // Puerto del servidor de desarrollo
  },
};
