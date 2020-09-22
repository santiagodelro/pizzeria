
<?php

include '../conexion/conexion.php';

$conexion=conexion();

if(isset($_POST['id'])){
	
	$id=$_POST['id'];
	$query=" DELETE FROM tipo_persona WHERE id_tipo='$id' ";
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
}








?>