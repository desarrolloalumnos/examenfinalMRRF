<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\LoginController;
use Controllers\ActivacionController;
use Controllers\ListaController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

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

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
