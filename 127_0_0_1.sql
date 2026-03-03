CREATE DATABASE SistemaUsuarios;
USE SistemaUsuarios;

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    username VARCHAR(20) NOT NULL,
    password CHAR(60) NOT NULL,
    email VARCHAR(50) NOT NULL,
    categoria CHAR(15) NOT NULL DEFAULT 'Usuario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Inserción de datos limpia
INSERT INTO usuarios (nombre, apellido, username, password, email, categoria) 
VALUES ('Pedro', 'Ramieres', 'pedrami', '123', 'ped@gmail.com', 'Admin');

INSERT INTO usuarios (nombre, apellido, username, password, email, categoria) 
VALUES ('Hect', 'Ramiro', 'adad', '123', 'fef@gmail.com', 'tecnico');