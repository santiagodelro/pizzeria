<?php

include '../conexion/conexion.php';

$conexion = conexion();
$tipo = $_POST['idp'];
$query = "SELECT * FROM persona INNER JOIN tipo_persona  on persona.id_tipo=tipo_persona.id_tipo WHERE descripcion='proveedor'";

$consulta = mysqli_query( $conexion, $query );

$lista = '';

while ( $fila = mysqli_fetch_array( $consulta ) ) {
    $lista = "<option value='$fila[id_persona]'>$fila[nombre_persona]</option>";
    echo $lista;

}

?>