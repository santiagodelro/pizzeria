<?php 
session_start();
//limpiamos la variables de la secion
session_unset();
//destruimos la sesion
session_destroy();
//redireccionamos al login
header("Location: ../index.php");
exit();

?>