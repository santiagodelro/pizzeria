<?php 
$date1 = date("Y-m-d", strtotime($_POST['date1']));
$date2 = date("Y-m-d", strtotime($_POST['date2']));
include '../conexion/conexion.php';

$conexion=conexion();
$query="SELECT DISTINCT p.id_prod, s.fecha, p.nombre, p.precio,i.costo, s.total, s.id_detalle, s.cantidad FROM detalle s LEFT JOIN producto p ON s.id_prod = p.id_prod RIGHT JOIN inventario i on i.id_prod_fk=p.id_prod WHERE s.fecha BETWEEN '$date1' AND '$date2'";


$consulta=mysqli_query($conexion,$query);
if(!$consulta){
    die('Error Consulta'.mysqli_error($conexion));
}
$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

  $json[]=array(
    'fecha'=>$fila['fecha'],
    'nombre'=>$fila['nombre'],
    'costo'=>$fila['costo'],
    'precio'=>$fila['precio'],
    'total_venta'=>$fila['total'],
    'cantidad'=>$fila['cantidad'],
    'id_detalle'=>$fila['id_detalle']


  );
}
$jsonstring=json_encode($json);

echo $jsonstring;
?>