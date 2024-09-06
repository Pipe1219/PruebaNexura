<?php
  require_once 'modelos/conexion.php';

  $controller = 'empleado';

  if(!isset($_REQUEST['c']))
  {
    require_once "controllers/".$controller."Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
  }
  else
  {
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';

    require_once "controllers/".$controller."Controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;

    call_user_func( array( $controller, $accion ) );
  }