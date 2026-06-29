<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\AdminController;
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

//    Zona de proyectos
$router->get	('/dashboard',	        [Controllers\DashboardController::class, 'index']);
$router->get	 ('/crear-proyecto',	[Controllers\DashboardController::class, 'crear_proyecto']);
$router->post	 ('/crear-proyecto',	[Controllers\DashboardController::class, 'crear_proyecto']);
$router->get	 ('/proyecto',	        [Controllers\DashboardController::class, 'proyecto']);
$router->get	 ('/perfil',	        [Controllers\DashboardController::class, 'perfil']);
$router->post	 ('/perfil',	        [Controllers\DashboardController::class, 'perfil']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();



//$router->get	('/dashboard',	[Controllers\DashboardController::class, 'index']);
//$router->get	 ('/crear-proyecto',	[Controllers\DashboardController::class


