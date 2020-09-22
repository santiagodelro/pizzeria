
<?php 

include '../conexion/conexion.php';

$conexion=conexion();

$id=$_POST['id'];

$query="Select
p.id_prod
,p.nombre
,p.precio
,m1.nombre_medida AS nm1
,cat.nombre_cat



 FROM producto as p

  INNER JOIN categoria  as cat on p.categoria=cat.id_cat   
  INNER JOIN medida as  m1 on p.medida=m1.id_medida 
   WHERE id_prod!='$id' AND cat.nombre_cat!='Receta'";

$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json[]=array(
		'id_prod' =>$fila['id_prod'] ,
		'nombre'=>$fila['nombre'],
		'categoria'=>$fila['nombre_cat'],
		'medida'=>$fila['nm1'],

	







	);
}

$jsonstring=json_encode($json);

echo $jsonstring;







?>