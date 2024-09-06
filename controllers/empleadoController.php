<?php
require_once 'modelos/empleado.php';

class EmpleadoController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new empleado();
    }

    public function index(){
        require_once 'vistas/empleados.php';
    }

    public function seleccionarEmpleado(){
        $empleado = new empleado();

        if(isset($_REQUEST['id'])){
            $empleado = $this->model->seleccionarEmpleado($_REQUEST['id']);
            $roles = $this->model->seleccionarRoles($_REQUEST['id']);
        }
        require_once 'vistas/editar.php';
    }

    public function crearEmpleado(){
        $empleado = new empleado();

        require_once 'vistas/crear.php';
    }

    public function guardarEmpleado(){
        $empleado = new empleado();
        
        $empleado->nombre = $_REQUEST['nombre'];
        $empleado->email = $_REQUEST['email'];
        $empleado->sexo = $_REQUEST['sexo'];
        $empleado->area_id = $_REQUEST['area'];
        $empleado->boletin = $_REQUEST['boletin'];
        $empleado->descripcion = $_REQUEST['descripcion'];

        $empleado->roles = $_REQUEST['roles'];

        $this->model->guardarEmpleado($empleado);

        header('Location: index.php?c=empleado');
    }

    public function actualizarEmpleado(){
        $empleado = new empleado();
        
        $empleado->id = $_REQUEST['id'];
        $empleado->nombre = $_REQUEST['nombre'];
        $empleado->email = $_REQUEST['email'];
        $empleado->sexo = $_REQUEST['sexo'];
        $empleado->area_id = $_REQUEST['area'];
        $empleado->boletin = $_REQUEST['boletin'];
        $empleado->descripcion = $_REQUEST['descripcion'];
        
        $empleado->roles = $_REQUEST['roles'];

        $this->model->actualizarEmpleado($empleado);

        header('Location: index.php?c=empleado');
    }

    public function eliminarEmpleado(){
        $this->model->eliminarEmpleado($_REQUEST['idEmpleado']);
        header('Location: index.php');
    }
}