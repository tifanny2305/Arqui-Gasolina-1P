<?php
require_once __DIR__ . '/../model/Msucursal.php';

class Csucursal
{
    private $Msucursal;

    public function __construct()
    {
        $this->Msucursal = new Msucursal();
    }

    public function mostrar_crear_sucursal()
    {
        require_once __DIR__ . '/../view/Vsucursal/create.php';
    }

    public function crear_sucursal()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger datos del formulario
            $nombre = $_POST['nombre'];
            $ubicacion = $_POST['ubicacion'];
            $bombas = $_POST['bombas'];

            if (empty($nombre) || empty($ubicacion) || empty($bombas)) {
                echo "Por favor, complete todos los campos.";
                return;
            }

            if ($this->Msucursal->crearSucursal($nombre, $ubicacion, $bombas)) {
                echo "Sucursal registrada correctamente.";
                header("Location: index.php?action=sucursales");
                exit();
            } else {
                echo "Error al registrar la sucursal.";
            }
        }
    }

    public function indexS()
    {
        $sucursales = $this->Msucursal->obtenerSucursales(); 
        require_once __DIR__ . '/../view/Vsucursal/index.php';
    }

    public function editar_sucursal()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sucursal = $this->Msucursal->obtenerSucursalPorId($id);
            require_once __DIR__ . '/../view/Vsucursal/edit.php';
        } else {
            echo "ID no proporcionado.";
        }
    }

    public function actualizar_sucursal()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $ubicacion = $_POST['ubicacion'];
            $bombas = $_POST['bombas'];

            if (empty($nombre) || empty($ubicacion) || empty($bombas)) {
                echo "Por favor, complete todos los campos.";
                return;
            }

            if ($this->Msucursal->actualizarSucursal($id, $nombre, $ubicacion, $bombas)) {
                echo "Sucursal actualizada correctamente.";
            } else {
                echo "Error al actualizar la sucursal.";
            }
        }
    }

    public function eliminar_sucursal()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($this->Msucursal->eliminarSucursal($id)) {
                header("Location: index.php?action=sucursales");
                exit;
            } else {
                echo "Error al eliminar la sucursal.";
            }
        } else {
            echo "ID no proporcionado.";
        }
    }

}
?>
