<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$tipo=$_POST['idm'];
 

if ($tipo==-1) {
	$query="SELECT *
FROM medida
WHERE id_medida <= 6";
} else{
	$query="SELECT *
FROM medida";
}

$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {
	$lista="<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";

	if ($tipo==$fila['id_medida'])	{
		continue;
	}
	else if($tipo!=$fila['id_medida']) {	
		echo $lista;
	}
	else if($tipo==0){
		echo $lista;
	}
	
}





















?>