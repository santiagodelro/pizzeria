<?php 
include '../conexion/conexion.php';

$conexion=conexion();

$nombre=$_POST['nombre'];
$precio=$_POST['precio'];
$medida=$_POST['medida'];
$categoria=ObtenerIdCategoria('Receta',$conexion);



$json = array();

if (Insertar_producto($nombre,$medida,$categoria,$precio,$conexion)) {
	$respuesta="ok";
}else{
	$respuesta="fail";
	
}


function Insertar_producto($nombre,$medida,$categoria,$precio,$conexion)
{
	$sql="INSERT INTO producto (nombre,medida,categoria,precio) VALUES ('$nombre','$medida','$categoria','$precio') " ;
	$query=mysqli_query($conexion,$sql);
	if ($query) {
		return true;
	}
	return  false;
}

function ObtenerIdCategoria($descripcion,$conexion)
{	
	$sql="SELECT * FROM  categoria WHERE nombre_cat='$descripcion' ";
	$query=mysqli_query($conexion,$sql);

	while ($array=mysqli_fetch_array($query)) {
		$id=$array['id_cat'];
	}
	
	return $id;

}


$json[]=array(
	'respuesta' =>$respuesta
);

$jstring=json_encode($json);

echo $jstring;



?>