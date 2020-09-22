<?php

include '../conexion/conexion.php';

$conexion = conexion();

if ( isset( $_POST['id'] ) ) {
    $id = $_POST['id'];

    $query = " DELETE FROM temp WHERE id_prod='$id' ";
    $resultado = mysqli_query( $conexion, $query );

    if ( !$resultado ) {
        $respuesta = 'fail';

    } else {
        $respuesta = 'ok';

    }

    $json = array();

    $json[] = array(
        'respuesta' =>$respuesta

    );

    
}


if ( isset( $_POST['temp'] ) ) {

    $query = " DELETE FROM temp";
    $resultado = mysqli_query( $conexion, $query );

    if ( !$resultado ) {
        $respuesta = 'fail';

    } else {
        $respuesta = 'ok';

    }

    $json = array();

    $json[] = array(
        'respuesta' =>$respuesta

    ); 
}
$jstring = json_encode($json);

echo $jstring;
?>