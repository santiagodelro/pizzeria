$(document).ready(function (e) {
	//lista_categoria();

	var editar = false;


	if ($("#cat").val() == "cliente") {
		$("#categoria").addClass("menu-open");

	}

	var data = $('#example').DataTable({
		"bDeferRender": false,
		"autoWidth": false,
		"responsive": true,
		"sPaginationType": "full_numbers",
		"ajax": {
			"url": "lista_categoria.php",
		},
		"columns": [
			{ "data": "id_tipo" },
			{ "data": "descripcion" },
			{ "defaultContent": "<button class='btn bg-orange btn-sm float-right '  id='editar' data-toggle='modal' data-target='#modal-default' style='width:40px'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-right' id='eliminar' style='width:40px'><i class='fa fa-trash'></i></button>" },

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
						data.row(fila.parents("tr")).remove().draw();
						toastr.success('Eliminado Correctamente');
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
		let elemento = $(this).closest("tr");

		let id = parseInt(elemento.find("td:eq(0)").text());
		console.log(id);

		$.post('obtener_datos.php', { id }, function (response) {
			const categoria = JSON.parse(response);
			$("#idcat").val(categoria.id_tipo);
			$("#nombre").val(categoria.descripcion);

		});
	});


	// agregar__________________________________________________________

	$("#form").submit(function (e) {
		e.preventDefault();
		let nombre = $("#nombre").val();

		if (isNaN(nombre)) {



			const datos = {
				id: $("#idcat").val(),
				nombre: $("#nombre").val()
			};

			let url = editar == false ? "agregar.php" : "editar.php";

			$.post(url, datos, function (response) {
				console.log(response);

				if (url == "agregar.php") {
					let res = JSON.parse(response);

					res.forEach(res => {
						if (res.respuesta == "ok") {
							toastr.success('Registrado Correctamente');
						}
						else if (res.respuesta == "fail") {
							toastr.error('Categoria existente', 'Hubo un error');
						}
					});
					$("#form").trigger('reset');

				}
				if (url == "editar.php") {
					let res = JSON.parse(response);
					data.ajax.reload(null, false);
					res.forEach(res => {
						if (res.respuesta == "ok") {
							toastr.success('Actualizado Correctamente');
						}
						else if (res.respuesta == "fail") {
							toastr.error('Categoria existente', 'Hubo un error');
						}
					});
					$("#form").trigger('reset');

				}

			});
		} else {
			toastr.error('Nombre invalido', 'Hubo un error');
		}
	});

















});

