<?php 

include '../conexion/conexion.php';


$conexion=conexion();

$sql="SELECT * FROM temp INNER JOIN producto ON producto.id_prod=temp.id_prod  INNER JOIN medida ON medida.id_medida=temp.medida  ";

$consulta=mysqli_query($conexion,$sql);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {


	$json['data'][]=array(
		'id_temp' =>$fila['id_temp'] ,
		'id_prod' =>$fila['id_prod'],
		'nombre_producto'=>$fila['nombre'],
		'medida'=>$fila['medida'],
		'fecha'=>$fila['fecha'],
		'cantidad'=>$fila['cantidad'],
		'precio'=>$fila['precio_unitario'],
		'nombre_medida'=>$fila['nombre_medida'],
		'total'=>$fila['total']
		
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;


















?>