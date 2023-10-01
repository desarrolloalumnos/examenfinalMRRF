<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\HabitacionController;
use Controllers\ReservacionController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);


//habitacionesadmin
$router->get('/habitacionesadmin', [HabitacionController::class,'index']);
$router->get('/API/habitacionesadmin/buscar', [HabitacionController::class,'buscarApi']);
$router->post('/API/habitacionesadmin/guardar', [HabitacionController::class,'guardarApi']);
$router->post('/API/habitacionesadmin/modificar', [HabitacionController::class,'modificarApi']);
$router->post('/API/habitacionesadmin/eliminar', [HabitacionController::class,'eliminarApi']);

// habitacion clientes
$router->get('/habitacionesclientes', [HabitacionController::class,'indexclientes']);

// reservaciones
$router->get('/reservaciones', [ReservacionController::class,'index']);
$router->get('/API/reservaciones/buscar', [ReservacionController::class,'buscarApi']);
$router->post('/API/reservaciones/guardar', [ReservacionController::class,'guardarApi']);
$router->post('/API/reservaciones/modificar', [ReservacionController::class,'modificarApi']);
$router->post('/API/reservaciones/eliminar', [ReservacionController::class,'eliminarApi']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
