<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
$router = new Router();

//	Login
$router->get	('/',		[Controllers\LoginController::class, 'login']);
$router->post	('/',		[Controllers\LoginController::class, 'login']);
$router->get	('/logout',	[Controllers\LoginController::class, 'logout']);

//	Crear Cuenta
$router->get	('/crear-cuenta',	[Controllers\LoginController::class, 'crear']);
$router->post	('/crear-cuenta',	[Controllers\LoginController::class, 'crear']);

//	Confirmar Cuenta
$router->get	('/mensaje',		[Controllers\LoginController::class, 'mensaje']);
$router->get	('/confirmar',		[Controllers\LoginController::class, 'confirmar']);

//	Olvidé mi Password
$router->get	('/olvide-password',	[Controllers\LoginController::class, 'olvide']);
$router->post	('/olvide-password',	[Controllers\LoginController::class, 'olvide']);

//	Recuperar Password
$router->get	('/restablecer',	[Controllers\LoginController::class, 'recuperar']);
$router->post	('/restablecer',	[Controllers\LoginController::class, 'recuperar']);

//	Panel de Administración
$router->get	('/admin',	[Controllers\AdminController::class, 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();