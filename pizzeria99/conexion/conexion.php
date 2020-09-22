
<?php 

function conexion(){

	$conexion=mysqli_connect("localhost","root","","pizzeria");

	if (!$conexion) {
		echo "Error de conexion con la base de datos!";
	}

	return $conexion;
}






?>