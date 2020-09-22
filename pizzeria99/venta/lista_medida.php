<?php 

include '../conexion/conexion.php';
$conexion=conexion();
$id = $_POST['id'];
$medida1=0;
$medid2=0;


switch ($id) {
	case 2:
		$medida1=2;
		$medida1=3;
	break;

	case 3:
		$medida1=2;
		$medida1=3;
	break;
	case 6:
		$medida1=6;
		$medida1=4;
	break;

	case 6:
		$medida1=6;
		$medida1=4;
	break;
}



$query="SELECT * FROM medida WHERE id_medida='$medida1' OR id_medida='$medida2'"; 
$consulta=mysqli_query($conexion,$query);

$lista = '';

while ($fila=mysqli_fetch_array($consulta)) {

	if ($id) {
		ObtenerValorSelect($conexion,$id);
		}
	$id=false;
	$lista="<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";

	
	echo $lista;
	
	
}

function ObtenerValorSelect( $conexion, $id )
 {
    $sql = "SELECT *FROM medida WHERE id_medida='$id'";
    $query = mysqli_query( $conexion, $sql );
    while ( $fila = mysqli_fetch_array( $query ) ) {
        $lista = "<option value='$fila[id_medida]'>$fila[nombre_medida]</option>";
        echo $lista;
	}
	

}




















?>