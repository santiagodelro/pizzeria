<?php 

include '../conexion/conexion.php';
$producto=$_POST['producto'];
$conexion=conexion();

$data = json_decode($_POST['array']);
var_dump($data);

$query="SELECT * FROM producto INNER JOIN categoria  on producto.categoria=categoria.id_cat  ";

$consulta=mysqli_query($conexion,$query);


while ($fila=mysqli_fetch_array($consulta)) {
	$flag=false;
	
	for ($i=0; $i < count($data); $i++) { 
		if ($data[$i]==$fila['id_prod']) {
			$flag=true;
		}
	}

	
	$id=$fila['id_prod'];

	if (!$flag) {
		$lista="<option value='$id' >$fila[nombre]</option>";
		echo $lista;
	}

}





















?>