
<?php

include '../conexion/conexion.php';
include '../cliente/script.php';
$conexion=conexion();

if(isset($_POST['id'])){
	$id=$_POST['id'];
	$respuesta=Eliminar('producto','id_prod',$id,$conexion);
	$json = array();

	$json[]=array(
		'respuesta' =>$respuesta 

	);

	$jstring=json_encode($json);

	echo $jstring;
}








?>