<?php
include '../conexion/conexion.php';


$id=$_POST['id'];

$conexion=conexion();

$query="SELECT descripcion FROM tipo_persona where id_tipo='$id'";

$resultado=mysqli_query($conexion,$query);

if(!$resultado){
	die('ERROR en la consulta');
}

$json=array();

while ($fila=mysqli_fetch_array($resultado)) {
	
	$json[]=array(
		'id_tipo'=>$id,
		'descripcion'=>$fila['descripcion']
	);
	
}

$jsonstring=json_encode($json[0]);
echo $jsonstring;

?>