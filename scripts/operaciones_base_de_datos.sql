-- a. Creación de la base de datos
CREATE DATABASE TiendaRopa;
USE TiendaRopa;

-- b. Creación de las tablas

-- Tabla Marcas
CREATE TABLE Marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla Prendas
CREATE TABLE Prendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca_id INT NOT NULL,
    stock INT NOT NULL CHECK (stock >= 0),
    FOREIGN KEY (marca_id) REFERENCES Marcas(id)
);

-- Tabla Ventas
CREATE TABLE Ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenda_id INT NOT NULL,
    fecha_venta DATE NOT NULL,
    cantidad INT NOT NULL CHECK (cantidad > 0),
    FOREIGN KEY (prenda_id) REFERENCES Prendas(id)
);

-- d. Inserción de datos de ejemplo a las tablas

-- Datos de ejemplo para Marcas (aseguramos que haya al menos 5 marcas)
INSERT INTO Marcas (nombre) VALUES ('Nike');
INSERT INTO Marcas (nombre) VALUES ('Adidas');
INSERT INTO Marcas (nombre) VALUES ('Puma');
INSERT INTO Marcas (nombre) VALUES ('Reebok');
INSERT INTO Marcas (nombre) VALUES ('Under Armour');

-- Datos de ejemplo para Prendas
INSERT INTO Prendas (nombre, marca_id, stock) VALUES 
('Camiseta Nike', 1, 100),
('Zapatillas Adidas', 2, 50),
('Sudadera Puma', 3, 75),
('Pantalón Reebok', 4, 60),
('Chaqueta Under Armour', 5, 80),
('Calcetas Nike', 1, 150),
('Gorra Adidas', 2, 40),
('Short Puma', 3, 55),
('Mochila Reebok', 4, 30),
('Guantes Under Armour', 5, 45);

-- Datos de ejemplo para Ventas
INSERT INTO Ventas (prenda_id, fecha_venta, cantidad) VALUES 
(1, '2025-02-01', 10),
(2, '2025-02-02', 5),
(3, '2025-02-03', 8),
(4, '2025-02-03', 12),
(5, '2025-02-04', 7),
(6, '2025-02-05', 20),
(7, '2025-02-06', 15),
(8, '2025-02-07', 10),
(9, '2025-02-08', 5),
(10, '2025-02-09', 8);

-- e. Eliminación de algún dato
DELETE FROM Ventas WHERE id = 2;

-- f. Actualización de algún dato
UPDATE Prendas SET stock = 90 WHERE id = 1;

-- g. Consultas (SELECT) de los datos

-- g.i. Obtener la cantidad vendida de prendas por fecha y filtrarla con una fecha específica
SELECT Prendas.nombre, SUM(Ventas.cantidad) AS TotalVendido
FROM Ventas
JOIN Prendas ON Ventas.prenda_id = Prendas.id
WHERE Ventas.fecha_venta = '2025-02-03'
GROUP BY Prendas.nombre;

-- h. Creación de vistas

-- i. Obtener la lista de todas las marcas que tienen al menos una venta
CREATE VIEW MarcasConVentas AS
SELECT DISTINCT Marcas.nombre
FROM Marcas
JOIN Prendas ON Marcas.id = Prendas.marca_id
JOIN Ventas ON Prendas.id = Ventas.prenda_id;

-- ii. Obtener prendas vendidas y su cantidad restante en stock
CREATE VIEW PrendasVendidasYStock AS
SELECT Prendas.nombre, SUM(Ventas.cantidad) AS TotalVendido, 
       (Prendas.stock - SUM(Ventas.cantidad)) AS StockActual
FROM Prendas
JOIN Ventas ON Prendas.id = Ventas.prenda_id
GROUP BY Prendas.nombre, Prendas.stock;

-- iii. Obtener listado de las 5 marcas más vendidas y su cantidad de ventas
CREATE VIEW Top5MarcasMasVendidas AS
SELECT Marcas.nombre, SUM(Ventas.cantidad) AS TotalVendido
FROM Marcas
JOIN Prendas ON Marcas.id = Prendas.marca_id
JOIN Ventas ON Prendas.id = Ventas.prenda_id
GROUP BY Marcas.nombre
ORDER BY TotalVendido DESC
LIMIT 5;
