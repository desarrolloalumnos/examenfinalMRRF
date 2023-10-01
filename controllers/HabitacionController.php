<?php

namespace Controllers;

use Exception;
use Model\Habitacion;
use MVC\Router;

class HabitacionController {
    public static function index(Router $router){
        $router->render('habitacionesadmin/index', []);
    }
    public static function indexclientes(Router $router){
        $router->render('habitacionesclientes/index', []);
    }
    public static function indexreservaciones(Router $router){
        $router->render('reservaciones/index', []);
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


   public static function buscarAPI()
    {
        $habitacion_numero = $_GET['habitacion_numero'] ?? '';
        $sql = "SELECT * FROM habitaciones WHERE habitacion_situacion = 1 ";
        if ($habitacion_numero != '') {
            $habitacion_numero = strtolower($habitacion_numero);
            $sql .= " AND LOWER(habitacion_numero) LIKE '%$habitacion_numero%' ";
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
