<?php
include '../conexion/conexion.php';

$id=$_POST['id'];

$conexion=conexion();

$query="SELECT * FROM persona INNER JOIN tipo_persona  on tipo_persona.id_tipo=persona.id_tipo where id_persona='$id'";

$resultado=mysqli_query($conexion,$query);

if(!$resultado){
	die('ERROR en la consulta');
}

$json=array();

while ($fila=mysqli_fetch_array($resultado)) {

	$descripcion=$fila['descripcion'];
	$query1="SELECT * FROM tipo_persona WHERE descripcion='$descripcion'";
	$resultado1=mysqli_query($conexion,$query1);
	$fila1=mysqli_fetch_array($resultado1);
	$id_tipo=$fila1['id_tipo'];
	
	$json[]=array(
		'id_persona' =>$fila['id_persona'] ,
		'descripcion' =>$fila['descripcion'],
		'nombre'=>$fila['nombre_persona'],
		'apellido'=>$fila['apellido'],
		'fechanac'=>$fila['fecha_nac'],
		'domicilio'=>$fila['domicilio'],
		'telefono'=>$fila['telefono'],
		'email'=>$fila['email'],
		'id_tipo'=>$id_tipo
	);
	
}

$jsonstring=json_encode($json[0]);
echo $jsonstring;

?>