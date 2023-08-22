var tabla;

//funcion que se ejecuta al inic io
function init() {
  mostrarform(false);
  listar();

  $("#formulario").on("submit",function(e){
    guardaryeditar(e);
  })
}

//Funcion limpiarFZ
function limpiar() {
  $("#nombre_integrantes").val("");

}

//Funcion mostrar formulario
function mostrarform(flag)
{
  limpiar();
  if(flag)
  {
    $('#listadoregistros').hide();
    $('#formularioregistros').show();
    $('#btnGuardar').prop("disabled",false);
    $("#agregarIntegrante").hide();

  }
  else {
    $('#listadoregistros').show();
    $('#formularioregistros').hide();
    $("#agregarIntegrante").show();
  }
}

//funcion cancelarform
function cancelarform()
{
  limpiar();
  mostrarform(false);


}

//function listar
function listar()
{
  tabla=$('#tbllistado').dataTable(
    {
      "aProcessing": true, //Activamos el procesamiento de datatables
      "aServerSide": true, //Paginacion y filtrado realizados por el servidor
      dom: 'Bfrtip', //Definimos los elementos del control de tabla
      buttons:[
          'copyHtml5',
          'excelHtml5',
          'csvHtml5',
          'pdf'

      ],
      "ajax":
      {
        url:'../ajax/integrantes_desarrollo.php?op=listarIntegrantes',
        type:"get",
        dataType:"json",
        error:function(e)
        {
          console.log(e.responseText);
        }

      },
      "bDestroy":true,
      "iDisplayLength" :5, //Paginacion
      "order":[[0,"desc"]] //Ordenar (columna,orden)

    }
  ).DataTable();

}

function guardaryeditar(e)
{
  e.preventDefault();// No se activara la accion predeterminada del evento
  $("#btnGuardar").prop("disabled",true);
  var formData=new FormData($("#formulario")[0]);

  $.ajax({
		url: "../ajax/integrantes_desarrollo.php?op=guardar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
			  // bootbox.alert(datos);
			
	        if(datos !="" || datos !=null){
		        swal({
				  title: "BIEN!",
				  text: "¡"+datos+"!",
				  type:"success",
				  confirmButtonText: "Cerrar",
				  closeOnConfirm: true
				},

				function(isConfirm){

					if(isConfirm){
						// history.back();
						mostrarform(false);
		          		listar();
					}
				});
	        }else{
	        	swal({
				  title: "Error!",
				  text: "¡Ocurrio un error, por favor registre nuevamente al Integrante",
				  type:"warning",
				  confirmButtonText: "Cerrar",
				  closeOnConfirm: true
				},

				function(isConfirm){

					if(isConfirm){
						location.reload(true);
					}
				});
	        }
	    }
	});
	limpiar();
}



function mostrar(idintegrant_desarrollo)
{
 $.post("../ajax/integrantes_desarrollo.php?op=mostrar",{idintegrant_desarrollo:idintegrant_desarrollo}, function(data,status)
{
    data=JSON.parse(data);
    mostrarform(true);

    $("#nombre_integrantes").val(data.nombre_integrantes);
    $("#idintegrant_desarrollo").val(data.idintegrant_desarrollo);
})
}
//funcion desactivar
function eliminar(idintegrant_desarrollo)
{
  bootbox.confirm("¿Esta seguro eliminar el tecnico",function(result)
{
  if(result)
  {
    $.post("../ajax/integrantes_desarrollo.php?op=eliminar",{idintegrant_desarrollo:idintegrant_desarrollo},function(e){
      bootbox.alert(e);
        tabla.ajax.reload();
    });
  }
})
}





init();
