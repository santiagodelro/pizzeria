<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$query="SELECT * FROM temp"; 
$consulta=mysqli_query($conexion,$query);
$total=0;
$totaliva=0;
$subtotal=0;

while ($fila=mysqli_fetch_array($consulta)) {

    if ( $fila['medida'] == 2 || $fila['medida'] == 6 ) {
       
        $subtotal+=$fila['precio_unitario'];
    } else {
        $subtotal+=$fila['precio_unitario']*$fila['cantidad'];

    }
    $total+=$fila['total'];
    $totaliva+=$fila['total']*$fila['impuesto']/100;
   

	$json[]=array(
        'subtotal'=>$subtotal,
        'total'=>$total,
        'totaliva'=>$totaliva
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;





















?>