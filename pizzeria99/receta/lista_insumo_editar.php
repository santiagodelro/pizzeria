<?php 

include '../conexion/conexion.php';
$producto=$_POST['producto'];
$conexion=conexion();

$query="SELECT * FROM producto INNER JOIN categoria  on producto.categoria=categoria.id_cat  ";

$consulta=mysqli_query($conexion,$query);


while ($fila=mysqli_fetch_array($consulta)) {
	
	if ($producto!=$fila['id_prod'] && !ValidarInsumo($fila['id_prod'],$producto,$conexion) ) {
		
		$lista="<option value='$fila[id_prod]' >$fila[nombre]</option>";
		echo $lista;	
	}	
}





function ValidarInsumo($value,$producto,$conexion)
{
	$sql="SELECT * FROM receta  WHERE producto='$producto'";
	$query=mysqli_query($conexion,$sql);
	while ($fila=mysqli_fetch_array($query)) {
		if ($fila['insumo']==$value) {
			return true;
		}
		
	}
	return false;
}
















?>