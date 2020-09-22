<?php 

include '../conexion/conexion.php';
include '../cliente/script.php';


$conexion=conexion();

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido']; 
$telefono=$_POST['telefono'];
$domicilio=$_POST['domicilio'];
$email=$_POST['email'];
$tipo=ObtenerIdCategoria('proveedor',$conexion);


if (!Insertar($email,$nombre,$apellido,$telefono,$domicilio,'',$tipo,$conexion)) {
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