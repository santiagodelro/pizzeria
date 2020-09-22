<?php 

include '../conexion/conexion.php';

$conexion=conexion();

$query="SELECT * FROM persona INNER JOIN tipo_persona  on tipo_persona.id_tipo=persona.id_tipo";
$consulta=mysqli_query($conexion,$query);

while ($fila=mysqli_fetch_array($consulta)) {

	$lista="<option value='$fila[id_persona]'>$fila[nombre_persona]</option>";
	
	echo $lista;
}






?>