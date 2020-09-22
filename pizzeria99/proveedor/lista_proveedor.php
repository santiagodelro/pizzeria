<?php 

include '../conexion/conexion.php';

$conexion=conexion();

$query="SELECT * FROM persona INNER JOIN tipo_persona  on tipo_persona.id_tipo=persona.id_tipo WHERE descripcion='proveedor'";

$consulta=mysqli_query($conexion,$query);

$json = array();


while ($fila=mysqli_fetch_array($consulta)) {

	$json['data'][]=array(
		'nombre' =>$fila['nombre_persona'] ,
		'apellido' =>$fila['apellido'],
		'domicilio' =>$fila['domicilio'],
		'telefono' =>$fila['telefono'],
		'email' =>$fila['email'],
		'id_persona' =>$fila['id_persona']
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;







?>