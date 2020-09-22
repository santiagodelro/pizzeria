<?php 
include '../conexion/conexion.php';

$buscador=$_POST['buscador'];


$conexion=conexion();

$query="SELECT * FROM persona INNER JOIN tipo_persona  on tipo_persona.id_tipo=persona.id_tipo where nombre_persona LIKE '$buscador%' or apellido LIKE '$buscador%'"; 
$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json[]=array(
		'id_persona' =>$fila['id_persona'] ,
		'descripcion' =>$fila['descripcion'],
		'nombre'=>$fila['nombre_persona'],
		'apellido'=>$fila['apellido'],
		'fechanac'=>$fila['fecha_nac'],
		'domicilio'=>$fila['domicilio'],
		'telefono'=>$fila['telefono']
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;













?>