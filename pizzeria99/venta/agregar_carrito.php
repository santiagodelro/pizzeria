<?php

include '../conexion/conexion.php';

function agregar_carrito() {
    $conexion = conexion();
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $cant_real=$cantidad;
    $total = 0;
    $fecha = $_POST['fecha'];
    $medidaventa = $_POST['medida'];
    $medidacompra = $_POST['medidacompra'];
    $impuesto = $_POST['impuesto'];
    $stock = 0;
    $json = array();
    $cantstock=0;
    

    if ( $_POST['medida'] == 6 || $_POST['medida'] == 2 ) {
        $total += $precio;
        $cantstock=$cantidad;

    } else {
        $total += $cantidad*$precio;
    }


    if ( $_POST['medida'] == 3 || $_POST['medida'] == 4 ) {
        $cantstock=$cantidad*1000;
    } 
    
    if (ValidarArticulo( $conexion, $producto) && ProductoElaborado($conexion,$producto) || !ValidarArticulo( $conexion, $producto) &&  VerificarStock($conexion,$producto,$cantstock) ) {
        $sql = "INSERT INTO   temp (id_prod,precio_unitario,cantidad,total,fecha,medida,cantxmed,medidaxunidad,impuesto,stock) VALUES
        ('$producto','$precio','$cantidad','$total','$fecha','$medidaventa','','$medidacompra','$impuesto','$stock') ";
        $query = mysqli_query( $conexion, $sql ); 
        if ( !$query ) {
            echo 'fail';
        } 
    } else {  
        $json[]=array(
            
            'respuesta'=>'nostock'
        );
        $jsonstring=json_encode($json);

        echo $jsonstring;
    }
    


    

}

function IdMedida( $nombre, $conexion )
 {
    $sql = "SELECT *FROM medida WHERE nombre_medida='$nombre'";
    $query = mysqli_query( $conexion, $sql );
    while ( $fila = mysqli_fetch_array( $query ) ) {
        $lista = $fila['id_medida'];
        echo $lista;
    }
    return $lista;
}


function VerificarStock($conexion,$id,$cantidad)
{     
    $sql = "SELECT * FROM inventario WHERE id_prod_fk='$id'";
    $query = mysqli_query( $conexion, $sql );
    while ( $fila = mysqli_fetch_array( $query ) ) {
    
            if ($fila['stock']>=$cantidad){
                return true;

        }
    }
    return false;  

}

function ProductoElaborado($conexion,$id)
{
    $sql = "SELECT * FROM receta WHERE producto='$id'";
    $query = mysqli_query( $conexion, $sql );
    while ( $fila = mysqli_fetch_array( $query ) ) {
    
            if (!VerificarStock($conexion,$fila['insumo'],$fila['cantidad'])){
                return false;
            }
    }
    return true;  

}



function ValidarArticulo( $conexion, $id )
 {
    $sql = "SELECT count(producto) as id  FROM receta where producto=$id";
    $query = mysqli_query( $conexion, $sql );
    while ( $array = mysqli_fetch_array( $query ) ) {
        if ( $array['id']>0 ) {
            return true;
        }
    }
    return false;

}
echo agregar_carrito();

?>