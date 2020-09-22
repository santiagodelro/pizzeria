<?php 

include '../conexion/conexion.php';
include '../cliente/script.php';

$conexion=conexion();

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$fecha=$_POST['fecha'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$usuario=$_POST['usuario'];
$clave=$_POST['clave'];
$email=$_POST['email'];
$tipo=ObtenerIdCategoria('administrador',$conexion);

if (!Insertar($email,$nombre,$apellido,$telefono,$direccion,$fecha,$tipo,$conexion)) {
	$respuesta="fail";	
}
else{
	$respuesta="ok";
	$consu="SELECT MAX(id_persona) as id FROM persona ";
	$res=mysqli_query($conexion,$consu);

	$id_persona='';

	while ($array=mysqli_fetch_array($res)) {
		$id_persona=$array['id'];
	}

	$con="INSERT INTO administrador (usuario,password,id_persona) VALUES ('$usuario','$clave','$id_persona')";
	$re=mysqli_query($conexion,$con);

	echo $id_persona;

}























?>