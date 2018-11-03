 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">REGISTRO DE EQUIPOS </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registro Equipo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" class="form-control" id="idEquipoRegistro" name="idEquipoRegistro"  value="1">
                  </div>
                  <div class="form-group">
                    <label for="nombreEquipoRegistro">Nombre del Equipo</label>
                    <input type="text" class="form-control" id="nombreEquipoRegistro" name="nombreEquipoRegistro" placeholder="Nombre">
                  </div>
                  <div class="form-group">
                    <label for="categoriaEquipoRegistro">Categoria</label>
                    <select class="form-control" name="categoriaEquipoRegistro" id="categoriaEquipoRegistro" placeholder="Categoria">
                     <option>Futbol</option>
                     <option>Basquetbol</option>
                     <option>Voleibol</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="entrenadorEquipoRegistro">Entrenador</label>
                    <input type="text" class="form-control" id="entrenadorEquipoRegistro" name="entrenadorEquipoRegistro" placeholder="Entrenador">
                  </div>
                   <div class="form-group">
                    <label for="webEquipoRegistro">Web</label>
                    <input type="text" class="form-control" id="webEquipoRegistro" name="webEquipoRegistro" placeholder="web">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

<?php 
//Enviar los datos al controlador MvcController (es la clase pricipal de controller.php)
$registro = new MvcController();
//se invoca la funcion  registroUsuarioController de la clase MvcController
$registro ->registroEquiposController();
if(isset($_GET["action"])){
  if($_GET["action"]=="ok"){
    echo "Registro Exitoso";
  }
}
 ?>