<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\HabitacionController;
use Controllers\ReservacionController;
use Controllers\LoginController;
use Controllers\ActivacionController;
use Controllers\ListaController;
use Controllers\DisponibilidadController;


$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);


//habitacionesadmin
$router->get('/habitacionesadmin', [HabitacionController::class,'index']);
$router->get('/API/habitacionesadmin/buscar', [HabitacionController::class,'buscarApi']);
$router->post('/API/habitacionesadmin/guardar', [HabitacionController::class,'guardarApi']);
$router->post('/API/habitacionesadmin/modificar', [HabitacionController::class,'modificarApi']);
$router->post('/API/habitacionesadmin/eliminar', [HabitacionController::class,'eliminarApi']);

// habitacion empleados
$router->get('/habitacionesempleados', [HabitacionController::class,'indexempleados']);
// habitaciones clientes 
$router->get('/habitacionesclientes', [HabitacionController::class,'indexclientes']);

// reservaciones
$router->get('/reservacionesadmin', [ReservacionController::class,'indexadmin']);
$router->get('/reservacionescliente', [ReservacionController::class,'indexcliente']);
$router->get('/reservacionesempleados', [ReservacionController::class,'indextecnico']);
$router->get('/API/reservaciones/buscar', [ReservacionController::class,'buscarApi']);
$router->post('/API/reservaciones/guardar', [ReservacionController::class,'guardarApi']);
$router->post('/API/reservaciones/modificar', [ReservacionController::class,'modificarApi']);
$router->post('/API/reservaciones/eliminar', [ReservacionController::class,'eliminarApi']);



//!Reyes Soto
//!Rutas para El Login
$router->get('/', [LoginController::class,'index']);
$router->get('/menuAdministrador', [LoginController::class,'menuAdministrador']);
$router->get('/menuTecnico', [LoginController::class,'menuTecnico']);
$router->get('/menuCliente', [LoginController::class,'menuCliente']);
$router->get('/logout', [LoginController::class,'logout']);
$router->post('/API/login', [LoginController::class,'loginAPI']);

//!Rutas para El Registro de Usarios
$router->get('/registro', [LoginController::class,'indexx']);
$router->post('/API/registro/guardar', [LoginController::class,'guardarAPI']);

//!Rutas para Activar a los usuarios
$router->get('/activacion', [ActivacionController::class,'index']);
$router->get('/API/activacion/buscar', [ActivacionController::class,'buscarAPI']);
$router->post('/API/activacion/eliminar', [ActivacionController::class,'eliminarAPI']);
$router->post('/API/activacion/activar', [ActivacionController::class,'activarAPI']);
$router->post('/API/activacion/asignarol', [ActivacionController::class,'asignarolAPI']);

//!Rutas para Lista de usuarios
$router->get('/lista', [ListaController::class,'index']);
$router->get('/API/lista/buscar', [ListaController::class,'buscarAPI']);
$router->post('/API/lista/eliminar', [ListaController::class,'eliminarAPI']);
$router->post('/API/lista/modificar', [ListaController::class,'modificarAPI']);
$router->post('/API/lista/desactivar', [ListaController::class,'desactivarAPI']);
//!Reyes Soto

//Rutas para disponibilidad
$router->get('/graficaAdmin', [DisponibilidadController::class,'indexAdmin']);
$router->get('/graficaTecnico', [DisponibilidadController::class,'indexTecnico']);
$router->get('/graficaCliente', [DisponibilidadController::class,'indexCliente']);
$router->get('/API/estadistica', [DisponibilidadController::class,'estadisticas']);
$router->get('/API/disponibilidad/buscar', [DisponibilidadController::class,'buscarAPI']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
