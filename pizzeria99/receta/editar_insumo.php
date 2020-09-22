<?php 

include '../conexion/conexion.php';
$producto=$_POST['producto'];
$id=$_POST['id'];
$conexion=conexion();
ObtenerOption($id,$conexion);

$data = json_decode($_POST['array']);
var_dump($data);

$query="SELECT * FROM producto ";

$consulta=mysqli_query($conexion,$query);


while ($fila=mysqli_fetch_array($consulta)) {
	$flag=false;
	
	for ($i=0; $i < count($data); $i++) { 
		if ($data[$i]==$fila['id_prod']) {
			$flag=true;
		}
	}

	if (!$flag) {
		$lista="<option value='$fila[id_prod]'>$fila[nombre]</option>";
		echo $lista;
	}

}


function ObtenerOption($id,$conexion)
{
	$sql="SELECT *FROM producto WHERE id_prod='$id'";
	$query=mysqli_query($conexion,$sql);

	while ($fila=mysqli_fetch_array($query)) {
		$lista="<option value='$fila[id_prod]'>$fila[nombre]</option>";
		echo $lista;
	}
}


















?>