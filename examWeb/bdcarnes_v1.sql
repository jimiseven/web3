-- Crear la base de datos
CREATE DATABASE bdcarnes_v1;

-- Seleccionar la base de datos
USE bdcarnes_v1;

-- Crear la tabla tipos_de_carnes
CREATE TABLE tipos_de_carnes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255) NOT NULL
);

-- Insertar algunos tipos de carnes
INSERT INTO tipos_de_carnes (tipo) VALUES ('Res'), ('Cerdo'), ('Pollo');

-- Crear la tabla carnes
CREATE TABLE carnes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    cantidad INT NOT NULL,
    costo DECIMAL(10, 2) NOT NULL,
    id_tipo INT,
    fecha_produccion DATE NOT NULL,
    FOREIGN KEY (id_tipo) REFERENCES tipos_de_carnes(id)
);

-- Crear la tabla informes
CREATE TABLE informes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_carne INT,
    descripcion TEXT NOT NULL,
    fecha_informe DATE NOT NULL,
    FOREIGN KEY (id_carne) REFERENCES carnes(id)
);

-- Insertar algunos registros de ejemplo
INSERT INTO carnes (nombre, cantidad, costo, id_tipo, fecha_produccion) VALUES 
('Bistec', 100, 5.99, 1, '2023-07-01'),
('Chuleta', 50, 4.50, 2, '2023-06-15'),
('Pechuga', 200, 3.75, 3, '2023-07-10');

INSERT INTO informes (id_carne, descripcion, fecha_informe) VALUES 
(1, 'Carne de res de alta calidad', '2023-07-02'),
(2, 'Cerdo con un buen marmoleo', '2023-06-16'),
(3, 'Pollo fresco y jugoso', '2023-07-11');
