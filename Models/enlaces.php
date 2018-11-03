<?php 
class Paginas{

	public static function enlacesPaginasModel($enlaces){
      //validamos
	  if( $enlaces =="registroJugadores" || $enlaces =="registroEquipos" || $enlaces =="verEquipos" || $enlaces =="verJugadores" || $enlaces =="editarJugador" || $enlaces =="editarEquipo" || $enlaces =="login" || $enlaces =="salir" || $enlaces =="navegacion"){
	  	//Mostramos el URL concatenado con $enlacesModel
	  	$module = "Views/pages/".$enlaces.".php";

	  }
	  //Una ves que "action" viene vacion validando en el controlador entonces se consulta si la variabla $enlacesModel es igual ala cadena "index" para de ser asi se muestre index.php
	  else if ($enlaces == "index"){
	  	$module= "Views/pages/dashboardd.php";
	   }
	  else if ($enlaces == "fallo"){
	  	$module= "Views/pages/ingresar.php";
	   }
	   //Validar una  LISTA BLANCA
	   else
	   {
       $module= "index.php";
	   } 
	   return $module;
 	} 
}
 ?>