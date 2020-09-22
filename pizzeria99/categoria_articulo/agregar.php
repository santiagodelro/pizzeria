<?php 

include '../conexion/conexion.php';
include 'validar_categoria.php';


$conexion=conexion();

$nombre=$_POST['nombre'];

if (!Validar_Categoria($nombre,$conexion)) {
	$respuesta="ok";
	$sql="INSERT INTO categoria(nombre_cat) VALUES ('$nombre') ";
	$consulta=mysqli_query($conexion,$sql);	
}
else  {
	$respuesta="fail";

}

$json = array();

$json[]=array(
	'respuesta' =>$respuesta 

);

$jstring=json_encode($json);

echo $jstring;













?>