# ProyectoDesarrollo
Proyecto Desarrollo de Plataformas abierta. Universidad Florencio Del Castillo. I Cuatrimestre del 2025

## Descripción del Proyecto
Este proyecto consiste en la creación y gestión de una base de datos para una tienda de ropa. La base de datos contempla marcas, prendas y ventas, con el objetivo de organizar y mantener un registro detallado de las operaciones de la tienda.Donde esto luego se va a ver relacionado a un desarrollo de prgramacion por capas.

## Estructura del Proyecto
- **scripts**: Carpeta que contiene el archivo `operaciones_base_de_datos.sql` con todas las instrucciones SQL necesarias para crear y gestionar la base de datos.

## Diagrama de la Estructura de la Base de Datos
![Diagrama](diagrams/DiagramaTienda.png)

## Lista de Integrantes del Proyecto
- Bryan Castro Castillo




## Documentación Endpoints Disponibles
En este apartado vamos a explicar como funcionan los Endpoints disponibles en el sistema.

## Marcas
- GET http://localhost/ProyectoDesarrollo/api/public/index.php/Marcas - Obtener todas las marcas<br>

    Respuesta de la solicitud:

```json
[
    {
        "id": 1,
        "nombre": "Nike"
    },
    {
        "id": 2,
        "nombre": "Adidas"
    },
    {
        "id": 3,
        "nombre": "Puma"
    },
    {
        "id": 4,
        "nombre": "Reebok"
    },
    {
        "id": 5,
        "nombre": "Under Armour"
    }
]
```



- GET http://localhost/ProyectoDesarrollo/api/public/index.php/Marcas?id={id} - Obtener una marca específica<br>

    Por ejemplo id={1}

    Respuesta de la solicitud:

```json
[
    {
        "id": 1,
        "nombre": "Nike"
    }
]
```



- POST http://localhost/ProyectoDesarrollo/api/public/index.php/Marcas - Crear nueva marca<br>

    En Body (x-www-form-urlencoded): Se debe ingresar la **key** que es "nombre". Y el **valor** en este caso Puma.<br>
    
    Respuesta de la solicitud:

```json
    {
    "success": "Marca creada exitosamente"
    }
```




- PUT http://localhost/ProyectoDesarrollo/api/public/index.php/Marcas?id={id} - Actualizar una marca<br>

    Por ejemplo id={8}, es donde esta Puma

    En Body (x-www-form-urlencoded): Se debe ingresar la **key** que es "nombre". Y el **valor** en este caso PumaActualizado.<br>

    Respuesta de la solicitud:

```json
    {
    "success": "Marca creada exitosamente"
    }
```



- DELETE http://localhost/ProyectoDesarrollo/api/public/index.php/ Marcas?id={id} - Eliminar una marca

    Por ejemplo id={8}, es donde esta PumaActualizado

    Respuesta de la solicitud:

```json
    {
    "success": "Marca eliminada exitosamente"
    }
```












## Prendas
- GET http://localhost/ProyectoDesarrollo/api/public/index.php/Prendas - Obtener todas las prendas<br>

    Respuesta de la solicitud:

```json
[
    {
        "id": 1,
        "nombre": "Camiseta Nike",
        "marca_id": 1,
        "stock": 90
    },
    {
        "id": 2,
        "nombre": "Zapatillas Adidas",
        "marca_id": 2,
        "stock": 50
    },
    {
        "id": 3,
        "nombre": "Sudadera Puma",
        "marca_id": 3,
        "stock": 75
    },
    {
        "id": 4,
        "nombre": "Pantalón Reebok",
        "marca_id": 4,
        "stock": 60
    },
    {
        "id": 5,
        "nombre": "Chaqueta Under Armour",
        "marca_id": 5,
        "stock": 80
    },
    {
        "id": 6,
        "nombre": "Calcetas Nike",
        "marca_id": 1,
        "stock": 150
    },
    {
        "id": 7,
        "nombre": "Gorra Adidas",
        "marca_id": 2,
        "stock": 40
    },
    {
        "id": 8,
        "nombre": "Short Puma",
        "marca_id": 3,
        "stock": 55
    },
    {
        "id": 9,
        "nombre": "Mochila Reebok",
        "marca_id": 4,
        "stock": 30
    },
    {
        "id": 10,
        "nombre": "Guantes Under Armour",
        "marca_id": 5,
        "stock": 45
    }
]
```

- GET http://localhost/ProyectoDesarrollo/api/public/index.php/Prendas?id={id} - Obtener una prenda específica<br>

    Por ejemplo id={1}

    Respuesta de la solicitud:

```json
[
    {
    "id": 1,
    "nombre": "Camiseta Nike",
    "marca_id": 1,
    "stock": 90
    }
]
```

- POST http://localhost/ProyectoDesarrollo/api/public/index.php/Prendas - Crear nueva prenda

    En Body (x-www-form-urlencoded): Se debe ingresar la **key** que es "nombre", "marca_id" y "stock". Y el **valor** en este caso "Camisa", "1", "20".<br>

    Respuesta de la solicitud:

```json
    {
    "success": "Prenda creada exitosamente"
    }
```

- PUT http://localhost/ProyectoDesarrollo/api/public/index.php/Prendas?id={id} - Actualizar prenda

    Por ejemplo id={11}, es donde esta Camisa

    En Body (x-www-form-urlencoded): Se debe ingresar la **key** que es "nombre", "marca_id" y "stock". Y el **valor** en este caso "CamisaActualizada", "1", "20".<br>

    Respuesta de la solicitud:

```json
    {
    "success": "Prenda actualizada exitosamente"
    }
```

- DELETE http://localhost/ProyectoDesarrollo/api/public/index.php/Prendas?id={id} - Eliminar prenda

    Por ejemplo id={11}, es donde esta CamisaActualizada

    Respuesta de la solicitud:

```json
    {
    "success": "Prenda eliminada exitosamente"
    }
```













## Ventas
- GET http://localhost/ProyectoDesarrollo/api/public/index.php/Ventas - Obtener todas las ventas<br>

    Respuesta de la solicitud:

```json
[
    {
        "id": 1,
        "nombre": "Camiseta Nike",
        "marca_id": 1,
        "stock": 90
    },
    {
        "id": 2,
        "nombre": "Zapatillas Adidas",
        "marca_id": 2,
        "stock": 50
    },
    {
        "id": 3,
        "nombre": "Sudadera Puma",
        "marca_id": 3,
        "stock": 75
    },
    {
        "id": 4,
        "nombre": "Pantalón Reebok",
        "marca_id": 4,
        "stock": 60
    },
    {
        "id": 5,
        "nombre": "Chaqueta Under Armour",
        "marca_id": 5,
        "stock": 80
    },
    {
        "id": 6,
        "nombre": "Calcetas Nike",
        "marca_id": 1,
        "stock": 150
    },
    {
        "id": 7,
        "nombre": "Gorra Adidas",
        "marca_id": 2,
        "stock": 40
    },
    {
        "id": 8,
        "nombre": "Short Puma",
        "marca_id": 3,
        "stock": 55
    },
    {
        "id": 9,
        "nombre": "Mochila Reebok",
        "marca_id": 4,
        "stock": 30
    },
    {
        "id": 10,
        "nombre": "Guantes Under Armour",
        "marca_id": 5,
        "stock": 45
    }
]
```

- GET http://localhost/ProyectoDesarrollo/api/public/index.php/Ventas?id={id} - Obtener venta específica<br> 

    Por ejemplo id={1}

    Respuesta de la solicitud:

```json
[
    {
    "id": 1,
    "prenda_id": 1,
    "fecha_venta": "2025-02-01",
    "cantidad": 10
    }   
]
```

- POST http://localhost/ProyectoDesarrollo/api/public/index.php/Ventas - Crear nueva venta

    En Body (x-www-form-urlencoded): Se debe ingresar la **key** que es "prenda_id", "fecha_venta" y "cantidad". Y el **valor** en este caso "1", "2024-03-24", "3".<br>

    Respuesta de la solicitud:

```json
    {
    "success": "Venta creada exitosamente"
    }
```

- PUT http://localhost/ProyectoDesarrollo/api/public/index.php/Ventas?id={id} - Actualizar venta

    Por ejemplo id={11}, es donde esta la venta que se creó

    En Body (x-www-form-urlencoded): Se debe ingresar la **key** que es "prenda_id", "fecha_venta" y "cantidad". Y el **valor** en este caso "1", "2024-03-24", "100".<br>

    Respuesta de la solicitud:

```json
    {
    "success": "Venta actualizada exitosamente"
    }
```


- DELETE http://localhost/ProyectoDesarrollo/api/public/index.php/Ventas?id={id} - Eliminar venta

    Por ejemplo id={11}, es donde esta la venta

    Respuesta de la solicitud:

```json
[
    {
    "id": 1,
    "prenda_id": 1,
    "fecha_venta": "2025-02-01",
    "cantidad": 10
    }   
]
```

```json
    {
    "success": "Venta eliminada exitosamente"
    }
```







## Vistas
- GET http://localhost/ProyectoDesarrollo/api/public/index.php/vistas/MarcasConVentas - Obtener todas las ventas con al menos una venta<br>

    Respuesta de la solicitud:

```json
[
    {
        "nombre": "Nike"
    },
    {
        "nombre": "Adidas"
    },
    {
        "nombre": "Puma"
    },
    {
        "nombre": "Reebok"
    },
    {
        "nombre": "Under Armour"
    }
]
```

- GET http://localhost/ProyectoDesarrollo/api/public/index.php/vistas/PrendasVendidasYStock - Prendas vendidas y stock restante

    Respuesta de la solicitud:

```json
[
    {
        "nombre": "Calcetas Nike",
        "TotalVendido": "20",
        "StockActual": "130"
    },
    {
        "nombre": "Camiseta Nike",
        "TotalVendido": "10",
        "StockActual": "80"
    },
    {
        "nombre": "Chaqueta Under Armour",
        "TotalVendido": "7",
        "StockActual": "73"
    },
    {
        "nombre": "Gorra Adidas",
        "TotalVendido": "15",
        "StockActual": "25"
    },
    {
        "nombre": "Guantes Under Armour",
        "TotalVendido": "8",
        "StockActual": "37"
    },
    {
        "nombre": "Mochila Reebok",
        "TotalVendido": "5",
        "StockActual": "25"
    },
    {
        "nombre": "Pantalón Reebok",
        "TotalVendido": "12",
        "StockActual": "48"
    },
    {
        "nombre": "Short Puma",
        "TotalVendido": "10",
        "StockActual": "45"
    },
    {
        "nombre": "Sudadera Puma",
        "TotalVendido": "8",
        "StockActual": "67"
    }
]
```


- GET http://localhost/ProyectoDesarrollo/api/public/index.php/vistas/Top5MarcasMasVendidas - Top 5 marcas más vendidas

    Respuesta de la solicitud:

```json
[
    {
        "nombre": "Nike",
        "TotalVendido": "30"
    },
    {
        "nombre": "Puma",
        "TotalVendido": "18"
    },
    {
        "nombre": "Reebok",
        "TotalVendido": "17"
    },
    {
        "nombre": "Under Armour",
        "TotalVendido": "15"
    },
    {
        "nombre": "Adidas",
        "TotalVendido": "15"
    }
]
```





