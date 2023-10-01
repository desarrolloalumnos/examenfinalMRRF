<?php

namespace Controllers;
use Exception;
use Model\Reservacion;
use Model\Usuario;
use Model\Habitacion;
use MVC\Router;

class ReservacionController {
    public static function index(Router $router) {
      
       
            $clientes = static::usuarios();
            $habitaciones = static::habitaciones();

            $router->render('reservaciones/index', [
                'clientes' => $clientes,
                'habitaciones' => $habitaciones,
            ]);
     
    }

    public  static function habitaciones()
    {
        
        
        $sql = "SELECT * FROM habitaciones WHERE habitacion_situacion = 1 ";
        
        
        
        try {
            
            $habitacion = Habitacion::fetchArray($sql);
 
            if ($habitacion){
                
                return $habitacion; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    public  static function usuarios()
    {
        
        
        $sql = "SELECT * FROM usuario WHERE usu_situacion = 1 ";
        
        
        
        try {
            
            $usuarios = Usuario::fetchArray($sql);
 
            if ($usuarios){
                
                return $usuarios; 
            }else {
                return 0;
            }
        } catch (Exception $e) {
            
        }
    }
    public static function guardarApi() {

            
        try {
            if (isset($_POST['reserva_fecha_inicio'])) {
                $_POST['reserva_fecha_inicio'] = date('Y-m-d H:i', strtotime($_POST['reserva_fecha_inicio']));
            }
            if (isset($_POST['reserva_fecha_fin'])) {
                $_POST['reserva_fecha_fin'] = date('Y-m-d H:i', strtotime($_POST['reserva_fecha_fin']));
            }
    
            $reservacion = new Reservacion($_POST);
            // echo json_encode($_POST);
            // exit;
    
            $resultado = $reservacion->crear();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1,
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0,
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0,
            ]);
        }
    }
    

   
    public static function buscarApi()
    {
            $sql = "SELECT
            reserva_id,
            u.usu_nombre AS reserva_cliente_id,
            h.habitacion_numero AS reserva_habitacion_id,
            r.reserva_fecha_inicio,
            r.reserva_fecha_fin
        FROM
            reservas AS r
        JOIN
            usuario AS u ON r.reserva_cliente_id = u.usu_id
        JOIN
            habitaciones AS h ON r.reserva_habitacion_id = h.habitacion_id
        WHERE reserva_situacion = 1";
       
        try {
            $reservacion = Reservacion::fetchArray($sql);
            header('Content-Type: application/json');
            echo json_encode($reservacion);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    
    

    public static function modificarApi(){
     
        try {
            if (isset($_POST['reserva_fecha_inicio'])) {
                $_POST['reserva_fecha_inicio'] = date('Y-m-d H:i', strtotime($_POST['reserva_fecha_inicio']));
            }
            if (isset($_POST['reserva_fecha_fin'])) {
                $_POST['reserva_fecha_fin'] = date('Y-m-d H:i', strtotime($_POST['reserva_fecha_fin']));
            }
    
            $reservacion = new Reservacion($_POST);
            
            echo json_encode($_POST);
            exit;
            $resultado = $reservacion->actualizar();
    
            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1,
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0,
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0,
            ]);
        }
    }

    public static function eliminarApi()
    {
        try {
            $reserva_id = $_POST['reserva_id'];
            $reservacion = Reservacion::find($reserva_id);
            
            if ($reservacion) {
                // Cambiar la situacion de la reserva
                $reservacion->reserva_situacion = 0;
                
                // Guardar los cambios en la base de datos
                $resultado = $reservacion->actualizar();
    
                if ($resultado['resultado'] == 1) {
                    echo json_encode([
                        'mensaje' => 'Registro eliminado correctamente',
                        'codigo' => 1
                    ]);
                } else {
                    echo json_encode([
                        'mensaje' => 'Ocurrió un error al actualizar la reserva',
                        'codigo' => 0
                    ]);
                }
            } else {
                echo json_encode([
                    'mensaje' => 'La reserva no fue encontrada',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    
}
 
?>