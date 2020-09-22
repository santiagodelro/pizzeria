<?php 

include '../conexion/conexion.php';

$buscador=$_POST['buscador'];


$conexion=conexion();

$query="SELECT * FROM producto INNER JOIN categoria  on producto.id_cat=categoria.id_cat  INNER JOIN persona on producto.id_prov=persona.id_persona  WHERE nombre LIKE '$buscador%' or descripcion LIKE '$buscador%'";

$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json[]=array(
		'id' =>$fila['id_prod'] ,
		'descripcion' =>$fila['descripcion'],
		'nombre'=>$fila['nombre'],
		'costo'=>$fila['costo'],
		'precio'=>$fila['precio'],
		'venta'=>$fila['cant_salida'],
		'compra'=>$fila['cant_entrada'],
		'stock'=>$fila['stock'],
		'tipo'=>$fila['nombre_cat'],
		'nombre_prov'=>$fila['nombre_persona'],
		'nombre_empresa'=>$fila['apellido']

	);
}

$jsonstring=json_encode($json);

echo $jsonstring;













?>