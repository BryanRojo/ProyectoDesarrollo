-- a. Creaci�n de la base de datos
CREATE DATABASE TiendaRopa;
USE TiendaRopa;

-- b. Creaci�n de las tablas

-- Tabla Marcas
CREATE TABLE Marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla Prendas
CREATE TABLE Prendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca_id INT,
    stock INT NOT NULL,
    FOREIGN KEY (marca_id) REFERENCES Marcas(id)
);

-- Tabla Ventas
CREATE TABLE Ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenda_id INT,
    fecha_venta DATE NOT NULL,
    cantidad INT NOT NULL,
    FOREIGN KEY (prenda_id) REFERENCES Prendas(id)
);

-- d. Inserci�n de datos de ejemplo a las tablas

-- Datos de ejemplo para Marcas
INSERT INTO Marcas (nombre) VALUES ('Nike');
INSERT INTO Marcas (nombre) VALUES ('Adidas');
INSERT INTO Marcas (nombre) VALUES ('Puma');

-- Datos de ejemplo para Prendas
INSERT INTO Prendas (nombre, marca_id, stock) VALUES ('Camiseta Nike', 1, 100);
INSERT INTO Prendas (nombre, marca_id, stock) VALUES ('Zapatillas Adidas', 2, 50);
INSERT INTO Prendas (nombre, marca_id, stock) VALUES ('Sudadera Puma', 3, 75);

-- Datos de ejemplo para Ventas
INSERT INTO Ventas (prenda_id, fecha_venta, cantidad) VALUES (1, '2025-02-01', 10);
INSERT INTO Ventas (prenda_id, fecha_venta, cantidad) VALUES (2, '2025-02-02', 5);
INSERT INTO Ventas (prenda_id, fecha_venta, cantidad) VALUES (3, '2025-02-03', 8);

-- e. Eliminaci�n de alg�n dato
DELETE FROM Ventas WHERE id = 2;

-- f. Actualizaci�n de alg�n dato
UPDATE Prendas SET stock = 90 WHERE id = 1;

-- g. Consultas (SELECT) de los datos

-- g.i. Obtener la cantidad vendida de prendas por fecha y filtrarla con una fecha espec�fica
SELECT Prendas.nombre, SUM(Ventas.cantidad) AS TotalVendido
FROM Ventas
JOIN Prendas ON Ventas.prenda_id = Prendas.id
WHERE Ventas.fecha_venta = '2025-02-03'
GROUP BY Prendas.nombre;

-- h. Creaci�n de vistas

-- Obtener el stock total de prendas agrupado por marca
CREATE VIEW StockPorMarca AS
SELECT Marcas.nombre AS Marca, SUM(Prendas.stock) AS TotalStock
FROM Marcas
JOIN Prendas ON Marcas.id = Prendas.marca_id
GROUP BY Marcas.nombre;

-- Obtener listado de las 3 marcas m�s vendidas y su cantidad de ventas
CREATE VIEW Top3MarcasMasVendidas AS
SELECT Marcas.nombre, SUM(Ventas.cantidad) AS TotalVendido
FROM Marcas
JOIN Prendas ON Marcas.id = Prendas.marca_id
JOIN Ventas ON Prendas.id = Ventas.prenda_id
GROUP BY Marcas.nombre
ORDER BY TotalVendido DESC
LIMIT 3;

-- Obtener el total de ventas por d�a
CREATE VIEW VentasPorDia AS
SELECT fecha_venta AS Dia, SUM(cantidad) AS TotalVendido
FROM Ventas
GROUP BY fecha_venta
ORDER BY fecha_venta;
