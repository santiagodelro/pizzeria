$(document).ready(function (e) {
	
	
	$("#edit").show();
	
	if($("#on").val()=="venta"){
		$("#venta").addClass("menu-open");

	}

	
	var data=$('#example').DataTable( {	
		"bDeferRender": false,
		"autoWidth": false,
		"responsive": true,			
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "lista_cliente.php",
			"type": "POST"
		},					
		"columns": [
		{ "data": "id_persona" },
		{ "data": "nombre" },
		{ "data": "apellido" },
		{ "data": "domicilio" },
		{ "data": "telefono" },
		{ "data": "fecha_nac" },
		{"defaultContent": "<button class='btn bg-orange btn-sm float-left '  id='editar' data-toggle='modal' data-target='#modal-default' style='width:40px'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-center' id='eliminar' style='width:40px'><i class='fa fa-trash'></i></button>"},			

		],
		"oLanguage": {
			"sProcessing":     "Procesando...",
			"sLengthMenu": 'Mostrar <select>'+
			'<option value="10">10</option>'+
			'<option value="20">20</option>'+
			'<option value="30">30</option>'+
			'<option value="40">40</option>'+
			'<option value="50">50</option>'+
			'<option value="-1">All</option>'+
			'</select> registros',    
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Por favor espere - cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
	
	

	
	//_eliminar___________________________________________________________
	$(document).on("click","#eliminar", function(){
		
		if(confirm('Estas seguro?')){
			let fila=$(this);
			let elemento=$(this).closest("tr");
			let id=parseInt(elemento.find("td:eq(0)").text());
			console.log(id);
			var res='';
			$.post('eliminar.php',{id},function(response){	
				let res=JSON.parse(response);
				res.forEach(res=>{
					if (res.respuesta=="ok") {
						data.row(fila.parents("tr")).remove().draw();
						toastr.success('Eliminado Correctamente');
					}
					else if (res.respuesta=="fail"){
						toastr.error('fallo al intentar eliminar ','Hubo un error');
					}
					else if (res.respuesta=="existeregistro"){
						toastr.error('Registro existente,no se puede eliminar','Hubo un error');
					}
				});
			});
		}
		
	});



	//actualizar informacion______________________________________________________________

	$(document).on('click','#editar',function () {

		editar=true;
		let elemento=$(this).closest("tr");
		
		let id=parseInt(elemento.find("td:eq(0)").text());
		console.log(id);

		$.post('obtener_datos.php',{id},function (response) {
			const persona=JSON.parse(response);
			$("#idpe_edit").val(persona.id_persona);
			$("#nombre_edit").val(persona.nombre);
			$("#apellido_edit").val(persona.apellido);
			$("#telefono_edit").val(persona.telefono);
			$("#domicilio_edit").val(persona.domicilio);
			$("#fecha_edit").val(persona.fechanac);
			$("#email_edit").val(persona.email);

		});
	});


	// agregar__________________________________________________________

	$("#form").submit(function (e) {
		
		let nombre=$("#nombre").val();
		let apellido=$("#apellido").val();
		let domicilio=$("#domicilio").val();

		e.preventDefault();

		if ( isNaN(nombre) && isNaN(apellido) && isNaN(domicilio)) {
			
	
		const datos={
			id:$("#idpe").val(),
			nombre:$("#nombre").val(),
			apellido:$("#apellido").val(),
			telefono:$("#telefono").val(),
			domicilio:$("#domicilio").val(),
			fecha:$("#fecha").val(),
			email:$("#email").val()
		};

		$.post('agregar.php',datos,function (response) {
			let res=JSON.parse(response);
			data.ajax.reload(null, false);
			res.forEach(res=>{
				if (res.respuesta=="ok") {
					toastr.success('Registrado Correctamente');
				}
				else if (res.respuesta=="fail"){
					toastr.error('fallo al registrarse','Hubo un error');
				}
			});
			$("#form").trigger('reset');
		});
	} else {
		toastr.error('Datos invalidos','Hubo un error');
			
	}
	});



	$("#form_edit").submit(function (e) {

		e.preventDefault();

		const datos={
			id:$("#idpe_edit").val(),
			nombre:$("#nombre_edit").val(),
			apellido:$("#apellido_edit").val(),
			telefono:$("#telefono_edit").val(),
			domicilio:$("#domicilio_edit").val(),
			fecha:$("#fecha_edit").val(),
			email:$("#email_edit").val()
		};

		$.post('editar.php',datos,function (response) {
			let res=JSON.parse(response);
			data.ajax.reload(null, false);
			res.forEach(res=>{
				if (res.respuesta=="ok") {
					toastr.success('Actualizado Correctamente');
				}
				else if (res.respuesta=="fail"){
					toastr.error('fallo al intentar actualizar','Hubo un error');
				}
			});
			$("#form_edit").trigger('reset');
		});
		
		
	});





});









