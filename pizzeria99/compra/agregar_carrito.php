<?php

include '../conexion/conexion.php';

function agregar_carrito() {

    $conexion = conexion();
    $producto = $_POST['producto'];
    $costo = $_POST['costo'];
    $cantidad = $_POST['cantidad'];
    $total = 0;
    $fecha = $_POST['fecha'];
    $medida = IdMedida( $_POST['medida'], $conexion );
    $medidaxunidad = $_POST['medidaxunidad'];
    $cantidadxmedida = $_POST['cantidadxmedida'];
    $cant_config = $_POST['cant_config'];
    $medida_config = $_POST['medida_config'];
    $impuesto = $_POST['impuesto'];
    $stock = 0;
    $unidades=0;

    if($medida==6 || $medida==2 ) {
        $total = $costo;
        $stock = $cantidad;
    } 
    else if ($medida > 6 && $cant_config !="" && $medida_config==3 ||  $medida_config==4) {
        $unidades = $cantidadxmedida;
        $stock = ( $cantidadxmedida*$cantidad )*$cant_config*1000;
        $cantidadxmedida = $cant_config;
        $medidaxunidad = $medida_config;
        $total = $cantidad*$costo;   
    }
    else if ($medida > 6 && $cant_config !="") {
        $unidades = $cantidadxmedida;
        $stock=$cantidadxmedida*$cantidad*$cant_config;
        $cantidadxmedida = $cant_config;
        $medidaxunidad = $medida_config;
        $total=$cantidad*$costo;  
    }
    else if ($medida > 6 && $cant_config=="" && $medidaxunidad==3 ||  $medidaxunidad==4) {
        $stock = ( $cantidadxmedida*$cantidad )*1000;
        $total = $cantidad*$costo;   
    }
    else if($medida > 6 && $cant_config=="" ) {
        $stock = ( $cantidadxmedida*$cantidad );
        $total = $cantidad*$costo;   
    }
    else if($medida==3) {
        $total = $cantidad*$costo;
        $stock = $cantidadxmedida;
    }
    else if( $medida==4) {
        $total = $cantidad*$costo;
        $stock = $cantidadxmedida*$cantidad;
    }
    else if($medida==1){
        $total = $cantidad*$costo;
        $stock = $cantidad*$cantidadxmedida; 
    }
    
    $sql = "INSERT INTO   temp (id_prod,precio_unitario,cantidad,total,fecha,medida,cantxmed,medidaxunidad,impuesto,stock,unidades) VALUES
	('$producto','$costo','$cantidad','$total','$fecha','$medida','$cantidadxmedida','$medidaxunidad','$impuesto','$stock','$unidades') ";

    $query = mysqli_query( $conexion, $sql );

    if ( !$query ) {
        echo 'fail';
    }

}

function IdMedida($nombre,$conexion )
 {
    $sql = "SELECT *FROM medida WHERE nombre_medida='$nombre'";
    $query = mysqli_query( $conexion, $sql );
    while ( $fila = mysqli_fetch_array( $query ) ) {
        $lista = $fila['id_medida'];
        echo $lista;
    }
    return $lista;
}
echo agregar_carrito();

?>