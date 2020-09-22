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
*
* @abstract TCPDF - Example: Default Header and Footer
* @author Nicola Asuni
* @since 2008-03-04
*/

require_once 'tcpdf_include.php';


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetCreator(PDF_CREATOR);
$sql = Conexion::conectar()->prepare("SELECT num_fac  FROM detalle ORDER BY num_fac DESC LIMIT 1");
$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $resultado) {
    $a = $resultado['num_fac'];
}



$respuesta = VentasController::imprimirVentasController($a);

foreach ($respuesta as $key) {
    $num_fac = $key['num_fac'];
}

$query = Conexion::conectar()->prepare("SELECT *  FROM factura fa
    JOIN persona p ON p.id_persona=fa.id_persona JOIN administrador a on fa.id_admin=a.id_admin
    WHERE num_fac=$num_fac");

$query->execute();
$resu = $query->fetchAll();
$id_admin=0;

foreach ($resu as $r) {
    $id_admin=$r['id_admin'];
}


$consulta = Conexion::conectar()->prepare("SELECT *FROM administrador as  a INNER JOIN persona as  p on a.id_persona=p.id_persona WHERE id_admin='$id_admin'");
$consulta->execute();
$resultado=$consulta->fetchAll();

foreach ($resultado as $r) {
    $id_admin=$r['id_admin'];
    $admin = $r['nombre_persona']." ".$r['apellido'];
}






$sql = Conexion::conectar()->prepare("SELECT num_fac FROM detalle WHERE num_fac = $num_fac");
$sql->execute();
$result = $sql->fetchAll();


foreach ($result as $value) {

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . '  ' . $value['num_fac'], PDF_HEADER_STRING, array(5, 64, 255), array(9, 64, 128));
}
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


$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));



$html = <<<EOD
<div  style="border: 3px solid #c9c9c9">
<table>
<tr>
<td style="width:540px"> Cliente: $key[nombre_persona]   $key[apellido]</td>
</tr>
<tr>
<td style="width:540px"> Direccion: $key[domicilio]</td>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
<td style="width:540px">  Tipo Factura : $key[tipo_fac]</td>
</tr>
<tr>
<td style="width:540px">  Vendedor : $admin</td>
</tr>
<tr>
<td width="200px"></td>

<td width="200px"></td>
</tr>
</table>
</div>
<table>
<tr>
<td></td>
</tr>
</table>

<table style="border: 1px solid #4AA0F1; text-align:center; line-height: 20px; font-size:23px">
<tr>
<td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Producto</td>
<td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Cantidad</td>
<td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Precio</td>
<td style="border: 1px solid #666; background-color:#4AA0F1; color:#fff">Importe</td>
</tr>
</table>
EOD;


$num_fac = $key['num_fac'];
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$sql = Conexion::conectar()->prepare("SELECT * FROM detalle de JOIN producto pro ON de.id_prod=pro.id_prod WHERE num_fac = $num_fac");

$sql->execute();
$result = $sql->fetchAll();

foreach ($result as $item) {

    $total =+ $item[total];
    $html2 = <<<EOF

    <table style="border: 1px solid #333; text-align:center; line-height: 20px; font-size:18px">
    <tr>
    <td style="border: 1px solid #666;"> $item[nombre]</td>
    <td style="border: 1px solid #666;"> $item[cantidad]</td>
    <td style="border: 1px solid #666;"> $item[precio_unitario]</td>
    <td style="border: 1px solid #666;"> $item[total]</td>

    </tr>
    </table>
    EOF;


    
    $pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);
    
}


$iva = $total*21/100;
$iva = number_format($iva, 2, ',', ' ');
$subTotal = $total - $iva;
$subTotal = number_format($subTotal, 2, ',', ' ');
$total = number_format($total, 2, ',', ' ');
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
<table>
<tr>
<td></td>
</tr>
</table>


<table style="text-align:center; font-size:20px;background-color:#DD4B39; color:#fff;">
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
$pdf->Output('Factura Nro: ' . ' ' . $key['num_fac'] . ' ' . $key['nombre_persona'] . '.pdf', 'I');

}

}

$a = new ImprimirVentas();
$a->imprimirDetalles();
