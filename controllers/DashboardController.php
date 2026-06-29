<?php

namespace  Controllers;
use MVC\Router;
use Models\Proyecto;

/*
use Models\Usuario;	
use Classes\Email;*/
class DashboardController {
	public static function index(Router $router)
	{
	  
		session_start();
		isAuth();
		$proyectos = Proyecto::belongsTo('propietarioid', $_SESSION['id']);
		//debuguear($proyectos);
		/*
		if(!isset($_SESSION['login'])) {
			header('Location: /');
		}*/
		$router->render('dashboard/index', [
			'titulo' => 'Proyectos',
			'proyectos' => $proyectos
		]);
	}

	public static function crear_proyecto(Router $router)
	{
		session_start();
		isAuth();
		$alertas = [];
		
		if($_SERVER['REQUEST_METHOD'] === 'POST') {

			$proyecto = new Proyecto($_POST);

			// Validar que el proyecto tenga un nombre
			$alertas = $proyecto->validarProyecto();

			if(empty($alertas)) {
				// Generar una URL única para el proyecto
				$proyecto->url = md5(uniqid());

				// Asignar el ID del usuario propietario del proyecto
				$proyecto->propietarioid = $_SESSION['id'];

				// Guardar el proyecto en la base de datos
				$proyecto->guardar();

				// Redirigir al usuario a la página del proyecto o mostrar un mensaje de éxito
				header('Location: /proyecto?url=' . $proyecto->url);
			}	
			// Aquí puedes manejar la lógica para crear un nuevo proyecto
			// Por ejemplo, podrías validar los datos y guardarlos en la base de datos
			// Luego redirigir al usuario a la página del proyecto o mostrar un mensaje de éxito
			//header('Location: /dashboard');
		}

		$router->render('dashboard/crear-proyecto', [
			'titulo' => 'Crear Proyecto',
			'alertas' => $alertas
		]);
	}
	
public static function proyecto(Router $router)
	{
		session_start();
		isAuth();
		
		// Comprobar que el proyecto exista y que el usuario sea el propietario
		$url = $_GET['url'];
		$proyecto = Proyecto::where('url', $url);
		if (!$proyecto || $proyecto->propietarioid !== $_SESSION['id']) {
			header('Location: /dashboard');
			exit;
		}
		$router->render('dashboard/proyecto', [
			'titulo' => $proyecto->proyecto,
			'proyecto' => $proyecto

		]);
	}


	public static function perfil(Router $router)
	{
		session_start();
		isAuth();
		
		$router->render('dashboard/perfil', [
			'titulo' => 'Perfil'
		]);
	}
}