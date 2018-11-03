<?php 

class MvcController{//creamos una nueva clase llamada MvcController

	public static function template(){//funcion para mandar llamar al template
		include "Views/template.php";//invocamos al archivo template que se encuentra dentro de las vistas
	}

	public static function enlacesPaginasController(){//funcion para controlar las paginas
		if(isset($_GET["action"])){//compruba que existe al action dentro de la url
	   $enlacesController =$_GET["action"];	  
		}else{
			$enlacesController="index";//si no existe lo mandara al index
		}
		$repuesta = Paginas::enlacesPaginasModel($enlacesController);
		include $repuesta;
	}

	public function registroJugadoresController()//Funcion para registrar jugadores
    {
      //se hace un llamado con POST para registrar todos los campos
      if(isset($_POST["nombreJugadorRegistro"]))
      {
        //especificacion de la toma de registro de cada campo
        $datosController = array("nombre"=>$_POST["nombreJugadorRegistro"],"equipo"=>$_POST["equipoJugadorRegistro"], "nacionalidad"=>$_POST["nacionalidadJugadorRegistro"],"posicion"=>$_POST["posicionJugadorRegistro"],"edad"=>$_POST["edadJugadorRegistro"],"email"=>$_POST["emailJugadorRegistro"]);

        $respuesta = Datos::registroJugadoresModel($datosController,"jugadores");
        
        //si los datos estan completos y correctos entra al success
        if($respuesta =="success")
        {
          //con este echo el ususario una vez que registra al jugador, este echo te regresa la interfaz de listado de jugadores, que contiene la informacion de los jugadores que se han agregado
        	echo "<script> window.location = 'index.php?action=verJugadores';</script>";
        }
      }
  }

  public function registroEquiposController()//Funcion para registrar equipo
    {
      if(isset($_POST["idEquipoRegistro"]))
      {
        //Recibe atraves del metodo post el nombre , matricula y email etc, se almacenan en un array con sus respectivas propiedades (usuario, password ,email)
        $datosController = array("nombre"=>$_POST["nombreEquipoRegistro"],"entrenador"=>$_POST["entrenadorEquipoRegistro"], "web"=>$_POST["webEquipoRegistro"],"categoria"=>$_POST["categoriaEquipoRegistro"]);
        //se le dice al modelo models/crud
        $respuesta = Datos::registroEquiposModel($datosController,"equipos");

        if($respuesta =="success")
        {
          echo "<script> window.location = 'index.php?action=verEquipos';</script>";
        }
      }
  }

  public function vistaJugadoresController(){//Funcion para poder ver la tabla de jugadores
    $respuesta = Datos::vistaJugadoresModel("jugadores");
    foreach($respuesta as $row => $item){
    echo'<tr>
        <td>'.$item["nombre"].'</td>
        <td>'.$item["nacionalidad"].'</td>
        <td>'.$item["posicion"].'</td>
        <td>'.$item["edad"].'</td>
        <td>'.$item["email"].'</td>
        <td><a href="index.php?action=editarJugador&id='.$item["id"].'"><button class="btn btn-primary">Editar</button></a></td>
         <td><a href="index.php?action=verJugadores&idBorrar='.$item["id"].'"><button class="btn btn-danger">Borrar</button></a></td>
      </tr>';
    }
  }

  public function vistaEquiposController(){//Funcion para poder ver la tabla de equipos

    $respuesta = Datos::vistaEquiposModel("equipos");
    foreach($respuesta as $row => $item){
    echo'<tr>
        <td>'.$item["nombre"].'</td>
        <td>'.$item["entrenador"].'</td>
        <td>'.$item["web"].'</td>
        <td>'.$item["categoria"].'</td>
        <td><a href="index.php?action=editarEquipo&id='.$item["id"].'"><button class="btn btn-primary">Editar</button></a></td>
         <td><a href="index.php?action=verEquipos&idBorrar='.$item["id"].'"><button class="btn btn-danger">Borrar</button></a></td>
      </tr>';
    }
  }
  public function getEquipos(){
    return Datos::getEquiposModel();
  }
  public function vistaRelacionController(){//Funcion para poder ver la tabla de relacion

    $respuesta = Datos::vistaRelacionModel();
    foreach($respuesta as $row => $item){
    echo'<tr>
        <td>'.$item["nombre"].'</td>
        <td>'.$item["equipo"].'</td>
        <td>'.$item["categoria"].'</td>
      </tr>';
    }
  }

  public function editarJugadorController(){//Funcion para editar jugador
    //editar jugador mediante la obtencion del id
    $datosController = $_GET["id"];
    $respuesta = Datos::editarJugadorModel($datosController, "jugadores");
    $equipos = Datos::getEquiposModel();
    //cada $respuesta se va cargando a nuestro modelo, conforme la tabla jugadores.
    echo'
    <div class="form-group">
      <label for="nombreJugadorActualizar">Nombre</label>
      <input type="text" class="form-control" id="nombreJugadorActualizar"  value="'.$respuesta["nombre"].'"  name="nombreJugadorActualizar" placeholder="Nombre">
    </div>
    <div class="form-group">
      <label for="equipoJugadorActualizar">Equipo</label>
      <select class="form-control" name="equipoJugadorActualizar" id="equipoJugadorActualizar" placeholder="Categoria">
        <option>'.$respuesta["equipo"].'</option>';
        
        foreach ($equipos as $key => $value) {
           echo "<option>".$value["nombre"]."</option>";
         } 
        
      echo ' 
      </select>
    </div>
    <div class="form-group">
      <label for="nacionalidadJugadorActualizar">Nacionalidad</label>
      <input type="text" class="form-control" id="nacionalidadJugadorActualizar"  value="'.$respuesta["nacionalidad"].'"   name="nacionalidadJugadorActualizar" placeholder="Nacionalidad">
    </div>
    <div class="form-group">
      <label for="posicionJugadorActualizar">Posicion</label>
      <input type="text" class="form-control" id="posicionJugadorActualizar"   value="'.$respuesta["posicion"].'" name="posicionJugadorActualizar" placeholder="Posicion">
    </div>
    <div class="form-group">
      <label for="edadJugadorActualizar">Edad</label>
      <input type="text" class="form-control" id="edadJugadorActualizar"   value="'.$respuesta["edad"].'" name="edadJugadorActualizar" placeholder="Edad">
    </div>
    <div class="form-group">
      <label for="emailJugadorActualizar">Email</label>
      <input type="text" class="form-control" id="emailJugadorActualizar" value="'.$respuesta["email"].'" name="emailJugadorActualizar" placeholder="Correo Electronico">
    </div>
	<div class="card-footer">
       <input type="submit" class="btn btn-primary" value="Actualizar">
    </div>
    ';
  }

  public function editarEquipoController(){//Funcion para editar Equipo

    $datosController = $_GET["id"];
    $respuesta = Datos::editarEquipoModel($datosController, "equipos");

    echo'
    <div class="form-group"> 
      <input type="hidden" class="form-control" value="'.$respuesta["id"].'" name="idEquipoActualizar">
    </div>
    <div class="form-group">
       <label for="nombreEquipoEditar">Nombre</label> 
       <input type="text" class="form-control" value="'.$respuesta["nombre"].'" name="nombreEquipoActualizar" required>
    </div>
    <div class="form-group">
       <label for="entrenadorEquipoEditar">Entrenador</label> 
       <input type="text" class="form-control" value="'.$respuesta["entrenador"].'" name="entrenadorEquipoActualizar" required>
    </div>
    <div class="form-group">
       <label for="webEquipoEditar">Posicion</label> 
       <input type="text" class="form-control" value="'.$respuesta["web"].'" name="webEquipoActualizar" required>
    </div>
    <div class="form-group">
      <label for="categoriaEquipoEditar">Equipo</label>
      <select class="form-control" name="categoriaEquipoEditar" id="categoriaEquipoEditar" placeholder="Categoria">
        <option>Futbol</option>
        <option>Basquetbol</option>
        <option>Volievol</option> 
      </select>
    </div>
  <div class="card-footer">
       <input type="submit" class="btn btn-primary" value="Actualizar">
    </div>
    ';
  }

  //Funcion para actualizar Jugador
  public function actualizarJugadorController(){

    if(isset($_POST["nombreJugadorActualizar"])){

      $datosController = array( "id"=>$_GET['id'],
                              	"nombre"=>$_POST["nombreJugadorActualizar"],
                                "equipo"=>$_POST["equipoJugadorActualizar"],
                              	"nacionalidad"=>$_POST["nacionalidadJugadorActualizar"],
                                "posicion"=>$_POST["posicionJugadorActualizar"],
                                "edad"=>$_POST["edadJugadorActualizar"],
                                "email"=>$_POST["emailJugadorActualizar"]);

      $respuesta = Datos::actualizarJugadorModel($datosController, "jugadores");

      if($respuesta == "success"){
      echo "<script> window.location = 'index.php?action=verJugadores';</script>";
      }

      else{
        echo "error";
      }
    }  
  }

  //Funcion para actualizar Equipo
  public function actualizarEquipoController(){

    if(isset($_POST["idEquipoActualizar"])){

      $datosController = array( "id"=>$_POST["idEquipoActualizar"],
                                "nombre"=>$_POST["nombreEquipoActualizar"],
                                "entrenador"=>$_POST["entrenadorEquipoActualizar"],
                                "web"=>$_POST["webEquipoActualizar"],
                                "categoria"=>$_POST["categoriaEquipoEditar"]);

      $respuesta = Datos::actualizarEquipoModel($datosController, "equipos");

      if($respuesta == "success"){
        echo "<script> window.location = 'index.php?action=verEquipos';</script>";
      }

      else{
        echo "error";
      }
    }  
  }

  //Funcion para borrar Jugadores
  public function borrarJugadoresController(){
    if(isset($_GET["idBorrar"])){
    $datosController = $_GET["idBorrar"];
    $respuesta = Datos::borrarJugadorModel($datosController, "jugadores");
       if($respuesta == "success"){
       	echo "<script> window.location = 'index.php?action=verJugadores';</script>";
       }
    }
  }

  //Funcion para borrar Equipos
  public function borrarEquiposController(){
    if(isset($_GET["idBorrar"])){
    $datosController = $_GET["idBorrar"];
    $respuesta = Datos::borrarEquipoModel($datosController, "equipos");
       if($respuesta == "success"){
        echo "<script> window.location = 'index.php?action=verEquipos';</script>";
       }
    }
  }

  public function loginUsuarioController()//funcion para logiar 
  {
    if(isset($_POST["emailIngreso"])){

    $datosController = array( "email"=>$_POST["emailIngreso"], "password"=>$_POST["passwordIngreso"]); print_r($datosController);

      $respuesta = Datos::LoginUsuarioModel($datosController, "usuarios"); print_r($respuesta);

      if($respuesta["email"] == $_POST["emailIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
      session_start();

        $_SESSION["validar"] = "si";
        $_SESSION["user"] = $respuesta["nombre"];
        
        echo "<script> window.location ='index.php';</script>";
      }

      else{
      }
    }
  }
  public function countJugadoresFutbolController(){//funcion que cuenta la cantidad de alumnos
  $respuesta=Datos::countJugadoresFutbolModel("jugadores",1);
  print_r($respuesta["TOTAL"]); 
  }
}

?>