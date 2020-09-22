<?php 

include '../conexion/conexion.php';
include 'validar_categoria.php';

$conexion=conexion();
$id=$_POST['id'];
$nombre=$_POST['nombre'];

if (!Validar_Categoria($nombre,$conexion)) {
	$respuesta="ok";
	$query="UPDATE tipo_persona SET descripcion='$nombre' WHERE id_tipo='$id' ";
	$consulta=mysqli_query($conexion,$query);	
}
else {
	$respuesta="fail";

}

$json = array();

$json[]=array(
	'respuesta' =>$respuesta 

);

$jstring=json_encode($json);

echo $jstring;










?>