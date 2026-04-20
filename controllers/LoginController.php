<?php

namespace  Controllers;
use MVC\Router;
use Models\Usuario;	
use Classes\Email;

class LoginController {
	public static function login(Router $router)
	{
		$alertas = [];
		// Display login form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle login authentication
				$auth = new Usuario($_POST);
				$alertas = $auth->validarLogin();
				if(empty($alertas)) {
					$usuario = Usuario::where('email', $auth->email);
					if($usuario) {
						if($usuario->confirmado === "1") {
							if(password_verify($auth->password, $usuario->password)) {
								// Iniciar sesión
								session_start();
								$_SESSION['id'] = $usuario->id;
								$_SESSION['nombre'] = $usuario->nombre;
								$_SESSION['email'] = $usuario->email;
								$_SESSION['login'] = true;

								header('Location: /admin');
							} else {
								Usuario::setAlerta('error', 'Password Incorrecto');
							}
						} else {
							Usuario::setAlerta('error', 'Tu Cuenta no ha sido Confirmada');
						}
					} else {
						Usuario::setAlerta('error', 'El Usuario no Existe');
					}
				}
			//self::authenticate();
		} else {
			// Show login form
			//include_once __DIR__ . '/../views/login.php';
		}

		$router->render('auth/login', [
			'titulo' => 'Iniciar Sesión',
			'alertas' => $alertas
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
					
					// Eliminar password2 para no guardarlo en la base de datos
					unset($usuario->password2);

					// Crear el usuario
					$resultado = $usuario->guardar();

					if($resultado) {
						// Enviar email de confirmación
						$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
						$email->enviarConfirmacion();		
						//debuguear($email);
						
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
		$token = s($_GET['token'] ?? '');
		if(!$token) header('Location: /');
		$alertas = [];
		$usuario = Usuario::where('token', $token);
		if(empty($usuario)) {	
			Usuario::setAlerta('error', 'Token no válido');
			$mostrar = false;
		}

		// Display password recovery form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Añadir nuevo password
			$usuario->sincronizar($_POST);
			$alertas = $usuario->validarPassword();

			if(empty($alertas)) {
				// Eliminar password2 para no guardarlo en la base de datos
					unset($usuario->password2);
				// Hashear el nuevo password
				$usuario->hashPassword();
				// Eliminar el token
				$usuario->token = '';
				// Guardar el usuario
				//debuguear($usuario);
				$resultado = $usuario->guardar();
				if($resultado) {
					header('Location: /');
				}
			}
			//self::recoverPassword();
		} else {
			// Show password recovery form
			//include_once __DIR__ . '/../views/recuperar-password.php';
		}

		$alertas = $usuario->getAlertas();
		$router->render('auth/recuperar', [
			'titulo' => 'Recuperar Password',
			'alertas' => $alertas	,
			'mostrar' => $mostrar
		]);	
	}

	public static function olvide(Router $router)
	{
		$alertas = [];
		// Display forgot password form
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Handle forgot password logic
			//self::forgotPassword();
			$usuario = new Usuario($_POST); 
			$alertas = $usuario->validarEmail();
			if(empty($alertas)) {
				$usuario = Usuario::where('email', $usuario->email);
				if($usuario && $usuario->confirmado === "1") {
					// Generar un nuevo token
					$usuario->crearToken();
					unset($usuario->password2);
					$usuario->guardar();

					// Enviar email de recuperación
					$email = new Email($usuario->email, $usuario->nombre, $usuario->token);
					$email->enviarInstrucciones();
					Usuario::setAlerta('exito', 'Se han enviado las instrucciones a tu email');
				} else {
					Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');
					//$alertas = Usuario::getAlertas();
				}
			}
		} else {
			// Show forgot password form
			//include_once __DIR__ . '/../views/olvide-password.php';
		}

		$router->render('auth/olvide', [
			'alertas' => Usuario::getAlertas(),
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
		//Leer la variable token de la URL
		$token = s($_GET['token'] ?? '');	
		if(!$token) header('Location: /');
		//Buscar el usuario con el token
		$usuario = Usuario::where('token', $token);	
		if(empty($usuario)) {
			//Mostrar mensaje de error
			Usuario::setAlerta('error', 'Token no válido');
		} else {
			//Confirmar la cuenta
			$usuario->confirmado = 1;
			unset($usuario->password2);
			$usuario->token = '';
			$usuario->guardar();
			Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
		}
		//$usuario->getAlertas();	
		$router->render('auth/confirmar', [
			'titulo' => 'Confirmar Cuenta',
			'alertas' => $usuario->getAlertas()
		]);
	}	
}