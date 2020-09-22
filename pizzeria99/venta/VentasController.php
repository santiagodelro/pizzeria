<?php

class VentasController
{

    public static function getFecturaController()
    {
        $respuesta = VentasModel::getFacturaModel('detalle');

        return $respuesta;

    }



    public static function getTempController()
    {
        $respuesta = VentasModel::getTempModel('temp');

        return $respuesta;

    }



    public function agregarVentaController()
    {
        if (isset($_POST['confirmar'])) {
            $datosController = array(
                'id_producto' => $_POST['id_producto'],
                'nombre_producto' => $_POST['nombre_producto'],
                'id_persona' => $_POST['id_persona'],
                'precio_venta' => $_POST['precio_venta'],
                'cantidad' => $_POST['cantidad'],
                'iva' => $_POST['iva'],
                'total_venta' => $_POST['total_venta'],
                'num_fac' => $_POST['num_fac'],
                'fecha_venta' => date('Y-m-d ', strtotime($_POST['fecha_venta'])),
                'medida' => $_POST['unidad'],
                'tipo_fac' => $_POST['tipo_fac'],
            );

            $respuesta = VentasModel::registroFacturaModel($datosController, 'temp');
            if ($respuesta == 'no') {
                require 'noInventario.php';
            }
            if ($respuesta == 'noCliente') {
                require 'noCliente.php';
            }
            if ($respuesta == 'noFacturaTipo') {
                require 'noFacturaTipo.php';
            }
            if ($respuesta == 'success') {
                header('location:okVentas');
            }
        }
    }



    public function borrarVentasController()
    {
        if (isset($_GET['id_temp'])) {
            $datosController = $_GET['id_temp'];
            $datosControl = $_GET['id_producto'];
            $unidad = $_GET['medida'];
            $respuesta = VentasModel::borrarVentasModel($datosController, $datosControl, $unidad, 'temp');

            if ($respuesta == 'success') {
                header('location:okBorradoVentas');
            }
        }
    }


    public function registrarVentasDetallesControllers()
    {
        if (isset($_POST['enviarDetalles'])) {
            $idAdmin = $_POST['id_admin'];
            $numFac = $_POST['num_fac'];
            $respuesta = VentasModel::registrarVentasDetallesModel($datosController, 'detalle_venta', $idAdmin, $numFac);
            if ($respuesta == 'success') {
                header('location:ventas');
            }
        }
    }


    public static function imprimirVentasController($numFac)
    {
    // $datosController = $datos;
        $numFactura = $numFac;
        $respuesta = VentasModel::imprimirVentasModel($numFactura);
        return $respuesta;
    }


    public static function getVentasController()
    {

        $respuesta = VentasModel::getVentasModel('factura');
        return $respuesta;
    }


    public function borrarFacturaController()
    {
        if (isset($_GET['deleteFactura'])) {
            $datosController = $_GET['deleteFactura'];

            $respuesta = VentasModel::borrarFacturaModel($datosController, 'factura');

            if ($respuesta == 'success') {
                header('location:okBorradoFactura');
            }
        }
    }

    public static function ventasDiariasController()
    {
        if (isset($_POST['ventaDiarias'])) {
            $datosController = $_POST['fecha'];
            $respuesta = VentasModel::ventasDiariasModel($datosController, 'detalle_venta');
            return $respuesta;
        }
    }

}
