<?php 

include '../conexion/conexion.php';

$conexion=conexion();
$tipo=$_POST['value'];
$query="SELECT * FROM categoria WHERE id_cat=3 OR id_cat=4"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {
	$lista="<option value='$fila[id_cat]'>$fila[nombre_cat]</option>";

	if ($tipo==$fila['id_cat'])	{
		continue;
	}
	else if ($tipo!=$fila['id_cat']) {	
		echo $lista;
	}
	else if($tipo==0){
		echo $lista;
	}
}





















?>