<?php

namespace  Controllers;
use MVC\Router;	

class LoginController {
	public static function login(Router $router)
	{
		
		// Display login form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle login authentication
			//self::authenticate();
		} else {
			// Show login form
			//include_once __DIR__ . '/../views/login.php';
		}

		$router->render('auth/login', [
			'titulo' => 'Iniciar Sesión'
		]);

	}

	public static function logout()
	{
		echo ("Desde logoutcontroller");
		// Handle logout logic
	}

	public static function crear(Router $router)
	{

		// Display account creation form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle account creation logic
			//self::createAccount();
		} else {
			// Show account creation form
			//include_once __DIR__ . '/../views/crear-cuenta.php';
		}

		$router->render('auth/crear', [
			'titulo' => 'Crear Cuenta'
		]);	

	}

	public static function recuperar()
	{
		echo ("Desde recuperar password");
		// Display password recovery form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle password recovery logic
			//self::recoverPassword();
		} else {
			// Show password recovery form
			//include_once __DIR__ . '/../views/recuperar-password.php';
		}
	}

	public static function olvide()
	{
		echo ("Desde olvide password");
		// Display forgot password form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle forgot password logic
			//self::forgotPassword();
		} else {
			// Show forgot password form
			//include_once __DIR__ . '/../views/olvide-password.php';
		}
	}	

	public static function mensaje()
	{
		echo ("Desde mensaje");
		// Display account confirmation message
		//include_once __DIR__ . '/../views/mensaje.php';
	}

	public static function confirmar()
	{
		echo ("Desde confirmar cuenta");
		// Handle account confirmation logic
	}	
}