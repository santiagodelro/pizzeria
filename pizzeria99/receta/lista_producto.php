<?php 

include '../conexion/conexion.php';

$conexion=conexion();


$query="SELECT * FROM producto INNER JOIN categoria  on producto.categoria=categoria.id_cat  WHERE nombre_cat='Receta' ";

$consulta=mysqli_query($conexion,$query);

$lista="<option value='0' >Opciones</option>";
echo $lista;


while ($fila=mysqli_fetch_array($consulta)) {
	
	if (!ValidarProducto($fila['id_prod'],$conexion) ) {
		
		$lista="<option value='$fila[id_prod]' >$fila[nombre]</option>";
		echo $lista;	
	}	
}





function ValidarProducto($producto,$conexion)
{
	$sql="SELECT * FROM receta ";
	$query=mysqli_query($conexion,$sql);
	while ($fila=mysqli_fetch_array($query)) {
		if ($fila['producto']==$producto) {
			return true;
		}
		
	}
	return false;
}


















?>