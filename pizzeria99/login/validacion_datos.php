<?php 
include '../conexion/conexion.php';
$conexion=conexion();
$usuario=$_POST['usuario'];
$email=$_POST['email'];
$json= array();

if (!Validar_Datos('administrador','usuario',$usuario,$conexion) && !Validar_Datos('persona','email',$email,$conexion)){
	$json[]=array('response'=>'ok');
}
else if (Validar_Datos('administrador','usuario',$usuario,$conexion) && Validar_Datos('persona','email',$email,$conexion)){
	$json[]=array('response'=>'registrado');
}
else if (Validar_Datos('persona','email',$email,$conexion)) {
	$json[]=array('response'=>'emailexist');
}
else if (Validar_Datos('administrador','usuario',$usuario,$conexion)){
	$json[]=array('response'=>'userexist');
}

function Validar_Datos($tabla,$campo,$variable,$conexion)
{
	$sql="SELECT COUNT(*) As contar FROM $tabla WHERE  $campo='$variable' ";
	$query=mysqli_query($conexion,$sql);
	$array=mysqli_fetch_array($query);
	if ($array['contar']>0) {
		return true;
	}else{
		return false;
	}
}

$jsonstring=json_encode($json);
echo $jsonstring;


















?>