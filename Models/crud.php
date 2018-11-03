<?php
//llamado a conexion.php 
require_once "conexion.php";

//modelo donde se efectua la interacion con la base de datos que anteriormente se realizo. Es la encargada de la conexion con la base de datos
class Datos extends Conexion{
	//metodo de registroJugadores
	public static function registroJugadoresModel($datosModel,$tabla){
		//consulta para obtener el valor de las variables cuando ejecutamos execute
		$id_equipo = Conexion::conectar()->prepare("SELECT max(id) FROM equipos WHERE nombre = :nombre");
		$id_equipo->bindParam(":nombre", $datosModel['equipo'], PDO::PARAM_STR);
		$id_equipo->execute();
		$id_equipo = $id_equipo->fetchColumn();

		//consulta para obtener el valor de las variables cuando ejecutamos execute
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, id_equipo, nacionalidad, posicion ,edad , email) VALUES (:nombre ,:equipo, :nacionalidad, :posicion ,:edad, :email)");
		//hacemos referencia a la variables que tenemos vinculadas
		$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":equipo",$id_equipo,PDO::PARAM_INT);
		$stmt->bindParam(":nacionalidad",$datosModel["nacionalidad"],PDO::PARAM_STR);
		$stmt->bindParam(":posicion",$datosModel["posicion"],PDO::PARAM_STR);
		$stmt->bindParam(":edad",$datosModel["edad"],PDO::PARAM_STR);
		$stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
		
		//solamente esa variables son ejecutadas con execute
		if($stmt->execute()){
			//si todo es correcto, devuelve success
			return "success";
		}
		else{
			// y si no, devuelve error
			return "error";
		}
		$stmt->close();//cierre
	}

	public static function registroEquiposModel($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre,entrenador,web,categoria) VALUES (:nombre,:entrenador,:web,:categoria)");

		$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":entrenador",$datosModel["entrenador"],PDO::PARAM_STR);
		$stmt->bindParam(":web",$datosModel["web"],PDO::PARAM_STR);
		$stmt->bindParam(":categoria",$datosModel["categoria"],PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}
		else{
			return "error";
		}

		$stmt->close();
	}

	static public function vistaJugadoresModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	static public function vistaEquiposModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	static public function vistaRelacionModel(){

		$stmt = Conexion::conectar()->prepare(
			"SELECT j.nombre as nombre,
				   e.nombre as equipo,
				   e.categoria as categoria
			FROM jugadores as j
			INNER JOIN equipos as e on j.id_equipo = e.id");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	static public function getEquiposModel(){
		$equipos = Conexion::conectar()->prepare("SELECT * FROM equipos");
		$equipos->execute();
		return $equipos->fetchAll();
	}

	static public function editarJugadorModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare(
			"SELECT j.nombre as nombre,
				   e.nombre as equipo,
			       j.nacionalidad as nacionalidad,
			       j.posicion as posicion,
			       j.edad as edad,
			       j.email as email
			FROM jugadores as j
			INNER JOIN equipos as e on j.id_equipo = e.id WHERE j.id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	static public function actualizarJugadorModel($datosModel, $tabla){

		
		$id_equipo = Conexion::conectar()->prepare("SELECT max(id) FROM equipos WHERE nombre = :nombre");
		$id_equipo->bindParam(":nombre", $datosModel['equipo'], PDO::PARAM_STR);
		$id_equipo->execute();
		$id_equipo = $id_equipo->fetchColumn();

		//echo "<script>alert('".$id_equipo."');</script>";

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_equipo = :equipo, nacionalidad = :nacionalidad, posicion = :posicion, edad = :edad, email = :email  WHERE id = :id");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo", $id_equipo, PDO::PARAM_INT);
		$stmt->bindParam(":nacionalidad", $datosModel["nacionalidad"], PDO::PARAM_STR);
		$stmt->bindParam(":posicion", $datosModel["posicion"], PDO::PARAM_STR);
		$stmt->bindParam(":edad", $datosModel["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}

	static public function borrarJugadorModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}
		else{
		return "error";
		}
		$stmt->close();
	}

	static public function actualizarEquipoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, entrenador = :entrenador, web = :web, categoria = :categoria WHERE id = :id");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":entrenador", $datosModel["entrenador"], PDO::PARAM_STR);
		$stmt->bindParam(":web", $datosModel["web"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}

		else{
			return "error";
		}
		$stmt->close();
	}

	static public function editarEquipoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, nombre, entrenador, web, categoria FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	static public function borrarEquipoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}
		else{
		return "error";
		}
		$stmt->close();
	}

	static public function LoginUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id,email,password FROM $tabla WHERE email = :email");	
		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();

	}

	static public function selectTutoresModel( $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT ID , nombre FROM $tabla ");	
		$stmt->execute();
		//print_r($stmt);
		return $stmt->fetchAll();

		$stmt->close();

	}

	static public function selectCarrerasModel( $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT ID , nombre FROM $tabla ");	
		$stmt->execute();
		//print_r($stmt);
		return $stmt->fetchAll();

		$stmt->close();

	}

	static public function countJugadoresFutbolModel( $tabla,$id){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as TOTAL FROM $tabla WHERE identificador=$id");	
		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();


	}

	static public function countAlumnosModel( $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as TOTAL FROM $tabla ");	
		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();


	}

	static public function countMaestrosModel( $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as TOTAL FROM $tabla ");	
		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();


	}
}

?>
