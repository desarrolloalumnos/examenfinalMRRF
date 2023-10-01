<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ReservacionController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

$router->get('/reservaciones', [ReservacionController::class,'index']);
$router->get('/API/reservaciones/buscar', [ReservacionController::class,'buscarApi']);
$router->post('/API/reservaciones/guardar', [ReservacionController::class,'guardarApi']);
$router->post('/API/reservaciones/modificar', [ReservacionController::class,'modificarApi']);
$router->post('/API/reservaciones/eliminar', [ReservacionController::class,'eliminarApi']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
