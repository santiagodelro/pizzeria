<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$nombre=ucfirst($_POST['nombre']);
$precio=$_POST['precio'];
$medida=$_POST['medida'];
$categoria=(isset($_POST['categoria'])?$_POST['categoria']:'5');


$respuesta=Insertar_producto($nombre,$precio,$categoria,$medida,$conexion);
$json = array();

$json[]=array(
	'respuesta' =>$respuesta
);

$jstring=json_encode($json);

echo $jstring;

function Insertar_producto($nombre,$precio,$categoria,$medida,$conexion){

	$sql="INSERT INTO producto (nombre, precio, categoria, medida) VALUES ('$nombre', '$precio', '$categoria', '$medida')" ;
	$query=mysqli_query($conexion,$sql);
	if ($query) {
		return "ok";
	}
	return "fail";
}









?>