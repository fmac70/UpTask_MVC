<?php

namespace  Controllers;
use MVC\Router;
use Models\Usuario;	

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
		$alertas = [];
		$usuario = new Usuario();
		// Display account creation form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$usuario->sincronizar($_POST);
			$alertas = $usuario->validarNuevaCuenta();

			if(empty($alertas)) {
				// Verificar que el usuario no esté registrado
				$existeUsuario = Usuario::where('email', $usuario->email);
				if($existeUsuario) {
					Usuario::setAlerta('error', 'El Usuario ya está registrado');
					$alertas = Usuario::getAlertas();
				} else {
					// Hashear el password
					$usuario->hashPassword();

					// Generar un token único
					$usuario->crearToken();

					// Crear el usuario
					$resultado = $usuario->guardar();
					if($resultado) {
						// Enviar email de confirmación
						//Email::enviarConfirmacion($usuario->email, $usuario->nombre, $usuario->token);

						// Redireccionar al usuario
						header('Location: /mensaje');
					}
				}
			}

			
		}
		
		$router->render('auth/crear', [
			'titulo'	=> 'Crear Cuenta',
			'usuario'	=> $usuario,
			'alertas'	=> $alertas,
		]);	

	}

	public static function recuperar(Router $router)
	{
		
		// Display password recovery form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle password recovery logic
			//self::recoverPassword();
		} else {
			// Show password recovery form
			//include_once __DIR__ . '/../views/recuperar-password.php';
		}

		$router->render('auth/recuperar', [
			'titulo' => 'Recuperar Password'
		]);	
	}

	public static function olvide(Router $router)
	{
		
		// Display forgot password form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle forgot password logic
			//self::forgotPassword();
		} else {
			// Show forgot password form
			//include_once __DIR__ . '/../views/olvide-password.php';
		}

		$router->render('auth/olvide', [
			'titulo' => 'Olvidé mi Password'
		]);


	}	

	public static function mensaje(Router $router)
	{
		$router->render('auth/mensaje', [
			'titulo' => 'Mensaje'
		]);
	}

	public static function confirmar(Router $router)
	{
		$router->render('auth/confirmar', [
			'titulo' => 'Confirmar Cuenta'
		]);
	}	
}