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

	$id_factura =Registrar_Factura ($conexion,$num_fac,$proveedor,$id_admin,$tipo_fac,$fecha);
	echo $id_factura;

    $sql = "INSERT INTO detalle(id_persona,id_prod,fecha,precio_unitario,cantidad,total,id_factura,numero_factura) SELECT $proveedor,tem.id_prod,tem.fecha,tem.precio_unitario,tem.cantidad,tem.total,$id_factura,$num_fac
	FROM temp tem";
    $query = mysqli_query( $conexion, $sql );

}

function Registrar_Factura ($conexion,$num_fac,$proveedor,$id_admin,$tipo_fac,$fecha)
 {
    $sql = ' SELECT *FROM temp';
    $query = mysqli_query( $conexion, $sql );
    $neto = 0;
    $impuesto = 0;
    $bruto = 0;
    $descuento=0;
    while ( $array = mysqli_fetch_array( $query ) ) {
        $impuesto += $array['total']* $array['impuesto']/100;
        $neto += $array['total']+$array['total']* $array['impuesto']/100;
        if ( $array['medida'] == 2 || $array['medida'] == 6 ) {
            $bruto += $array['precio_unitario'];
        } else {
            $bruto += $array['cantidad']* $array['precio_unitario'];
        }
      
    }
    $sql = "INSERT INTO factura ( fecha,id_persona,id_admin,bruto,tipo_fac,impuesto,descripcion,neto,numero_factura,descuento) VALUES ('$fecha','$proveedor',' $id_admin','$bruto','$tipo_fac','$impuesto'
	,'Compra','$neto','$num_fac','$descuento')";
    $query = mysqli_query( $conexion, $sql );
    if ( !$query ) {
        echo 'fail';
    }

    $consulta="INSERT INTO inventario(id_prov,costo,cant_entrada,cant_salida,stock,id_prod_fk,cantx_medida,medx_unidad,cant_real,unidades) SELECT $proveedor,t.precio_unitario,t.stock,'0',t.stock,t.id_prod,t.cantxmed,t.medidaxunidad,t.cantidad,t.unidades FROM temp t";
    $resultado=mysqli_query($conexion,$consulta);

    
    $sql = "SELECT MAX(id_factura) AS id FROM factura";
	$query = mysqli_query( $conexion, $sql );
	$id=0;
    while ( $array = mysqli_fetch_array( $query ) ) {
        $id = $array['id'];
    }
	return $id;
}

echo registrar_compra();

?>