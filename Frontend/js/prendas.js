const apiUrl = 'http://localhost/ProyectoDesarrollo/api/public/index.php/Prendas';

// Elementos del DOM
const formContainer = document.getElementById('formularioPrenda');
const tituloFormulario = document.getElementById('tituloFormulario');
const form = document.getElementById('prendaForm');
const nombreInput = document.getElementById('nombre');
const marcaIdInput = document.getElementById('marca_id');
const stockInput = document.getElementById('stock');
const idInput = document.getElementById('id');
const tableBody = document.getElementById('prendaTableBody');
const btnNuevaPrenda = document.getElementById('btnNuevaPrenda');
const btnCancelar = document.getElementById('btnCancelar');

// Cargar prendas al iniciar
document.addEventListener('DOMContentLoaded', listarPrendas);

// Botón para agregar nueva prenda
btnNuevaPrenda.addEventListener('click', () => {
    idInput.value = '';  // Limpiamos el ID para "modo creación"
    nombreInput.value = ''; // Limpiamos los campos
    marcaIdInput.value = '';
    stockInput.value = '';
    tituloFormulario.innerText = 'Agregar Nueva Prenda';
    formContainer.style.display = 'block'; // Mostramos el formulario
});

// Botón de cancelar
btnCancelar.addEventListener('click', () => {
    formContainer.style.display = 'none'; // Ocultamos el formulario sin cambios
});

// Evento del formulario (crear o actualizar)
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = idInput.value;
    const nombre = nombreInput.value.trim();
    const marca_id = marcaIdInput.value;
    const stock = stockInput.value;

    if (!nombre) {
        notificador.mostrarMensaje('El nombre de la prenda no puede estar vacío', 'error');
        return;
    }

    if (!marca_id || isNaN(marca_id)) {
        notificador.mostrarMensaje('Debe seleccionar una marca válida', 'error');
        return;
    }

    if (!stock || isNaN(stock) || stock < 0) {
        notificador.mostrarMensaje('El stock debe ser un número positivo', 'error');
        return;
    }

    // Validar si el nombre ya existe
    const existe = await validarDuplicados(nombre);
    if (existe && !id) { // Solo validar duplicados si es una nueva prenda
        notificador.mostrarMensaje('Este nombre ya está registrado', 'error');
        return;
    }

    const prendaData = { nombre, marca_id, stock };
    id ? actualizarPrenda(id, prendaData) : crearPrenda(prendaData);
    formContainer.style.display = 'none'; // Ocultamos el formulario después de la acción
});

// Función para listar prendas
function listarPrendas() {
    fetch(apiUrl)
        .then(res => res.json())
        .then(data => {
            console.log("Datos recibidos:", data); // Verifica qué datos llegan

            tableBody.innerHTML = '';

            if (!data || data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="5">No hay prendas disponibles</td></tr>';
                return;
            }

            data.forEach(prenda => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${prenda.id}</td>
                    <td>${prenda.nombre}</td>
                    <td>${prenda.marca_id}</td>
                    <td>${prenda.stock}</td>
                    <td>
                        <button onclick="editarPrenda(${prenda.id}, '${prenda.nombre}', ${prenda.marca_id}, ${prenda.stock})">Editar</button>
                        <button onclick="eliminarPrenda(${prenda.id})">Eliminar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error('Error al listar prendas:', err);
            tableBody.innerHTML = '<tr><td colspan="5">Error al cargar las prendas</td></tr>';
        });
}

// Función para validar nombres duplicados
async function validarDuplicados(nombre) {
    try {
        const res = await fetch(apiUrl);
        const data = await res.json();
        return data.some(prenda => prenda.nombre.toLowerCase() === nombre.toLowerCase());
    } catch (err) {
        console.error('Error al validar duplicados:', err);
        return false;
    }
}

// Crear nueva prenda
function crearPrenda(prendaData) {
    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(prendaData)
    })
    .then(res => res.json())
    .then(() => {
        form.reset();
        listarPrendas();
        notificador.mostrarMensaje('Prenda creada con éxito', 'exito');
    })
    .catch(() => notificador.mostrarMensaje('Error al crear la prenda', 'error'));
}

// Actualizar prenda
function actualizarPrenda(id, prendaData) {
    fetch(`${apiUrl}?id=${id}`, { 
        method: 'PUT',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams(prendaData)
    })
    .then(res => res.json())
    .then(() => {
        form.reset();
        listarPrendas();
        notificador.mostrarMensaje('Prenda actualizada con éxito', 'exito');
    })
    .catch(() => notificador.mostrarMensaje('Error al actualizar la prenda', 'error'));
}

// Eliminar prenda con confirmación
function eliminarPrenda(id) {
    if (confirm('¿Estás seguro de eliminar esta prenda?')) {
        fetch(`${apiUrl}?id=${id}`, { 
            method: 'DELETE'
        })
        .then(res => res.json())
        .then(() => {
            listarPrendas();
            notificador.mostrarMensaje('Prenda eliminada con éxito', 'exito');
        })
        .catch(() => notificador.mostrarMensaje('Error al eliminar la prenda', 'error'));
    }
}

// Editar prenda (Activa modo edición)
function editarPrenda(id, nombre, marca_id, stock) {
    idInput.value = id;
    nombreInput.value = nombre;
    marcaIdInput.value = marca_id;
    stockInput.value = stock;
    tituloFormulario.innerText = 'Editar Prenda';
    formContainer.style.display = 'block'; // Mostramos el formulario en modo edición
}