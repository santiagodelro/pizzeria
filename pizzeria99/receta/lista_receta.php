<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$id_prod=$_POST['id'];

$query="Select
r.insumo 
,r.id_receta 
,r.producto
,nm.nombre_medida AS nombrem
, np.nombre As nombrep
, ni.nombre As nombrei
,r.cantidad
,r.medida
From
receta As r

Inner Join
producto As np
On r.producto= np.id_prod

Inner Join
producto As ni
On r.insumo = ni.id_prod 

Inner Join
medida As nm 
On r.medida=nm.id_medida   WHERE r.producto=$id_prod"

;

$consulta=mysqli_query($conexion,$query);


$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

    $json[]=array(
        'id_prod' =>$fila['producto'] ,
        'cantidad' =>$fila['cantidad'],
        'nombrep'=>$fila['nombrep'],
        'nombrei'=>$fila['nombrei'],
        'medida'=>$fila['nombrem'],
        'id_receta'=>$fila['id_receta'],
        'id_insumo'=>$fila['insumo']


    );
}

$jsonstring=json_encode($json);

echo $jsonstring;



















?>