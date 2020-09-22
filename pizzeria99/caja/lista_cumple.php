<?php 
$date1 = date("Y-m-d", strtotime($_POST['date1']));

include '../conexion/conexion.php';

$conexion=conexion();

$query="SELECT DISTINCT p.id_persona, p.nombre_persona, p.apellido, p.fecha_nac, p.telefono, p.email,s.nombre as descripcion FROM persona p 
INNER JOIN detalle d ON p.id_persona=d.id_persona INNER JOIN producto s ON d.id_prod=s.id_prod
WHERE MONTH (fecha_nac)= MONTH('$date1') AND id_tipo=16";

$consulta=mysqli_query($conexion,$query);
if(!$consulta){
    die('Error Consulta'.mysqli_error($conexion));
}
$json = array();

while ($fila=mysqli_fetch_array($consulta)) {

  $json[]=array(
    'fecha'=>$fila['fecha_nac'],
    'nombre'=>$fila['nombre_persona'],
    'apellido'=>$fila['apellido'],
    'telefono'=>$fila['telefono'],
   // 'total_cantidad'=>$fila['total_cantidad'],
    'email'=>$fila['email'],
    'descripcion'=>$fila['descripcion'],
    'id_persona'=>$fila['id_persona']

  );
}
$jsonstring=json_encode($json);

echo $jsonstring;
?>