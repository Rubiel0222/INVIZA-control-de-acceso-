import React, { useState } from 'react';
import axios from 'axios';

const RegistroUsuario = () => {
  const [formData, setFormData] = useState({
    nombre_usuario: '',
    documento: '',
    correo: '',
    telefono: '',
    rol: '',
    password: '',
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:5000/api/usuarios', formData);
      console.log('Usuario registrado:', response.data);
      alert('Usuario registrado exitosamente');
    } catch (error) {
      console.error('Error al registrar usuario:', error);
      alert('Error al registrar usuario');
    }
  };

  return (
    <div className="register-container">
      <h2>Registro de Usuario</h2>
      <form onSubmit={handleSubmit}>
        <label htmlFor="nombre_usuario">Nombre Completo:</label>
        <input
          type="text"
          id="nombre_usuario"
          name="nombre_usuario"
          placeholder="Ej: Juan Pérez"
          required
          value={formData.nombre_usuario}
          onChange={handleChange}
        />
        <label htmlFor="documento">Documento (ID):</label>
        <input
          type="text"
          id="documento"
          name="documento"
          placeholder="Ej: 123456789"
          required
          value={formData.documento}
          onChange={handleChange}
        />
        <label htmlFor="correo">Correo Electrónico:</label>
        <input
          type="email"
          id="correo"
          name="correo"
          placeholder="Ej: ejemplo@correo.com"
          required
          value={formData.correo}
          onChange={handleChange}
        />
        <label htmlFor="telefono">Teléfono:</label>
        <input
          type="text"
          id="telefono"
          name="telefono"
          placeholder="Ej: 3123456789"
          value={formData.telefono}
          onChange={handleChange}
        />
        <label htmlFor="rol">Rol:</label>
        <select
          id="rol"
          name="rol"
          required
          value={formData.rol}
          onChange={handleChange}
        >
          <option value="">Seleccionar</option>
          <option value="admin">Administrador</option>
          <option value="empleado">Empleado</option>
          <option value="visitante">Visitante</option>
          <option value="contratista">Contratista</option>
        </select>
        <label htmlFor="password">Contraseña:</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Mínimo 8 caracteres"
          required
          value={formData.password}
          onChange={handleChange}
        />
        <button type="submit">Registrar</button>
      </form>
    </div>
  );
};

export default RegistroUsuario;
