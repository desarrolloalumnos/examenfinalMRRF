<?php

namespace Controllers;

use Exception;
use Model\Habitacion;
use MVC\Router;

class HabitacionController {
    public static function index(Router $router){
        $router->render('habitaciones/habitacionesadmin/index', []);
    }
    public static function indexclientes(Router $router){
        $router->render('habitaciones/habitacionesclientes/index', []);
    }
 
    // public static function indexreservaciones(Router $router){
    //     $router->render('reservaciones/index', []);
    // }


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


    public static function buscarAPI() {
        $habitacion_numero = $_GET['habitacion_numero'] ?? '';
        $habitacion_tipo = $_GET['habitacion_tipo'] ?? '';
        $habitacion_descripcion = $_GET['habitacion_descripcion'] ?? '';
        $precio_minimo = $_GET['precio_minimo'] ?? null;
        $precio_maximo = $_GET['precio_maximo'] ?? null;
    
        $sql = "SELECT * FROM habitaciones WHERE habitacion_situacion = 1 ";
        
        if ($habitacion_numero != '') {           
            $sql .= " AND TO_CHAR(habitacion_numero) LIKE '%$habitacion_numero%' ";
        }

        if ($habitacion_tipo != '') {
            //Sanitizar y validar $habitacion_tipo si es necesario
            $habitacion_tipo = strtolower($habitacion_tipo);
            $sql .= " AND LOWER(habitacion_tipo) LIKE '%$habitacion_tipo%' ";
        }
            
        if ($habitacion_descripcion != '') {
            //Sanitizar y validar $habitacion_descripcion si es necesario
            $habitacion_descripcion = strtolower($habitacion_descripcion);
            $sql .= " AND LOWER(habitacion_descripcion) LIKE '%$habitacion_descripcion%' ";
        }
            
        if ($precio_minimo !== null && $precio_maximo !== null) {
            $sql .= " AND habitacion_tarifa BETWEEN $precio_minimo AND $precio_maximo ";
        } elseif ($precio_minimo !== null) {
            $sql .= " AND habitacion_tarifa >= $precio_minimo ";
        } elseif ($precio_maximo !== null) {
            $sql .= " AND habitacion_tarifa <= $precio_maximo ";
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
