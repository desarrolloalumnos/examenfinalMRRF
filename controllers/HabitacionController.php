<?php

namespace Controllers;

use Exception;
use Model\Habitacion;
use MVC\Router;

class HabitacionController {
    public static function index(Router $router){
        $router->render('habitacionesadmin/index', []);
    }


    public static function guardarApi(){
     
        try {
            $habitacion = new Habitacion($_POST);
            $resultado = $habitacion->crear();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function buscarAPI(){
        // $productos = Producto::all();
        $habitacion_numero = $_GET['habitacion_numero'];
        $habitacion_tipo = $_GET['habitacion_tipo'];

        $sql = "SELECT * FROM habitaciones where habitacion_situacion = 1 ";
        if($habitacion_numero != '') {
            $sql.= " and habitacion_numero like '%$habitacion_numero%' ";
        }
        if($habitacion_tipo != '') {
            $sql.= " and habitacion_tipo = $habitacion_tipo ";
        }
        try {
            
            $habitaciones = Habitacion::fetchArray($sql);
    
            echo json_encode($habitaciones);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function modificarAPI()
    {
        try {
            $habitacion = new Habitacion($_POST);
            $resultado = $habitacion->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI()
    {
        try {
            $habitacion_id = $_POST['habitacion_id'];
            $habitacion = Habitacion::find($habitacion_id);
            $habitacion->habitacion_situacion = 0;
            $resultado = $habitacion->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
            // echo json_encode($resultado);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
