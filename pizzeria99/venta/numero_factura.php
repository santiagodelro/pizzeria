<?php
include '../conexion/conexion.php';

$conexion = conexion();

$sql = 'SELECT MAX(numero_factura) AS n FROM factura';
$query = mysqli_query( $conexion, $sql );
$num_fac = 0;
while ( $array = mysqli_fetch_array( $query ) ) {
	if ($array['n']!="") {
		$num_fac = $array['n'];
	}
}
echo $num_fac;

?>