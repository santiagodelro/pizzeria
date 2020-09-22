<?php
ob_clean();
require_once "../../VentasController.php";
require_once "../../ventasModel.php";
require_once '../../conexion.php';

class ImprimirVentas
{

    public function imprimirDetalles()
    {

/**
* Creates an example PDF TEST document using TCPDF
* @package com.tecnick.tcpdf
* @abstract TCPDF - Example: Default Header and Footer
* @author Nicola Asuni
* @since 2008-03-04
*/


require_once 'tcpdf_include.php';


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetCreator(PDF_CREATOR);


$numFac = $_GET['numFac'];
$sql = Conexion::conectar()->prepare("SELECT *  FROM factura fa
    JOIN persona p ON p.id_persona=fa.id_persona JOIN administrador a on fa.id_admin=a.id_admin
    WHERE numero_factura=$numFac");

$sql->execute();
$result = $sql->fetchAll();
$admin='';

$id_admin=0;

foreach ($result as $r) {
    $id_admin=$r['id_admin'];
}


$consulta = Conexion::conectar()->prepare("SELECT *FROM administrador as  a INNER JOIN persona as  p on a.id_persona=p.id_persona WHERE id_admin='$id_admin'");
$consulta->execute();
$resultado=$consulta->fetchAll();

foreach ($resultado as $r) {
    $admin = $r['nombre_persona']." ".$r['apellido'];
}








foreach ($result as $resultado) {
    $fecha = $resultado['fecha'];
    $fechas = date('d-m-Y', strtotime($fecha));
    define('PDF_HEADER_STRINGT', " Pizzeria Don Pepe \n Fecha: $fechas  \n Iva Habilitado : $iva \n");

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '  ' . $numFac, PDF_HEADER_STRINGT, array(5, 64, 255), array(9, 64, 128));
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));


    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


    if (@file_exists(dirname(__FILE__) . '/lang/spa.php')) {
        require_once dirname(__FILE__) . '/lang/spa.php';
        $pdf->setLanguageArray($l);

    }


    $pdf->setFontSubsetting(true);


    $pdf->SetFont('', '', 12, '', true);


    $pdf->AddPage();


    $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 2, 'blend_mode' => 'Normal'));



    $html = <<<EOD
    <div  style="border: 1px solid #c9c9c9">
    <table>
    <tr>
    <td style="width:540px"> Cliente: $resultado[nombre_persona]  $resultado[apellido]</td>
    </tr>
    <tr>
    <td style="width:540px"> Direccion: $resultado[domicilio]</td>
    </tr>
    <tr>
    <td style="width:540px"> Tipo Factura : $resultado[tipo_fac]</td>
    </tr>
    <tr>
    <td style="width:540px"> Vendedor : $admin</td>
    </tr>
    </table>
    </div>
    <table>
    <tr>
    <td></td>
    </tr>
    </table>

    <table style="border: 1px solid #4AA0F1; text-align:center; line-height: 20px; font-size:15px">
    <tr>
    <td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Producto</td>
    <td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Cantidad</td>
    <td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Precio</td>
    <td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Importe</td>
    </tr>
    </table>
    EOD;

}
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$sql = Conexion::conectar()->prepare("SELECT * FROM detalle de JOIN producto pro ON de.id_prod=pro.id_prod WHERE numero_factura = $numFac");
$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $item) {
    $total = $total + $item['total'];

    

    if (getmedida($item['id_prod'])==2 || getmedida($item['id_prod'])==6) {
        $subTotal+=$item['precio_unitario'];
    
    }
    else{
    $subTotal+=$item['precio_unitario']*$item['cantidad'];

    }

    $html2 = <<<EOF
    <table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:13px">
    <tr>
    <td style="border: 1px solid #666;">$item[nombre]</td>
    <td style="border: 1px solid #666;">$item[cantidad]</td>
    <td style="border: 1px solid #666;">$item[precio_unitario]</td>
    <td style="border: 1px solid #666;">$item[total]</td>
    </tr>
    </table>

    EOF;


    $pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);

}

// ---------------------------------------------------------
$iva = $total*21/100;
$iva = number_format($iva, 2, ',', ' ');
$subTotal = number_format($subTotal, 2, ',', ' ');
$total = number_format($total+$iva, 2, ',', ' ');
$html3 = <<<EOD
<div  style="border: 1px solid #c9c9c9;padding:10px">


<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>

<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>
<table>
<tr>
<td></td>
</tr>
</table>

<table style="text-align:center; font-size:20px;background-color:#F85833; color:#fff;">
<tr>
<td></td>
<td>SUBTOTAL :</td>
<td>$ $subTotal</td>
</tr>
<tr>
<td></td>
<td>IVA(21%) :</td>
<td>$ $iva</td>
</tr>
<tr>
<td></td>
<td>TOTAL :</td>
<td>$ $total</td>
</tr>
</table>

</div>
<table style="text-align:center; font-size:7px;background-color:#3895F4; color:#fff;">
<tr>
<td><h2>Haga su pedido online www.pizzeriadonpepe.es</h2></td>
</tr>
</table>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html3, 0, 1, 0, true, '', true);


Ob_end_clean();
$pdf->Output('Factura Nro: ' . ' ' . $resultado['numero_factura'] . ' ' . $resultado['nombre_persona'] . '.pdf', 'I');


}

}

function GetMedida($id){
    $sql = Conexion::conectar()->prepare("SELECT *  FROM producto
    WHERE id_prod=$id");
    $sql->execute();
    $result = $sql->fetchAll();
    foreach ($result as $r) {
        return $r['medida'];
    }   

}

$a = new ImprimirVentas();
$a->imprimirDetalles();
