<?php 

include '../conexion/conexion.php';
include 'script.php';


$conexion=conexion();
$id=$_POST['id'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido']; 
$telefono=$_POST['telefono'];
$domicilio=$_POST['domicilio'];
$fecha=$_POST['fecha'];
$email=$_POST['email'];
$tipo=ObtenerIdCategoria('cliente',$conexion);


$query="UPDATE persona SET nombre_persona='$nombre',apellido='$apellido',telefono='$telefono',domicilio='$domicilio',fecha_nac='$fecha',id_tipo='$tipo',email='$email'  WHERE id_persona='$id' ";

$resultado=mysqli_query($conexion,$query);


if (!$resultado) {
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