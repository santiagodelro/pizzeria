
<?php 

include '../conexion/conexion.php';


$conexion=conexion();

$query="SELECT *FROM  tipo_persona";

$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json['data'][]=array(
		'id_tipo' =>$fila['id_tipo'] ,
		'descripcion' =>$fila['descripcion'],
		
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;







?>