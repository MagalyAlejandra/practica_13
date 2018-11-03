  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">REGISTRO DE JUGADORES</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<?php 
  
  //Enviar los datos al controlador MvcController (es la clase pricipal de controller.php)
$registro = new MvcController();

$equipos = $registro->getEquipos();

?>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registro</h3>
              </div>
              <form role="form" method="POST">
                <div class="card-body">
                
                  <div class="form-group">
                    <label for="nombreJugadorRegistro">Nombre</label>
                    <input type="text" class="form-control" id="nombreJugadorRegistro" name="nombreJugadorRegistro" placeholder="Nombre">
                  </div>
                  <div class="form-group">
                    <label for="equipoJugadorRegistro">Equipo</label>
                    <select class="form-control" name="equipoJugadorRegistro" id="equipoJugadorRegistro" placeholder="Categoria">
                      <?php
                      foreach ($equipos as $key => $value) {
                         echo "<option>".$value["nombre"]."</option>";
                       } 
                      ?>  
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nacionalidadJugadorRegistro">Nacionalidad</label>
                    <input type="text" class="form-control" id="nacionalidadJugadorRegistro" name="nacionalidadJugadorRegistro" placeholder="Nacionalidad">
                  </div>
                  <div class="form-group">
                    <label for="posicionJugadorRegistro">Posicion</label>
                    <input type="text" class="form-control" id="posicionJugadorRegistro" name="posicionJugadorRegistro" placeholder="Posicion">
                  </div>
                  <div class="form-group">
                    <label for="edadJugadorRegistro">Edad</label>
                    <input type="text" class="form-control" id="edadJugadorRegistro" name="edadJugadorRegistro" placeholder="Edad">
                  </div>
                  <div class="form-group">
                    <label for="emailJugadorRegistro">Email</label>
                    <input type="text" class="form-control" id="emailJugadorRegistro" name="emailJugadorRegistro" placeholder="Correo Electronico">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

<?php 

//se invoca la funcion  registroUsuarioController de la clase MvcController
$registro ->registroJugadoresController();
if(isset($_GET["action"])){
  if($_GET["action"]=="ok"){
    echo "Registro Exitoso";
  }
}
 ?>