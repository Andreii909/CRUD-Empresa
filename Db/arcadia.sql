DROP DATABASE IF EXISTS arcadia;
CREATE DATABASE arcadia;
USE arcadia;

-- Cambiado a minúsculas y plural para consistencia
CREATE TABLE clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE,
    telefono VARCHAR(20),
    calle VARCHAR(255),
    numero VARCHAR(20),
    c_postal VARCHAR(10)
);

CREATE TABLE proveedores (
    id_proveedor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE,
    telefono VARCHAR(20),
    calle VARCHAR(255),
    numero VARCHAR(20),
    c_postal VARCHAR(10)
);

CREATE TABLE productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    categoria VARCHAR(50),
    plataforma VARCHAR(50),
    precio_venta DECIMAL(10, 2) NOT NULL,
    precio_compra DECIMAL(10, 2) NOT NULL,
    id_proveedor INT,
    imagen VARCHAR(255) DEFAULT NULL, 
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor) ON DELETE SET NULL
);

CREATE TABLE empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE,
    telefono VARCHAR(20),
    puesto VARCHAR(50)
);

DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id_usuario INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol VARCHAR(20) DEFAULT 'admin',
    PRIMARY KEY (id_usuario),
    UNIQUE KEY (correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO usuarios (nombre, correo, contrasena, rol) 
VALUES ('Rafa_Dev', 'admin@arcadia.com', '1234', 'admin');