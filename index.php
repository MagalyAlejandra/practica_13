
<?php 

require_once "Models/enlaces.php";//requiere los enlaces para poder navegar
require_once "Models/crud.php";//requiere del modelo
require_once "Controllers/controller.php";//requiere del controlador

$template = new MvcController();//crear un objeto de tipo mvcController
$template-> template();//llamar al template

 ?>