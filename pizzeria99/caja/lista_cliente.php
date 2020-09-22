<?php 

include '../conexion/conexion.php';

$conexion=conexion();

$query="SELECT * FROM persona p INNER JOIN tipo_persona t on  t.id_tipo=p.id_tipo WHERE descripcion='administrador'";
$consulta=mysqli_query($conexion,$query);

while ($fila=mysqli_fetch_array($consulta)) {

	$lista="<option value='$fila[id_persona]'>$fila[nombre_persona] $fila[apellido]</option>";
	
	echo $lista;
}






?>