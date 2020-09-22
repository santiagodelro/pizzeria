
<?php 

include '../conexion/conexion.php';


$conexion=conexion();

$query="SELECT *FROM  categoria";

$consulta=mysqli_query($conexion,$query);

$data = Array();




while ( $a = mysqli_fetch_array( $consulta ) ) {

	if ($a['id_cat']>5) {
	$button="<button class='btn bg-orange btn-sm float-right '   id='editar' data-toggle='modal' data-target='#nueva_categoria' style='width:40px'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-right'   id='eliminar' style='width:40px'><i class='fa fa-trash'></i></button>";
		
	} else {
	$button="<button class='btn bg-orange btn-sm float-right ' disabled=''  id='editar' data-toggle='modal' data-target='#nueva_categoria' style='width:40px'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-right'  disabled='' id='eliminar' style='width:40px'><i class='fa fa-trash'></i></button>";
		
	}
        $data[] = array(
            '0'=>$a['id_cat'],
            '1'=>$a['nombre_cat'],
            '2'=>$button
		);  
 }

 $results = array(
	'iTotalRecords'=>count( $data ), //enviamos el total de registros al datatable
	'iTotalDisplayRecords'=>count( $data ), //enviamos el total de registros a visualizar
	'aaData'=>$data );

	echo json_encode( $results );








?>