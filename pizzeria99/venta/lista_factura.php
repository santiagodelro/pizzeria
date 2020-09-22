<?php 

include '../conexion/conexion.php';

$conexion=conexion();

$query="SELECT * FROM factura INNER JOIN persona  on persona.id_persona=factura.id_persona ";

$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json[]=array(
		'nombre'=>$fila['nombre_persona'],
		'total'=>$fila['neto'],
		'fecha'=>$fila['fecha'],
		'num_fac'=>$fila['numero_factura'],
		'id_factura'=>$fila['id_factura'],
		'apellido'=>$fila['apellido']

		

	);
}

$jsonstring=json_encode($json);

echo $jsonstring;







?>