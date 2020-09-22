<?php 
require '../conexion/conexion.php';
$conexion=conexion();
session_start();

$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

$sql="SELECT * FROM administrador WHERE usuario='$usuario' and password='$clave'";

$query=mysqli_query($conexion,$sql);
$array=mysqli_num_rows($query);
$json = array();

if ($array>0) {
	while ($fila=mysqli_fetch_array($query)) {
		$_SESSION['id_admin']=$fila['id_admin'];
	}
	
	$_SESSION['username']=$usuario;
	
	$json[]=array(
		'response' =>"ok"
	);

}
else{
	$json[]=array(
		'response' =>"fail"
	);
}

$jsonstring=json_encode($json);

echo $jsonstring;














?>