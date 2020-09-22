<?php
require_once 'Consultas.php';
require_once '../conexion/conexion.php';
require_once '../cliente/script.php';

$consulta = new Consultas();

switch ( $_GET['op'] ) {

    case 'comprasfecha':
    $fecha_inicio = $_REQUEST['fecha_inicio'];
    $fecha_fin = $_REQUEST['fecha_fin'];
    Consultasfecha( $fecha_inicio, $fecha_fin, 'Compra' );

    break;

    case 'ventasfecha':
    $fecha_inicio = $_REQUEST['fecha_inicio'];
    $fecha_fin = $_REQUEST['fecha_fin'];
    Consultasfecha( $fecha_inicio, $fecha_fin, 'Venta' );
    break;

    case 'eliminarfactura':
    EliminarFactura();
    break;

    case 'stock':
    stock();
    break;
}

function ConsultasFecha( $fecha_inicio, $fecha_fin, $descripcion ) {
    $conexion = conexion();
    $sql = "SELECT DATE(i.fecha) as fecha, a.usuario as usuario, p.nombre_persona as proveedor,i.neto as total,i.impuesto as impuesto,i.numero_factura as num_fac FROM factura i INNER JOIN persona p ON i.id_persona=p.id_persona INNER JOIN administrador a ON a.id_admin=i.id_admin WHERE DATE(i.fecha)>='$fecha_inicio' AND DATE(i.fecha)<='$fecha_fin' AND descripcion='$descripcion'";
    $query = mysqli_query( $conexion, $sql );
    $data = Array();
    while ( $a = mysqli_fetch_array( $query ) ) {
        $data[] = array(
            '0'=>$a['num_fac'],
            '1'=>$a['fecha'],
            '2'=>$a['usuario'],
            '3'=>$a['proveedor'],
            '4'=>$a['total'],
            '5'=>$a['impuesto'],
            '6'=>'<button class="btn btn-danger btn-sm " id="eliminar_factura" style="width:30px">
				<i class="fa fa-trash"></i>
				</button> 
				<button class="btn btn-success btn-sm " id="ver_factura" data-toggle="modal" data-target="#modal-default" style="width:30px">
				<i class="fa fa-eye"></i>
				</button>'
        );
    }
    $results = array(
        'sEcho'=>1, //info para datatables
        'iTotalRecords'=>count( $data ), //enviamos el total de registros al datatable
        'iTotalDisplayRecords'=>count( $data ), //enviamos el total de registros a visualizar
        'aaData'=>$data );

        echo json_encode( $results );

    }

    function EliminarFactura() {
        if ( isset( $_GET['num_fac'] ) ) {
            $conexion = conexion();
            $num_fac = $_GET['num_fac'];
            $respuesta = Eliminar( 'factura', 'numero_factura', $num_fac, $conexion );
            $json = array();

            $json[] = array(
                'respuesta' =>$respuesta
            );
            $jstring = json_encode( $json );

            echo $jstring;
        }
    }

    function Stock() {
        $conexion = conexion();
        $sql = "SELECT DISTINCT i.medx_unidad as medx_unidad,p.id_prod, p.nombre ,c.nombre_cat as categoria,p.medida,p.precio,i.cant_entrada as cant_entrada,i.cant_salida as cant_salida,per.nombre_persona as nombre_persona,i.stock as stock,d.fecha,m.nombre_medida,i.unidades as unidades  FROM inventario i LEFT JOIN producto p on i.id_prod_fk=p.id_prod LEFT JOIN persona per ON per.id_persona=i.id_prov LEFT JOIN detalle d on d.id_prod=p.id_prod LEFT JOIN factura f on d.id_factura=f.id_factura  LEFT JOIN categoria c on p.categoria=c.id_cat  LEFT JOIN medida m on m.id_medida=p.medida WHERE f.descripcion='Compra' ";
        $query = mysqli_query( $conexion, $sql );
        $data = Array();
        while ( $a = mysqli_fetch_array( $query ) ) {


            $entrada=0;
            $salida=0;
            $stock=0;

            if($a['medida']>6 && $a['medx_unidad']==6 || $a['medida']==3 || $a['medida']==4 ){
                
            $entrada=$a['cant_entrada']/1000;
            $salida=$a['cant_salida']/1000;
            $stock=$entrada-$salida;
            
            }
            else{
            $entrada=$a['cant_entrada'];
            $salida=$a['cant_salida'];
            $stock=$entrada-$salida;
            }


               
            

            

            $data[] = array(
                '0'=>$a['id_prod'],
                '1'=>$a['nombre'],
                '2'=>$a['categoria'],
                '3'=>$a['nombre_medida'],
                '4'=>$a['precio'],
                '5'=>$a['fecha'],
                '6'=>$a['unidades'],
                '7'=>$a['nombre_persona'],
                '8'=>$entrada,
                '9'=>$salida,
                '10'=>$stock
   
            );
        }
        $results = array(
            'sEcho'=>1, //info para datatables
            'iTotalRecords'=>count( $data ), //enviamos el total de registros al datatable
            'iTotalDisplayRecords'=>count( $data ), //enviamos el total de registros a visualizar
            'aaData'=>$data );
            echo json_encode( $results );

        }

        ?>