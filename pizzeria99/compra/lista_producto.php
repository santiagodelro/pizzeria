
<?php 

include '../conexion/conexion.php';

$conexion=conexion();


$query="Select
p.id_prod
,p.nombre
,p.precio
,m1.nombre_medida AS nm1
,cat.nombre_cat

 FROM producto as p

  INNER JOIN categoria  as cat on p.categoria=cat.id_cat   
  INNER JOIN medida as  m1 on p.medida=m1.id_medida 
  WHERE cat.nombre_cat!='receta' ";

$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json['data'][]=array(
		'id_prod' =>$fila['id_prod'] ,
		'nombre'=>$fila['nombre'],
		'precio'=>$fila['precio'],
		'medida'=>$fila['nm1']

	);
}

$jsonstring=json_encode($json);

echo $jsonstring;







?>