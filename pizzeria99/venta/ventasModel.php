
<?php
// require_once 'models/conexion.php';
class VentasModel
{

    public static function getFacturaModel($tabla)
    {

        $sql = Conexion::conectar()->prepare("SELECT MAX(numero_factura) AS total FROM $tabla  ");
        $sql->execute();
        return $sql->fetchAll();

        $sql->close();
    }

    public static function getTempModel($tabla)
    {

        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla 
         JOIN producto  ON producto.id_prod = temp.id_prod
         JOIN persona  ON temp.id_persona = persona.id_persona ");
        $sql->execute();
        return $sql->fetchAll();

        $sql->close();
    }

    public static function registroFacturaModel($datosModel, $tabla)
    {

        $sql = Conexion::conectar()->prepare("INSERT INTO   $tabla(id_prod,id_persona,precio_venta,cantidad,iva,total_venta,num_fac,fecha_venta,medida,tipo_fac)VALUES
            (:id_producto,:id_persona,:precio_venta,:cantidad,:iva,:total_venta,:num_fac,:fecha_venta,:medida,:tipo_fac) ");

        $sql->bindParam(':id_producto', $datosModel['id_producto']);
        $sql->bindParam(':id_persona', $datosModel['id_persona']);
        $sql->bindParam(':precio_venta', $datosModel['precio_venta']);
        $sql->bindParam(':cantidad', $datosModel['cantidad']);
        $sql->bindParam(':iva', $datosModel['iva']);
        $sql->bindParam(':total_venta', $datosModel['total_venta']);
        $sql->bindParam(':num_fac', $datosModel['num_fac']);
        $sql->bindParam(':fecha_venta', $datosModel['fecha_venta']);
        $sql->bindParam(':medida', $datosModel['medida']);
        $sql->bindParam(':tipo_fac', $datosModel['tipo_fac']);

        //
        // verifica el stock
        $idProducto = $datosModel['id_producto'];
        $stock = Conexion::conectar()->prepare("SELECT * FROM producto 
            WHERE id_prod = $idProducto");
        $stock->execute();
        $resultado = $stock->fetchAll();
        
        foreach ($resultado as $key) {

            if ($key['stock'] < $datosModel['medida']) {
                return 'no';

            }
        }

        // revisa que sea el mismo cliente
        //
        //
        $cedu = Conexion::conectar()->prepare('SELECT id_persona FROM temp ');
        $cedu->execute();
        $resu = $cedu->fetch();

        if ($resu == '') {
            // actualiza el inventario
            //
            $unidad = $datosModel['medida'];
            $idProducto = $datosModel['id_producto'];
            $sql1 = Conexion::conectar()->prepare("UPDATE producto SET stock = stock - $unidad  WHERE id_prod = $idProducto");
            $sql1->execute();

            if ($sql->execute()) {
                return 'success';
            }
        }
        // revisa que sea el mismo cliente
        //
        //
        $cedulaSql = Conexion::conectar()->prepare('SELECT id_persona FROM temp
            WHERE id_persona = :id_persona ');
        $cedulaSql->execute(array(':id_persona' => $datosModel['id_persona'],
    ));
        $res = $cedulaSql->fetch();

        if (!$res) {
            return 'noCliente';

        }
        // revisa que sea el mismo tipo de factura
        //
        //
        $cedulaSql = Conexion::conectar()->prepare('SELECT tipo_fac FROM temp
            WHERE tipo_fac=:tipo_fac');
        $cedulaSql->execute(array(':tipo_fac' => $datosModel['tipo_fac']));
        $res = $cedulaSql->fetch();

        if (!$res) {
            return 'noFacturaTipo';

        }

        // // actualiza el inventario
        // //
        $unidad = $datosModel['medida'];
        $idProducto = $datosModel['id_producto'];

        $sql1 = Conexion::conectar()->prepare("UPDATE producto SET stock = stock - $unidad  WHERE id_prod = $idProducto");
        $sql1->execute();

        if ($sql->execute()) {
            return 'success';
        }

        $sql->close();
    }

    public static function borrarVentasModel($datosModel, $datosControl, $unidad, $tabla)
    {
        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_temp = :id_temp");
        $sql->bindParam(':id_temp', $datosModel);

        //
        // vuelve la venta atras.
        $sql1 = Conexion::conectar()->prepare("UPDATE producto SET stock = stock + $unidad  WHERE id_prod = $datosControl");
        $sql1->execute();

        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

    public static function registrarVentasDetallesModel($datosModel, $tabla, $idAdmin, $numFac)
    {
        $sql = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona,id_prod,fecha_venta,precio_venta,cantidad,total_venta,num_fac,tipo_fac) SELECT tem.id_persona,tem.id_prod,tem.fecha_venta,tem.precio_venta,tem.cantidad,tem.total_venta,tem.num_fac,tem.tipo_fac
            FROM temp tem ");

        if ($sql->execute()) {
            $sql = Conexion::conectar()->prepare("INSERT INTO factura( num_fac,fecha_venta,id_persona,id_admin , total_venta,tipo_fac)SELECT  MAX(det.num_fac), det.fecha_venta,det.id_persona, $idAdmin, SUM(det.total_venta),det.tipo_fac
                FROM detalle_venta det WHERE num_fac=$numFac");
            $sql->execute();
            $sql = Conexion::conectar()->prepare("DELETE FROM temp");
            $sql->execute();
            return 'success';
        }
        $sql->close();

    }

    public static function imprimirVentasModel($numFac)
    {
        $sql = Conexion::conectar()->prepare("SELECT  * FROM detalle ta
            JOIN persona per ON ta.id_persona=per.id_persona
            JOIN producto prod ON prod.id_prod=ta.id_prod_fk
            WHERE numero_factura = $numFac");
        $sql->execute();

        return $sql->fetchAll();
        $sql->close();
    }


    public static function getVentasModel($tabla)
    {
        $sql = Conexion::conectar()->prepare("SELECT  * FROM  $tabla ta
           JOIN persona per ON ta.id_persona=per.id_persona");
        $sql->execute();

        return $sql->fetchAll();
        $sql->close();
    }


    public static function borrarFacturaModel($datosModel, $tabla)
    {
        $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE num_fac = :num_fac");
        $sql->bindParam(':num_fac', $datosModel);
        if ($sql->execute()) {
            return 'success';
        }
        $sql->close();
    }

    public static function ventasDiariasModel($datosModel, $tabla)
    {
        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla ta
            JOIN persona per on per.id_persona = ta.id_persona
            JOIN producto pro on ta.id_prod = pro.id_prod

            WHERE fecha_venta = :fecha_venta");
        $sql->bindParam(':fecha_venta', $datosModel);
        $sql->execute();

        return $sql->fetchAll();
        $sql->close();
    }

}