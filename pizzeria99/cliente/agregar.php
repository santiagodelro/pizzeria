<?php 

include '../conexion/conexion.php';
include 'script.php';


$conexion=conexion();

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido']; 
$telefono=$_POST['telefono'];
$domicilio=$_POST['domicilio'];
$fecha=$_POST['fecha'];
$email=$_POST['email'];
$tipo=ObtenerIdCategoria('cliente',$conexion);


if (!Insertar($email,$nombre,$apellido,$telefono,$domicilio,$fecha,$tipo,$conexion)) {
	$respuesta="fail";	
}
else{
	$respuesta="ok";

}


$json = array();

$json[]=array(
	'respuesta' =>$respuesta 

);

$jstring=json_encode($json);

echo $jstring;












?>