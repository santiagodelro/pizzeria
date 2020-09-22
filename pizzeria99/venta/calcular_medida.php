<?php 

include '../conexion/conexion.php';
$medida=$_POST['medida'];
$conexion=conexion();
$medida1=0;
$medid2=0;
$medida=(ObtenerId($_POST['medida'],$conexion)>6?'flag':$medida);

switch ($medida) {
	case 'Gramos':
		$medida1=2;
		$medida2=3;
	break;

	case 'Kg':
		$medida1=2;
		$medida2=3;
	break;
	case 'Mililitro':
		$medida1=6;
		$medida2=4;
	break;

	case 'Litro':
		$medida1=6;
		$medida2=4;
	break;

	case 'flag':
		$medida2=ObtenerId($_POST['medida'],$conexion);
		$medida1=1;
	break;

	case 'Unidad':
		$medida1=1;
	break;
}

$query="SELECT * FROM medida WHERE id_medida='$medida1' OR id_medida='$medida2'";
$consulta=mysqli_query($conexion,$query);

$lista = '';


while ($fila=mysqli_fetch_array($consulta)) {
	
	$lista="<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";

	echo $lista;
	
}






function ObtenerId($nombre,$conexion)
{
	$sql="SELECT *FROM medida WHERE nombre_medida='$nombre'";
	$query=mysqli_query($conexion,$sql);

	while ($fila=mysqli_fetch_array($query)) {
		return $fila['id_medida'];
		
	}
}














?>