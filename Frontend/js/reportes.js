const apiBaseUrl='http://localhost/ProyectoDesarrollo/api/public/index.php/vistas';

// Elementos del DOM
const tableMarcasVentasBody = document.getElementById('marcasVentasTableBody');
const tablePrendasStockBody = document.getElementById('prendasStockTableBody');
const tableTopMarcasBody = document.getElementById('topMarcasTableBody');

// Cargar reportes al iniciar
document.addEventListener('DOMContentLoaded', () => {
    listarMarcasConVentas();
    listarPrendasVendidasYStock();
    listarTop5MarcasMasVendidas();
});

// Función para listar marcas con ventas
function listarMarcasConVentas() {
    fetch(`${apiBaseUrl}/MarcasConVentas`)
        .then(res => res.json())
        .then(data => {
            console.log("Recibiendo datos en listarMarcasConVentas:", data);
            tableMarcasVentasBody.innerHTML = ''; // Limpiar la tabla antes de agregar datos

            if (!data || data.length === 0) {
                tableMarcasVentasBody.innerHTML = '<tr><td colspan="1">No hay marcas registradas con ventas</td></tr>';
                return;
            }

            data.forEach(marca => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${marca.nombre}</td>`;
                tableMarcasVentasBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error('Error al listar marcas con ventas:', err);
            tableMarcasVentasBody.innerHTML = '<tr><td colspan="1">Error al cargar los datos</td></tr>';
        });
}

// Función para listar prendas vendidas y stock restante
function listarPrendasVendidasYStock() {
    fetch(`${apiBaseUrl}/PrendasVendidasYStock`)
        .then(res => res.json())
        .then(data => {
            tablePrendasStockBody.innerHTML = '';

            if (!data || data.length === 0) {
                tablePrendasStockBody.innerHTML = '<tr><td colspan="3">No hay registros de prendas vendidas</td></tr>';
                return;
            }

            data.forEach(prenda => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${prenda.nombre}</td>
                    <td>${prenda.TotalVendido}</td>
                    <td>${prenda.StockActual}</td>
                `;
                tablePrendasStockBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error('Error al listar prendas vendidas y stock:', err);
            tablePrendasStockBody.innerHTML = '<tr><td colspan="3">Error al cargar los datos</td></tr>';
        });
}

// Función para listar las 5 marcas más vendidas
function listarTop5MarcasMasVendidas() {
    fetch(`${apiBaseUrl}/Top5MarcasMasVendidas`)
        .then(res => res.json())
        .then(data => {
            tableTopMarcasBody.innerHTML = '';

            if (!data || data.length === 0) {
                tableTopMarcasBody.innerHTML = '<tr><td colspan="2">No hay datos de marcas vendidas</td></tr>';
                return;
            }

            data.forEach(marca => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${marca.nombre}</td>
                    <td>${marca.TotalVendido}</td>
                `;
                tableTopMarcasBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error('Error al listar marcas más vendidas:', err);
            tableTopMarcasBody.innerHTML = '<tr><td colspan="2">Error al cargar los datos</td></tr>';
        });
}