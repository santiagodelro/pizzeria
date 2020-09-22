
<?php 

include '../conexion/conexion.php';

$conexion=conexion();


$query="SELECT * FROM producto INNER JOIN categoria on categoria.id_cat=producto.categoria  INNER JOIN medida  on medida.id_medida=producto.medida";

$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json['data'][]=array(
		'id_prod' =>$fila['id_prod'] ,
		'nombre'=>$fila['nombre'],
		'precio'=>$fila['precio'],
		'categoria'=>$fila['nombre_cat'],
		'medida'=>$fila['nombre_medida'],
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;







?>