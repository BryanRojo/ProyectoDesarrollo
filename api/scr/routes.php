<?php
require_once 'controllers/MarcasController.php';
require_once 'controllers/PrendasController.php';
require_once 'controllers/VentasController.php';
require_once 'controllers/VistasController.php';
require_once "utils/Auth.php";

// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener la ruta solicitada y quitar 'public' si es necesario
$requestUri = trim(str_replace('/ProyectoDesarrollo/api/public', '', $_SERVER['REQUEST_URI']), '/');
$requestUriWithoutQuery = strtok($requestUri, '?'); // Eliminar parámetros de la URL
$segments = explode('/', $requestUriWithoutQuery);

// Obtener parámetros de la URL
$queryString = $_SERVER['QUERY_STRING'] ?? '';
parse_str($queryString, $queryParams);
$id = $queryParams['id'] ?? null;

/////////////////////////////////// Endpoints Marcas ///////////////////////////////////
if (isset($segments[1]) && $segments[1] == "Marcas") {
    $Marcas = new MarcasController();

    switch ($method) {
        case 'GET':
            $id ? $Marcas->obtenerMarca($id) : $Marcas->obtenerTodasMarcas();
            break;
        case 'POST':
            $Marcas->crearMarca();
            break;
        case 'PUT':
            $Marcas->actualizarMarca($id);
            break;
        case 'DELETE':
            $Marcas->eliminarMarca($id);
            break;
        default:
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
}

/////////////////////////////////// Endpoints Prendas ///////////////////////////////////
if (isset($segments[1]) && $segments[1] == "Prendas") {
    $Prendas = new PrendasController();

    switch ($method) {
        case 'GET':
            $id ? $Prendas->obtenerPrenda($id) : $Prendas->obtenerTodasPrendas();
            break;
        case 'POST':
            $Prendas->crearPrenda();
            break;
        case 'PUT':
            $Prendas->actualizarPrenda($id);
            break;
        case 'DELETE':
            $Prendas->eliminarPrenda($id);
            break;
        default:
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
}

/////////////////////////////////// Endpoints Ventas ///////////////////////////////////
if (isset($segments[1]) && $segments[1] == "Ventas") {
    $Ventas = new VentasController();

    switch ($method) {
        case 'GET':
            $id ? $Ventas->obtenerVenta($id) : $Ventas->obtenerTodasVentas();
            break;
        case 'POST':
            $Ventas->crearVenta();
            break;
        case 'PUT':
            $Ventas->actualizarVenta($id);
            break;
        case 'DELETE':
            $Ventas->eliminarVenta($id);
            break;
        default:
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
}

/////////////////////////////////// Endpoints Vistas ///////////////////////////////////
if (isset($segments[1]) && ($segments[1]) == "vistas") {
    $Vistas = new VistasController();
    
    if (isset($segments[2])) {
        switch ($segments[2]) {
            case 'MarcasConVentas':
                $Vistas->obtenerMarcasConVentas();
                break;
            case 'PrendasVendidasYStock':
                $Vistas->obtenerPrendasVendidasYStock();
                break;
            case 'Top5MarcasMasVendidas':
                $Vistas->obtenerTop5MarcasMasVendidas();
                break;
            default:
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['error' => 'Vista no encontrada']);
                break;
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'No se especificó la vista a consultar']);
    }
}







