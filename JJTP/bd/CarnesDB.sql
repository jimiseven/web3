-- Crear la base de datos
CREATE DATABASE CarnesDB;

-- Usar la base de datos
USE CarnesDB;

-- Crear la tabla de Proveedores
CREATE TABLE Proveedores (
    ProveedorID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Telefono VARCHAR(15),
    Direccion VARCHAR(255)
);

-- Crear la tabla de Carnes
CREATE TABLE Carnes (
    CarneID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Tipo VARCHAR(50) NOT NULL,
    Precio DECIMAL(10, 2) NOT NULL,
    ProveedorID INT,
    FOREIGN KEY (ProveedorID) REFERENCES Proveedores(ProveedorID)
);

-- Crear la tabla de Clientes
CREATE TABLE Clientes (
    ClienteID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL,
    Telefono VARCHAR(15),
    Direccion VARCHAR(255)
);

-- Crear la tabla de Pedidos
CREATE TABLE Pedidos (
    PedidoID INT PRIMARY KEY AUTO_INCREMENT,
    ClienteID INT,
    CarneID INT,
    Cantidad INT NOT NULL,
    FechaPedido DATE NOT NULL,
    FOREIGN KEY (ClienteID) REFERENCES Clientes(ClienteID),
    FOREIGN KEY (CarneID) REFERENCES Carnes(CarneID)
);

-- Insertar datos en la tabla de Proveedores
INSERT INTO Proveedores (Nombre, Telefono, Direccion) VALUES
('Proveedor A', '123456789', 'Calle Falsa 123'),
('Proveedor B', '987654321', 'Avenida Siempre Viva 456');

-- Insertar datos en la tabla de Carnes
INSERT INTO Carnes (Nombre, Tipo, Precio, ProveedorID) VALUES
('Carne de Res', 'Res', 15.50, 1),
('Carne de Pollo', 'Pollo', 8.75, 2);

-- Insertar datos en la tabla de Clientes
INSERT INTO Clientes (Nombre, Telefono, Direccion) VALUES
('Cliente 1', '555123456', 'Calle Luna 789'),
('Cliente 2', '555987654', 'Calle Sol 321');

-- Insertar datos en la tabla de Pedidos
INSERT INTO Pedidos (ClienteID, CarneID, Cantidad, FechaPedido) VALUES
(1, 1, 10, '2024-07-16'),
(2, 2, 5, '2024-07-16');
