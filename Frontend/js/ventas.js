const apiUrl = 'http://localhost/ProyectoDesarrollo/api/public/index.php/Ventas';

// Elementos del DOM
const tableBody = document.getElementById('ventasTableBody');

// Cargar ventas al iniciar
document.addEventListener('DOMContentLoaded', listarVentas);

// Función para listar ventas
function listarVentas() {
    fetch(apiUrl)
        .then(res => res.json())
        .then(data => {
            console.log("Datos recibidos:", data); // Verifica qué datos llegan

            tableBody.innerHTML = '';

            if (!data || data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="4">No hay ventas disponibles</td></tr>';
                return;
            }

            data.forEach(venta => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${venta.id}</td>
                    <td>${venta.prenda_id}</td>
                    <td>${venta.fecha_venta}</td>
                    <td>${venta.cantidad}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error('Error al listar ventas:', err);
            tableBody.innerHTML = '<tr><td colspan="4">Error al cargar las ventas</td></tr>';
        });
}