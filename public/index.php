<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\HabitacionController;
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


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
