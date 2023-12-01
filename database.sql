CREATE DATABASE IF NOT EXISTS Agenda;

USE Agenda;

CREATE TABLE IF NOT EXISTS Usuarios (
    correo VARCHAR(50) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    contrasena VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS Tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_correo VARCHAR(50),
    tarea_descripcion VARCHAR(255) NOT NULL,
    completada BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (usuario_correo) REFERENCES Usuarios(correo)
);
