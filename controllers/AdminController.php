<?php

namespace  Controllers;
use MVC\Router;
/*
use Models\Usuario;	
use Classes\Email;*/
class AdminController {
    public static function index(Router $router)
    {
      
        session_start();
        if(!isset($_SESSION['login'])) {
            header('Location: /');
        }
        $router->render('dashboard/index', [
            'titulo' => 'Panel de Administración'
        ]);
    }
}