<?php 

include '../conexion/conexion.php';

$conexion=conexion();



//SALDO INICIAL
$query1="SELECT SUM(neto) total_costo FROM factura WHERE tipo_fac='I' ";
$consulta1=mysqli_query($conexion,$query1);

while ($fila1=mysqli_fetch_array($consulta1)) {

  $lista="<label value='0'> Saldo Inicial: $ $fila1[total_costo]</label>";
  
}

$query1="SELECT SUM(neto) as total FROM factura WHERE  descripcion='Venta'";
$consulta1=mysqli_query($conexion,$query1);

while ($fila1=mysqli_fetch_array($consulta1)) {

  $lista.="<label value='0'> Total Ventas: $ $fila1[total]</label>";
  
}
echo $lista;
////

?>