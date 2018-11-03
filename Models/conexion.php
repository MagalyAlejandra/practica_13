<?php 
class Conexion{
	public static function conectar(){
	$dsn = 'mysql:host=localhost;dbname=players';//se crea la conexion ala base de datos
	$user = 'root';//definimos el usuario
	$password = '';//definimos la contraseña
    $link = new PDO($dsn, $user, $password);
    return $link;
	
	}
}

 ?>