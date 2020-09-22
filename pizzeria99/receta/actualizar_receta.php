<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$id_receta=$_POST['id_receta'];
$insumo=$_POST['insumo'];
$medida=$_POST['medida'];
$cantidad=$_POST['cantidad'];


$sql="UPDATE receta SET insumo='$insumo',cantidad='$cantidad',medida='$medida'  WHERE id_receta='$id_receta' ";

$resultado=mysqli_query($conexion,$sql);



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