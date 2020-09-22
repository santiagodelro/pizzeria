
<?php 

include '../conexion/conexion.php';

$conexion=conexion();


$query="Select
p.id_prod
,p.nombre
,p.precio
,m1.nombre_medida AS nm1
,m2.nombre_medida As nm2
,i.costo
,i.cant_entrada
,i.cant_salida
,i.cantx_medida
,i.medx_unidad
,i.stock
,cat.nombre_cat



 FROM producto as p

  INNER JOIN categoria  as cat on p.categoria=cat.id_cat   
  INNER JOIN medida as  m1 on p.medida=m1.id_medida 
  LEFT JOIN inventario as i on i.id_prod_fk=p.id_prod
  LEFT JOIN persona as pe on i.id_prov=pe.id_persona 
  LEFT JOIN medida as m2 on i.medx_unidad=m2.id_medida ";

$consulta=mysqli_query($conexion,$query);

$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

	$json['data'][]=array(
		'id_prod' =>$fila['id_prod'] ,
		'nombre'=>$fila['nombre'],
		'costo'=>$fila['costo'],
		'precio'=>$fila['precio'],
		'categoria'=>$fila['nombre_cat'],
		'medida'=>$fila['nm1'],
		'entrada'=>$fila['cant_entrada'],
		'salida'=>$fila['cant_salida'],
		'stock'=>$fila['stock'],
		'cantidadxmedida'=>$fila['cantx_medida'],
		'medidax_unidad'=>$fila['nm2']
	







	);
}

$jsonstring=json_encode($json);

echo $jsonstring;







?>