<?php 
include '../conexion/conexion.php';

$buscador=$_POST['buscador'];


$conexion=conexion();

$query="SELECT id_tipo,descripcion FROM tipo_persona where descripcion LIKE '$buscador%' or  id_tipo LIKE '$buscador%'"; 
$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json[]=array(
		'id_tipo' =>$fila['id_tipo'] ,
		'descripcion' =>$fila['descripcion']
		
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;













?>