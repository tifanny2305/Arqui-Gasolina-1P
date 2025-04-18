<?php
require_once __DIR__ . '/controller/Csucursal.php';
require_once __DIR__ . '/controller/Ccombustible.php';

$Csucursal = new Csucursal();
$Ccombustible = new Ccombustible();
$action = $_GET['action'] ?? 'menu';

switch ($action) {
    // Menú principal
    case 'menu':
        require_once __DIR__ . '/view/menu.php';
        break;
        
    // Acciones para sucursales
    case 'sucursales':
        $Csucursal->indexS();
        break;
    case 'crear_sucursal':
        $Csucursal->mostrar_crear_sucursal();
        break;  
    case 'registrar_sucursal':
        $Csucursal->crear_sucursal();
        break;
    case 'editar_sucursal':
        $Csucursal->editar_sucursal();
        break;
    case 'actualizar_sucursal':
        $Csucursal->actualizar_sucursal();
        break;
    case 'eliminar_sucursal':
        $Csucursal->eliminar_sucursal();
        break;
        
    // Acciones para combustibles
    case 'combustibles':
        $Ccombustible->indexC();
        break;
    case 'crear_combustible':
        $Ccombustible->mostrar_crear_combustible();
        break;
    case 'registrar_combustible':
        $Ccombustible->crear_combustible();
        break;
    case 'editar_combustible':
        $Ccombustible->editar_combustible();
        break;
    case 'actualizar_combustible':
        $Ccombustible->actualizar_combustible();
        break;
    case 'eliminar_combustible':
        $Ccombustible->eliminar_combustible();
        break;
        
    default:
        echo "Acción no válida.";
        break;
}

?>
