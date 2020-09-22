<?php
include ('../conexion/conexion.php');

$conexion=conexion();
$date=date("Y"."-"."m"."-"."d"); 


$id_empleado=$_POST['id_empleado'];
$id_admin=$_POST['id_admin'];
$cantidad=$_POST['cantidad'];
$descripcion=$_POST['descripcion'];
$tipo_factura=$_POST['tipo_factura'];

$query="SELECT numero_factura FROM factura";
$resultado=mysqli_query($conexion, $query);  
$json=array();
$numero_fac=0;
while ($res=mysqli_fetch_array($resultado)) {
	$json[]=array(
	    'num_fac'=>$res['numero_factura']
	    
);
$numero_fac=$numero_fac+1;
}
$num_fac=$numero_fac+1;	
echo $numero_fac;


$query="INSERT INTO factura(numero_factura, fecha, id_persona, id_admin, neto, tipo_fac, descripcion)
VALUES ('$num_fac','$date','$id_empleado','$id_admin','$cantidad','$tipo_factura','$descripcion')";
$resultado=mysqli_query($conexion, $query);
if (!$resultado){
    die('QUERY FALLO');
}
echo 'Tarea agregada correctamente';



?>