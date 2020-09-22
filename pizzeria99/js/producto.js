$(document).ready(function (e) {

	var editar = false;

	if ($("#on").val() == "producto") {
		$("#producto").addClass("menu-open");

	}

	$("#cancelar").click(function () {
		LimpiarForm();
	});


	$("#cancelar_prod").click(function () {
		LimpiarFormProd();
	});


	$("#btn_add").click(function () {
		categoria(0);
		lista_medida(0);
		Titulo_Modal('agregar_articulo');
		$("#id_cat").attr('disabled', false);
		LimpiarForm();
		editar = false;
	});

	$("#btn_add_prod").click(function () {
		lista_medida(-1);
		editar = false;



	});



	$('#id_medida').select2({
		theme: 'bootstrap4'
	});


	$('#id_cat').select2({
		theme: 'bootstrap4'
	});


	$('#medida_prod').select2({
		theme: 'bootstrap4'
	});



	var data = $('#example').DataTable({
		"bDeferRender": false,
		"autoWidth": false,
		"responsive": true,
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "lista.php",
			"type": "POST"
		},
		"columns": [
			{ "data": "id_prod" },
			{ "data": "nombre" },
			{ "data": "precio" },
			{ "data": "categoria" },
			{ "data": "medida" },
			{ "defaultContent": "<button class='btn bg-orange btn-sm float-left '  id='editar' data-toggle='modal' data-target='#nuevo_articulo' style='width:40px'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-center' id='eliminar' style='width:40px'><i class='fa fa-trash'></i></button>" },

		],
		"oLanguage": {
			"sProcessing": "Procesando...",
			"sLengthMenu": 'Mostrar <select>' +
				'<option value="10">10</option>' +
				'<option value="20">20</option>' +
				'<option value="30">30</option>' +
				'<option value="40">40</option>' +
				'<option value="50">50</option>' +
				'<option value="-1">All</option>' +
				'</select> registros',
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Por favor espere - cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});




	//_eliminar___________________________________________________________
	$(document).on("click", "#eliminar", function () {

		if (confirm('Estas seguro?')) {
			let fila = $(this);
			let elemento = $(this).closest("tr");

			let id = parseInt(elemento.find("td:eq(0)").text());
			console.log(id);

			var res = '';
			$.post('eliminar.php', { id }, function (response) {
				let res = JSON.parse(response);
				console.log(response);
				res.forEach(res => {
					if (res.respuesta == "ok") {
						toastr.success('Eliminado Correctamente');
						data.row(fila.parents("tr")).remove().draw();
					}
					else if (res.respuesta == "fail") {
						toastr.error('fallo al intentar eliminar ', 'Hubo un error');
					}
				});
			});
		}
	});




	//actualizar informacion______________________________________________________________

	$(document).on('click', '#editar', function () {

		editar = true;
		Titulo_Modal('actualizar');

		let elemento = $(this).closest("tr");

		let id = parseInt(elemento.find("td:eq(0)").text());
		let id_medida = '';
		let id_categoria = '';

		$.post('get_data.php', { id }, function (response) {
			console.log(response);
			let producto = JSON.parse(response);


			producto.forEach(producto => {

				if (producto.categoria == 'Receta') {
					$("#id_cat").attr('disabled', true);
				}
				else {
					$("#id_cat").attr('disabled', false);

				}

				$("#id_prod").val(producto.id_prod);
				$("#nombre").val(producto.nombre);
				$("#precio").val(producto.precio);

				id_medida = producto.id_medida;
				id_categoria = producto.id_cat;

				let cat = `<option value="${producto.id_cat}">${producto.categoria}</option>`
				$("#id_cat").html(cat);

				let medida = `<option value="${producto.id_medida}">${producto.medida}</option>`
				$("#id_medida").html(medida);

			});

			lista_medida(id_medida);
			categoria(id_categoria);
		});
	});



	// agregar articulo__________________________________________________________

	$("#form_articulo").submit(function (e) {
		e.preventDefault();

		let nombre=$("#nombre").val();
		
		if ($("#precio").val() >0 && isNaN(nombre) ) {
			const datos = {
				id: $("#id_prod").val(),
				nombre: $("#nombre").val(),
				medida: $("#id_medida").val(),
				precio: $("#precio").val(),
				categoria: $("#id_cat").val()
			};
			console.log(datos);

			let url = editar == false ? "agregar_articulo.php" : "editar_articulo.php";


			$.post(url, datos, function (response) {
				let res = JSON.parse(response);
				data.ajax.reload(null, false);

				if (url == 'agregar_articulo.php') {
					res.forEach(res => {
						if (res.respuesta == "ok") {
							toastr.success('Registrado Correctamente');
						}
						else if (res.respuesta == "fail") {
							toastr.error('Intentas registrar un producto existente', 'Hubo un error');
						}
					});
				}
				else if (url == 'editar_articulo.php') {
					res.forEach(res => {
						if (res.respuesta == "ok") {
							toastr.success('Actualiado Correctamente');
						}
						else if (res.respuesta == "fail") {
							toastr.error('No se puedo actualizar', 'Hubo un error');
						}
					});
				}

				$("#form_articulo").trigger('reset');

			});
			LimpiarForm();
		} else {
			toastr.error('Datos invalidos', 'Hubo un error');
		}

	});




	// agregar producto elaborado__________________________________________________________

	$("#form_prod").submit(function (e) {
		e.preventDefault();
		let nombre=$("#nombre_prod").val();
		if ($("#precio_prod").val() >0 && isNaN(nombre) ) {

		const datos = {
			id: $("#id_prod").val(),
			nombre: $("#nombre_prod").val(),
			medida: $("#medida_prod").val(),
			precio: $("#precio_prod").val()
		};
		console.log(datos);


		$.post('agregar_elaborado.php', datos, function (response) {
			data.ajax.reload(null, false);
			let res = JSON.parse(response);

			res.forEach(res => {
				if (res.respuesta == "ok") {
					toastr.success('Registrado Correctamente');
				}
				else if (res.respuesta == "fail") {
					toastr.error('Intentas registrar un producto existente', 'Hubo un error');
				}
			});
			$("#form_prod").trigger('reset');
		});
	} else {
		toastr.error('Datos invalidos', 'Hubo un error');
	}

	});




});




//carga la lista de tipo  productos__________________________________

function categoria(value) {

	$.ajax({
		url: 'categoria.php',
		type: 'POST',
		data: { value },
		success: function (response) {
			if (value > 0) {
				$("#id_cat").append(response);

			} else {
				$("#id_cat").html(response);
			}
		}
	});
}

function proveedorr(idp) {

	$.ajax({
		url: 'proveedor.php',
		type: 'POST',
		data: { idp },
		success: function (response) {
			$("#prov").append(response);
		}
	});
}




function lista_medida(idm) {

	$.ajax({
		url: 'medida.php',
		type: 'POST',
		data: { idm },
		success: function (response) {

			if (idm > 0) {
				$("#id_medida").append(response);
			} else if (idm == 0) {
				$("#id_medida").html(response);
			}
			else {
				$("#medida_prod").html(response);

			}
		}
	});
}


function Titulo_Modal(opcion) {

	switch (opcion) {
		case 'agregar_articulo':
			$("#titulo_modal").html('<h4 class="modal-title " id="titulo_modal">Agregar articulo</h4>');
			break;
		case 'actualizar':
			$("#titulo_modal").html('<h4 class="modal-title " id="titulo_modal">Actualizar informacion</h4>');
			break;
	}

}


function LimpiarForm() {
	$("#id_prod").val('');
	$("#nombre").val('');
	$("#id_medida").val('');
	$("#precio").val('');
	$("#id_cat").val('');
	$("#id_cat").val('');
	categoria(0);
	lista_medida(0);

}

function LimpiarFormProd() {
	$("#nombre_prod").val('');
	$("#precio_prod").val('');
	lista_medida(-1);
}