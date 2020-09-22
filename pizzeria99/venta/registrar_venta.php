<?php

include '../conexion/conexion.php';

function registrar_compra()
 {
    $conexion = conexion();
    $num_fac = $_POST['numero_factura'];
    $tipo_fac = $_POST['tipo_fac'];
    $id_admin = $_POST['id_admin'];
    $proveedor = $_POST['proveedor'];
    $fecha = $_POST['fecha'];

    $id_factura = Registrar_Factura ( $conexion, $num_fac, $proveedor, $id_admin, $tipo_fac, $fecha );
    echo $id_factura;

    $sql = "INSERT INTO detalle(id_persona,id_prod,fecha,precio_unitario,cantidad,total,id_factura,numero_factura) SELECT $proveedor,tem.id_prod,tem.fecha,tem.precio_unitario,tem.cantidad,tem.total,$id_factura,$num_fac
	FROM temp tem";
    $query = mysqli_query( $conexion, $sql );
}

function Registrar_Factura ( $conexion, $num_fac, $proveedor, $id_admin, $tipo_fac, $fecha )
 {
    $sql = ' SELECT *FROM temp';
    $query = mysqli_query( $conexion, $sql );
    $neto = 0;
    $impuesto = 0;
    $bruto = 0;
    $descuento = 0;
    $medida = 0;

    while ( $i = mysqli_fetch_array( $query ) ) {

        $id_prod = $i['id_prod'];
        $cantidad = $i['cantidad'];
        $medida = $i['medida'];
        $impuesto += $i['total']* $i['impuesto']/100;
        $neto += $i['total']+$i['total']* $i['impuesto']/100;
        if ( $i['medida'] == 2 || $i['medida'] == 6 ) {
            $bruto += $i['precio_unitario'];
        } else {
            $bruto += $i['cantidad']* $i['precio_unitario'];
        }

        if ( IdMedida( $i['medidaxunidad'], $conexion )>6 ) {
            $medidaxunidad =0;
        } else {
            $medidaxunidad = $i['medidaxunidad'];
        }

        if ( IdMedida( $i['medidaxunidad'], $conexion ) == $medida && IdMedida( $i['medidaxunidad'], $conexion )>6 ) {
            $medida =0;
        }

        $tableau = array( $medida, $medidaxunidad, GetMedidaxUnidad( $conexion, $id_prod ) );
        echo 'medida:'.$medida.' nombre:'.$medidaxunidad;
        echo "fun:".GetMedidaxUnidad($conexion,$id_prod)."pep";

        if ( ValidarArticulo( $conexion, $id_prod ) ) {
            ProductoElaborado( $id_prod, $conexion, $cantidad );
        } else {

            DescuentoDeMercaderias( $cantidad, $conexion, $id_prod, $tableau, $cantidad );
        }
    }

    $consulta = "INSERT INTO factura (fecha,id_persona,id_admin,bruto,tipo_fac,impuesto,descripcion,neto,numero_factura,descuento) VALUES ('$fecha','$proveedor',' $id_admin','$bruto','$tipo_fac','$impuesto'
	,'Venta','$neto','$num_fac','$descuento')";
    $resultado = mysqli_query( $conexion, $consulta );
    if ( !$resultado ) {
        echo 'fail';
    }

    $sql = 'SELECT MAX(id_factura) AS id FROM factura';
    $query = mysqli_query( $conexion, $sql );
    $id = 0;
    while ( $array = mysqli_fetch_array( $query ) ) {
        $id = $array['id'];
    }
    return $id;
}

function GetCantidadxMedida( $conexion, $id )
 {
    $sql = "SELECT *FROM inventario WHERE id_prod_fk='$id'";
    $query = mysqli_query( $conexion, $sql );
    while ( $array = mysqli_fetch_array( $query ) ) {
        $c = $array['cantx_medida'];
        return $c;
    }
}

function GetMedidaxUnidad( $conexion, $id )
 {
    $sql = "SELECT *FROM inventario WHERE id_prod_fk='$id'";
    $query = mysqli_query( $conexion, $sql );
    $m=0;
    while ( $array = mysqli_fetch_array( $query ) ) {
        $m = $array['medx_unidad'];
    }
    return $m;

}

function GetUnidades( $conexion, $id )
 {  $m=0;
    $sql = "SELECT *FROM inventario WHERE id_prod_fk='$id'";
    $query = mysqli_query( $conexion, $sql );
    while ( $array = mysqli_fetch_array( $query ) ) {
        $m = $array['unidades']*$array['cantx_medida'];
        
    }
    if ($m>0) {
        return $m;
    }
    return 1;
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

function DescuentoDeMercaderias( $cantidad, $conexion, $id_prod, $tableau, $cantidadcompra )
 {
    $stock = 0;
    $consulta = 0;
    $resultado = 0;

    switch ( $tableau ) {

        case array( 1, 'Unidad', 1 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod );
        break;

        case array( 1, 'Unidad', 2 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod );
        break;

        case array( 1, 'Unidad', 3 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod );
        break;

        case array( 1, 'Unidad', 4 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod );
        break;

        case array( 1, 'Unidad', 5 ):
        $stock = $cantidad;
        break;

        case array( 1, 'Unidad', 6 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod );
        break;

        case array( 2, 'Gramos', 3 ):
        $stock = $cantidad;
        $cantidadcompra = 1;
        break;
        case array( 2, 'Gramos', 2 ):
        $stock = $cantidad;
        break;
        case array( 3, 'Gramos', 3 ):
        $stock = $cantidad*1000;
        break;

        case array( 2, 'Kg', 2 ):
        $stock = $cantidad;
        $cantidadcompra = 1;
        break;

        case array( 3, 'Kg', 2 ):
        $stock = $cantidad*1000;
        break;

        case array( 3, 'Kg', 3 ):
        $stock = $cantidad*1000;
        break;

        case array( 4, 'Litro', 6 ):
        $stock = $cantidad*1000;

        break;

        case array( 6, 'Litro', 6 ):
        $stock = $cantidad;
        $cantidadcompra = 1;
        break;

        case array( 6, 'Litro', 4 ):
        $stock = $cantidad;
        break;

        case array( 0,0,1):
        $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 2 ):
            $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod )/1000;
        break;

        case array( 0, 0, 3 ):
            $stock = GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 4 ):
            $stock =GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 6 ):
            $stock =GetUnidades( $conexion, $id_prod );
           
        break;

        case array( 0, 0, 7 ):
            $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 8 ):
            $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 9 ):
            $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 10 ):
            $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 11 ):
            $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;


        case array( 1, 0, 6 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 4, 0, 6 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 0, 0, 6 ):
        $stock = GetUnidades( $conexion, $id_prod );
        break;

        case array( 6, 0, 6 ):
        $stock = $cantidad;
        $cantidadcompra = 1;
        break;

        case array( 1, 0, 1 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod )*GetUnidades( $conexion, $id_prod );
        break;

        case array( 3, 0, 3 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod )*1000*GetUnidades( $conexion, $id_prod );
        break;

        case array( 1, 0, 3 ):
        $stock = GetCantidadxMedida( $conexion, $id_prod )*1000*GetUnidades( $conexion, $id_prod );
        break;

        case array(1, 0,4):
            $stock =0;
        break;

        case array( 1, 0, 6 ):
            $stock =( GetCantidadxMedida( $conexion, $id_prod )/1000)*GetUnidades( $conexion, $id_prod );
        break;

        case array( 1, 0, 2 ):
            $stock =( GetCantidadxMedida( $conexion, $id_prod )/1000)*GetUnidades( $conexion, $id_prod );
        break;

        case array( 2, 0, 2 ):
        $stock = $cantidad;
        $cantidadcompra = 1;
        break;

        case array( 2, 0, 3 ):
        $stock = $cantidad;
        $cantidadcompra = 1;
        break;

        case array( 3, 0, 2 ):
        $stock = $cantidad*1000;
        $cantidadcompra = 1;
        break;

        case array( 6, 'Mililitro', 4 ):
        $stock = $cantidad;
        $cantidadcompra = 1;
        break;

        case array( 4, 'Mililitro', 4 ):
        $stock = $cantidad*1000;
        break;

    }

    $consulta = "UPDATE  inventario SET cant_salida=$stock+cant_salida,stock=stock-($stock*$cantidadcompra) WHERE id_prod_fk='$id_prod' ";
    $resultado = mysqli_query( $conexion, $consulta );

    if ( $resultado ) {
        return true;
    }
    return false;

}

function ProductoElaborado( $id_prod, $conexion, $cantidadcompra )
 {
    $conexion = Conexion();
    $sql = "SELECT * FROM receta  INNER JOIN medida  ON medida.id_medida=receta.medida WHERE producto='$id_prod'";
    $query = mysqli_query( $conexion, $sql );

    while( $array = mysqli_fetch_array( $query ) ) {
        $id_insumo = $array['insumo'];
        $cantidad = $array['cantidad'];
        if ( $array['medida'] == 1 ) {

            $getmedida = 5;
        } else {
            $getmedida = GetMedidaxUnidad( $conexion, $id_insumo );
        }

        $tableau = array( $array['medida'], $array['nombre_medida'], $getmedida );

        DescuentoDeMercaderias( $cantidad, $conexion, $id_insumo, $tableau, $cantidadcompra );
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

echo registrar_compra();
?>