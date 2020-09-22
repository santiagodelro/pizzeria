
<?php

include '../conexion/conexion.php';
include '../cliente/script.php';

$conexion=conexion();

if(isset($_POST['id'])){
	
	$id=$_POST['id'];

	if (!VerificarRegistros($conexion,$id)) {
		$respuesta=Eliminar('persona','id_persona',$id,$conexion);	
	}
	else{
		$respuesta='existeregistro';
	}
	
	$json = array();

	$json[]=array(
		'respuesta' =>$respuesta 

	);

	$jstring=json_encode($json);

	echo $jstring;
}



function VerificarRegistros($conexion,$id){
	$sql="SELECT COUNT(id_persona) as existe FROM detalle WHERE id_persona='$id'";
	$query=mysqli_query($conexion,$sql);
	$array=mysqli_fetch_array($query);
	if ($array['existe']>0) {
		return true;
	}
	return false;
}








?>