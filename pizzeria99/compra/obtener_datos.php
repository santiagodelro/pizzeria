<?php
include '../conexion/conexion.php';
$conexion=conexion();

$id=$_POST['id'];

$query="SELECT * FROM temp   LEFT JOIN producto p ON p.id_prod=temp.id_prod  LEFT JOIN medida ON medida.id_medida=temp.medida WHERE temp.id_prod='$id' ";

$resultado=mysqli_query($conexion,$query);

if(!$resultado){
	die('ERROR en la consulta');
}

$json=array();

while ($fila=mysqli_fetch_array($resultado)) {
	
	$json[]=array(
		'id_temp' =>$fila['id_temp'] ,
		'id_prod' =>$fila['id_prod'],
		'nombre_producto'=>$fila['nombre'],
		'medida'=>$fila['medida'],
		'fecha'=>$fila['fecha'],
		'cantidad'=>$fila['cantidad'],
		'precio'=>$fila['precio_unitario'],
		'nombre_medida'=>$fila['nombre_medida'],
		'total'=>$fila['total'],
		'cxm'=>$fila['cantxmed'],
		'mxu'=>$fila['medidaxunidad'],
		'impuesto'=>$fila['impuesto']



	);
	
}

$jsonstring=json_encode($json[0]);
echo $jsonstring;

?>