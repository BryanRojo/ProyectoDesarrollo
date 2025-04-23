const apiUrl = 'http://localhost/ProyectoDesarrollo/api/public/index.php/Marcas';

// Elementos del DOM
const formContainer = document.getElementById('formularioMarca');
const tituloFormulario = document.getElementById('tituloFormulario');
const form = document.getElementById('marcaForm');
const nombreInput = document.getElementById('nombre');
const idInput = document.getElementById('id');
const tableBody = document.getElementById('marcaTableBody');
const btnNuevaMarca = document.getElementById('btnNuevaMarca');
const btnCancelar = document.getElementById('btnCancelar');

// Cargar marcas al iniciar
document.addEventListener('DOMContentLoaded', listarMarcas);

// **Botón para agregar nueva marca**
btnNuevaMarca.addEventListener('click', () => {
    idInput.value = '';  // Limpiamos el ID para "modo creación"
    nombreInput.value = ''; // Limpiamos el campo de nombre
    tituloFormulario.innerText = 'Agregar Nueva Marca';
    formContainer.style.display = 'block'; // Mostramos el formulario
});

// **Botón de cancelar**
btnCancelar.addEventListener('click', () => {
    formContainer.style.display = 'none'; // Ocultamos el formulario sin cambios
});

// **Evento del formulario (crear o actualizar)**
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = idInput.value;
    const nombre = nombreInput.value.trim();

    if (!nombre) {
        notificador.mostrarMensaje('El nombre de la marca no puede estar vacío', 'error');
        return;
    }

    // Validar si el nombre ya existe
    const existe = await validarDuplicados(nombre);
    if (existe && !id) { // Solo validar duplicados si es una nueva marca
        notificador.mostrarMensaje('Este nombre ya está registrado', 'error');
        return;
    }

    id ? actualizarMarca(id, nombre) : crearMarca(nombre);
    formContainer.style.display = 'none'; // Ocultamos el formulario después de la acción
});

// Función para listar marcas sin recargar la página
function listarMarcas() {
    fetch(apiUrl)
        .then(res => res.json())
        .then(data => {
            console.log("Datos recibidos:", data); // Verifica qué datos llegan

            tableBody.innerHTML = '';

            if (!data || data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="3">No hay marcas disponibles</td></tr>';
                return;
            }

            data.forEach(marca => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${marca.id}</td>
                    <td>${marca.nombre}</td>
                    <td>
                        <button onclick="editarMarca(${marca.id}, '${marca.nombre}')">Editar</button>
                        <button onclick="eliminarMarca(${marca.id})">Eliminar</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(err => {
            console.error('Error al listar marcas:', err);
            tableBody.innerHTML = '<tr><td colspan="3">Error al cargar las marcas</td></tr>';
        });
}

// **Función para validar nombres duplicados**
async function validarDuplicados(nombre) {
    try {
        const res = await fetch(apiUrl);
        const data = await res.json();
        return data.some(marca => marca.nombre.toLowerCase() === nombre.toLowerCase());
    } catch (err) {
        console.error('Error al validar duplicados:', err);
        return false;
    }
}

// Crear nueva marca sin recargar
function crearMarca(nombre) {
    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ nombre }) // Ajuste para enviar datos correctamente
    })
    .then(res => res.json())
    .then(() => {
        form.reset();
        listarMarcas();
        notificador.mostrarMensaje('Marca creada con éxito', 'exito');
    })
    .catch(() => notificador.mostrarMensaje('Error al crear la marca', 'error'));
}

// Actualizar marca sin recargar
function actualizarMarca(id, nombre) {
    fetch(`${apiUrl}?id=${id}`, { 
        method: 'PUT',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ nombre }) // Ajuste para enviar datos correctamente
    })
    .then(res => res.json())
    .then(() => {
        form.reset();
        listarMarcas();
        notificador.mostrarMensaje('Marca actualizada con éxito', 'exito');
    })
    .catch(() => notificador.mostrarMensaje('Error al actualizar la marca', 'error'));
}

// Eliminar marca con confirmación
function eliminarMarca(id) {
    if (confirm('¿Estás seguro de eliminar esta marca?')) {
        fetch(`${apiUrl}?id=${id}`, { 
            method: 'DELETE'
        })
        .then(res => res.json())
        .then(() => {
            listarMarcas();
            notificador.mostrarMensaje('Marca eliminada con éxito', 'exito');
        })
        .catch(() => notificador.mostrarMensaje('Error al eliminar la marca', 'error'));
    }
}

// **Editar marca (Activa modo edición)**
function editarMarca(id, nombre) {
    idInput.value = id;
    nombreInput.value = nombre;
    tituloFormulario.innerText = 'Editar Marca';
    formContainer.style.display = 'block'; // Mostramos el formulario en modo edición
}