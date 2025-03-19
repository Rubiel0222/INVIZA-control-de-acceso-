SELECT * FROM usuarios;

UPDATE usuarios SET nombre_usuario = " carlos eduardo  beltran" WHERE id_usuario =4;

SELECT * FROM usuarios;

INSERT INTO usuarios (id_usuario, nombre_usuario, documento, correo, telefono, rol, password)
VALUES (5, 'pedro salamanca', 123546789, 'pedro@gmail.com', 3125874125, 'rol', 'password 963');

SELECT * FROM usuarios;

SELECT * FROM usuarios;

DELETE FROM usuarios WHERE id_usuario =4;

SELECT * FROM usuarios;

INSERT INTO usuarios (nombre apellido, correo, nombre de usuario, password)
VALUES ('nancy diaz', 'Nancy123@gmail', 'nancy', ' 963');
