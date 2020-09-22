<?php 

include '../conexion/conexion.php';

$conexion=conexion();

$query=" SELECT DISTINCTROW(nombre),r.producto  FROM receta as r INNER JOIN producto as p ON r.producto=p.id_prod ";

$consulta=mysqli_query($conexion,$query);


$lista = "<option value='0'>Opciones</option>";
echo $lista;

while ($fila=mysqli_fetch_array($consulta)) {

    $lista="<option value='$fila[producto]' nombre='$fila[nombre]' >$fila[nombre]</option>";
    
    echo $lista;
}

















?>