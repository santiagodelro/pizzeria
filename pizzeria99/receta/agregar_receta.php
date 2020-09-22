<?php 

include '../conexion/conexion.php';

$conexion=conexion();

$producto=$_POST['producto'];
$insumo=$_POST['insumo'];
$cantidad=$_POST['cantidad']; 
$medida=ObtenerId($_POST['medida'],$conexion);


$respuesta=Guardar($producto,$cantidad,$medida,$insumo,$conexion);



function Guardar($producto,$cantidad,$medida,$insumo,$conexion)
{
	$sql="INSERT INTO receta (producto,cantidad,medida,insumo) VALUES ('$producto','$cantidad','$medida','$insumo') " ;
	$query=mysqli_query($conexion,$sql);
	if (!$query) {
		return "fail";	
	}
	return "ok";
}


function ObtenerId($medida,$conexion)
{
	$sql="SELECT *FROM medida WHERE nombre_medida='$medida'";
	$query=mysqli_query($conexion,$sql);

	while ($fila=mysqli_fetch_array($query)) {

		return $fila['id_medida'];
		
	}

}


$json = array();

$json[]=array(
	'respuesta' =>$respuesta 

);

$jstring=json_encode($json);

echo $jstring;












?>