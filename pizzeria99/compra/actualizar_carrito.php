<?php

include '../conexion/conexion.php';

$conexion = conexion();
$producto = $_POST['producto'];
$costo = $_POST['costo'];
$temp= $_POST['id_temp'];
$cantidad = $_POST['cantidad'];
$total = 0;
$fecha = $_POST['fecha'];
$medida = IdMedida( $_POST['medida'], $conexion );
$medidaxunidad = $_POST['medidaxunidad'];
$cantidadxmedida = $_POST['cantidadxmedida'];
$impuesto = $_POST['impuesto'];

if ($_POST['medida']=='Mililitro' || $_POST['medida']=='Gramos') {
	$total+=$costo-$impuesto;
}
else{
	$total+=$cantidad*$costo-$impuesto;
}

$sql = "UPDATE  temp SET id_prod='$producto', precio_unitario='$costo',cantidad='$cantidad',total='$total',fecha='$fecha',medida='$medida',cantxmed='$cantidadxmedida',medidaxunidad='$medidaxunidad',impuesto='$impuesto' WHERE id_temp='$temp'";

$query = mysqli_query( $conexion, $sql );


if ( !$query ) {
    $respuesta = 'fail';

} else {
    $respuesta = 'ok';

}



function IdMedida($nombre,$conexion)
{
	$sql="SELECT *FROM medida WHERE nombre_medida='$nombre'";
	$query=mysqli_query($conexion,$sql);
	while ($fila=mysqli_fetch_array($query)) {
		$lista=$fila['id_medida'];
		echo $lista;
	}
	return $lista;
}

$json = array();

$json[] = array(
    'respuesta' =>$respuesta

);

$jstring = json_encode( $json );

echo $jstring;

?>