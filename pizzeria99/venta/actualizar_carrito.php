<?php

include '../conexion/conexion.php';

$conexion = conexion();
$producto = $_POST['producto'];
$precio = $_POST['precio'];
$temp= $_POST['id_temp'];
$cantidad = $_POST['cantidad'];
$total = 0;
$fecha = $_POST['fecha'];
$medida = $_POST['medida'];
$medidacompra= $_POST['medidacompra'];
$impuesto = $_POST['impuesto'];

if ($_POST['medida']=='Mililitro' || $_POST['medida']=='Gramos') {
	$total+=$precio-$impuesto;
}
else{
	$total+=$cantidad*$precio-$impuesto;
}

$sql = "UPDATE  temp SET id_prod='$producto', precio_unitario='$precio',cantidad='$cantidad',total='$total',fecha='$fecha',medida='$medida',cantxmed='',medidaxunidad='$medidacompra',impuesto='$impuesto' WHERE id_temp='$temp'";

$query = mysqli_query( $conexion, $sql );


if ( !$query ) {
    $respuesta = 'fail';

} else {
    $respuesta = 'ok';

}


$json = array();

$json[] = array(
    'respuesta' =>$respuesta

);

$jstring = json_encode( $json );

echo $jstring;

?>