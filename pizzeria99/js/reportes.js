$(document).ready(function (e) {
	var tabla;
	var compraventa;
	compraventa=($("#compraventa").val()=='ventas'?'ventasfecha':'comprasfecha');
	init();

	if(compraventa!=" "){
		$("#reportes").addClass("menu-open");

	}
	

	
	//funcion que se ejecuta al inicio
	function init(){
	   listar();
	   $("#fecha_inicio").change(listar);
	   $("#fecha_fin").change(listar);
	}
	
	//funcion listar
	function listar(){
		var  fecha_inicio = $("#fecha_inicio").val();
		var fecha_fin = $("#fecha_fin").val();
		tabla=$('#tbllistado').DataTable({
			"bDeferRender": false,
		"autoWidth": false,
		"responsive": true,			
			"ajax":
			{
				url:'consultasajax.php?op='+compraventa,
				data:{fecha_inicio:fecha_inicio,fecha_fin:fecha_fin},
				type: "get",
				dataType : "json",
				error:function(e){
					console.log(e.responseText);
				}
			},
			
			"bDestroy":true,
			"iDisplayLength":5,//paginacion
			"order":[[0,"desc"]]//ordenar (columna, orden),
			,"oLanguage": {
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
	}
	
	$(document).on('click', '#ver_factura', function () {
		let fila=$(this);
		let elemento=$(this).closest("tr");
		let num_fac = parseInt(elemento.find("td:eq(0)").text());
		window.open('../venta/tcpdf/pdf/factura.php?numFac=' + num_fac, "Factura", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=800 ,left=220");
	
	
	});

//_eliminar factura___________________________________________________________
$(document).on("click", "#eliminar_factura", function () {
	
	if (confirm('Estas seguro?')) {

		let fila=$(this);
		let elemento=$(this).closest("tr");
		let num_fac = parseInt(elemento.find("td:eq(0)").text());
		console.log(num_fac);
		$.get('consultasajax.php?op=eliminarfactura', {num_fac}, function (response) {
			let res = JSON.parse(response);
			console.log(response);
			res.forEach(res => {
				if (res.respuesta == "ok") {
					toastr.success('Eliminado Correctamente');
					tabla.row(fila.parents("tr")).remove().draw();
				}
				else if (res.respuesta == "fail") {
					toastr.error('fallo al intentar eliminar ', 'Hubo un error');
				}
			});
		});
	}

});


var data = $('#example').DataTable({
	"bDeferRender": false,
	"autoWidth": false,
	"responsive": true,
	"sPaginationType": "full_numbers",
	"ajax":
			{
				url:'consultasajax.php?op='+'stock',
				type: "get",
				dataType : "json",
				error:function(e){
					console.log(e.responseText);
				}
	},
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


	
});
