<?php 
include '../conexion/conexion.php';
//datos que vienen para actualizar
$conexion=conexion();
$id=$_POST['id'];
$nombre=ucfirst($_POST['nombre']);
$precio=$_POST['precio'];
$medida=$_POST['medida'];
$categoria=$_POST['categoria'];


if (!Actualizar($nombre,$precio,$categoria,$medida,$id,$conexion)) {
	$respuesta="fail";
}
else{
	$respuesta="ok";
}


function Actualizar($nombre,$precio,$categoria,$medida,$id,$conexion)
{
	$sql="UPDATE producto SET nombre='$nombre',precio='$precio',medida='$medida',categoria='$categoria' WHERE id_prod='$id' ";
	$query=mysqli_query($conexion,$sql);
	if ($query) {
		return true;
	}
	return false;	
}



$json = array();

$json[]=array(
	'respuesta' =>$respuesta 
);
$jstring=json_encode($json);

echo $jstring;











?>