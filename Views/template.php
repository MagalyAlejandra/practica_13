<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Sistema de Control de Jugadores </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="Views/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<!---################################# CODIGO PARA INICIAR EN EL INDEX -->
<body class="hold-transition 
<?php
session_start();
if(isset($_SESSION["validar"])):
?>
sidebar-mini
<?php
else: 
?>
login-page
<?php
endif;
?>">
<?php if(isset($_SESSION["validar"])):?>  
<!--################################## FINAL CODIGO-->

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <div class="input-group-append">
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <div class="input-group-append">
        <a href="index.php?action=salir">
          <button class="btn btn-danger"> Salir </button>
        </a>
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">B I E N V E N I D O</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">
          <img src="Views/dist/img/user4-128x128.jpg" class="img-circle elevation-1" alt="User Image">
        </div>
        <a href="index.php" class="brand-link">
          <span class="brand-text font-weight-light">Control de Jugadores</span>
        </a>
        <div class="info">
          <a href="" class="d-block"><?php //echo $_SESSION["user"]; ?></a><!--Imprime el nombre de el usuario ingresado en la plantilla-->
        </div>
      </div>

      <?php include "Views/pages/navegacion.php"; ?><!--Incluir la navegacion del menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
          <?php 
          //Mostraremos un controlador que muestra la plantilla 
          $mvc = new MvcController();
          //mostramos la funcion para movernos en las paginas:
          $mvc -> enlacesPaginasController();
          ?>
          </div>
         
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
</div>
<?php else: ?>

  <!--FORMULARIO DE LOGIN INICIO ##########################################-->
  <div class="login-box">
  <div class="login-logo">
    <a href="" >
      <b>
      <img src="Views/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" 
           style="opacity: .8"></b><b></b>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesion</p>

      <form action="" method="post">
        <div class="form-group has-feedback">
          <label for="emailIngreso">Usuario</label>
          <input type="email" class="form-control" placeholder="Correo" name="emailIngreso">
          <span class="fa fa-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <label for="passwordIngreso">Contraseña</label>
          <input type="password" class="form-control" placeholder="Password" name="passwordIngreso">
          <span class="fa fa-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
  </div>
</div>
<!--FORMULARIO DE LOGIN FIN #############################################-->
  <?php endif; ?>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="Views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="Views/dist/js/adminlte.min.js"></script>
</body>
</html>


<?php
//Enviar los datos al controlador MvcController (es la clase pricipal de controller.php)
$logiar = new MvcController();
//se invoca la fucnion  LoginUsuarioController de la clase MvcController
$logiar ->loginUsuarioController();
if(isset($_GET["error"])){
  if($_GET["error"]=="si"){
   echo'<script>
   alert("Datos Incorrectos");
   </script>';

  }
}
 ?>
