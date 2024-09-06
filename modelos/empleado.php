<?php
class Empleado
{
	private $pdo;

    public $id;
    public $nombre;
    public $email;
    public $sexo;
    public $area_id;
    public $boletin;
    public $descripcion;

	public function __CONSTRUCT(){
		try
		{
			$this->pdo = Db::conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function index(){
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT 
                                            t_empleado.id as id, 
                                            t_empleado.nombre AS nombre, 
                                            t_empleado.email AS email, 
                                            t_empleado.sexo AS sexo,
                                            t_areas.nombre AS area,
                                            t_empleado.boletin AS boletin
                                        FROM t_empleado 
                                        LEFT JOIN t_areas ON t_empleado.area_id = t_areas.id");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function obtenerAreas(){
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM t_areas");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function obtenerRoles(){
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM t_roles");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function seleccionarEmpleado($idEmpleado){
		try
		{
			$stm = $this->pdo->prepare("SELECT 
                                            t_empleado.id as id, 
                                            t_empleado.nombre AS nombre, 
                                            t_empleado.email AS email, 
                                            t_empleado.sexo AS sexo,
                                            t_areas.id AS area,
                                            t_empleado.boletin AS boletin,
											t_empleado.descripcion AS descripcion
                                        FROM t_empleado 
                                        LEFT JOIN t_areas ON t_empleado.area_id = t_areas.id
                                        WHERE t_empleado.id = ?");
			$stm->execute(array($idEmpleado));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function seleccionarRoles($idEmpleado){
		try
		{
			$stm = $this->pdo->prepare("SELECT rol_id FROM t_empleado_rol WHERE empleado_id = ?");
			$stm->execute(array($idEmpleado));
			$roles = [];
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $key => $value){
                array_push($roles, $value->rol_id);
            }
			return $roles;
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function eliminarEmpleado($idEmpleado){
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM t_empleado WHERE id = ?");

			$stm->execute(array($idEmpleado));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function actualizarEmpleado($data){
		try
		{
			$sql = "UPDATE t_empleado SET
						nombre = ?,
						email = ?,
                        sexo = ?,
                        area_id = ?,
						boletin = ?,
                        descripcion = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre,
                        $data->email,
                        $data->sexo,
                        $data->area_id,
						$data->boletin,
                        $data->descripcion,
                        (int)$data->id,
					)
				);
			
			$sql = "DELETE FROM t_empleado_rol WHERE empleado_id = ?";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->id
					)
				);

			foreach ($data->roles as $key => $value) {
				$sql = "INSERT INTO t_empleado_rol (empleado_id,rol_id)
						VALUES (?, ?)";

				$this->pdo->prepare($sql)
					->execute(
						array(
							(int)$data->id,
							$value
						)
					);
			}
			
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function guardarEmpleado(empleado $data){

		try{
			$sql = "INSERT INTO t_empleado (nombre,email,sexo,area_id,boletin,descripcion)
					VALUES (?, ?, ?, ?, ?, ?)";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->nombre,
						$data->email,
						$data->sexo,
						$data->area_id,
						$data->boletin,
						$data->descripcion
					)
				);

			$idEmpleado = $this->pdo->lastInsertId();
			foreach($data->roles as $key => $value){
				$sql = "INSERT INTO t_empleado_rol (empleado_id,rol_id)
						VALUES (?, ?)";

				$this->pdo->prepare($sql)
					->execute(
						array(
							$idEmpleado,
							$value
						)
					);
			}
		} catch (Exception $e){
			die($e->getMessage());
		}
	}
}