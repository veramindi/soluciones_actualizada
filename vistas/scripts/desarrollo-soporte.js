var tabla;

//funcion que se ejecuta al inicio
function init() {
  mostrarform(false);
  listar();
  costoServicio();
  
  $("#formulario").on("submit",function(e){
    guardaryeditar(e);
  })
 
  $("#consultaSunat").hide();

  

  $.post("../ajax/desarrollo-soporte.php?op=selectCliente", function(r){
    $("#idcliente").html(r);
    $('#idcliente').selectpicker('refresh');
});


$.post("../ajax/desarrollo-soporte.php?op=selectIntegrante", function(r){
    $("#idintegrant_desarrollo").html(r);
    $('#idintegrant_desarrollo').selectpicker('refresh');
  });
  
  $("#idcliente").change(rellenarCliente);
  
  

}

function rellenarCliente(){//😀
	var idcliente=$("#idcliente").val();

	var cliente=$("#iddesarrollo").prop("selected",true);
	if(cliente){
		$.post("../ajax/cotizacion.php?op=mostrarDatoCliente",{idcliente : idcliente},function(data){
			data = JSON.parse(data);
      $("#num_documento").val(data.num_documento);
      $("#telefono").val(data.telefono);
			$("#direccioncliente").val(data.direccion);

		});
	}
}

//Funcion limpiar
function limpiar() {
    $("#iddesarrollo").val("");
    $("#idcliente").val("");
    
    $("#num_documento").val("");
    $("#telefono").val("");
    $("#direccioncliente").val("");
  
     $("#nombre_proyecto").val("");
     $("#costo_desarrollo").val("");
     $("#idintegrant_desarrollo").val("");
     $("#estado_servicio").val("");
     $("#estado_pago").val("");
     $("#estado_entrega").val("");
    
     
  }
  // funcion para habilitar los campos de los datos del cliente
  function offdisabled(){
      const myDiv = document.getElementById('select');
      myDiv.hidden = false;
      $("#nomcliente").hide();
  }

var i=0;
var detalles=0;

function mostrarVentana() {
    $('#ventanaEmergente').show();
  }
  
  
  function cerrarVentanaEmergente() {
    document.getElementById('ventanaEmergente').style.display = 'none';
    
  }
  
  //Variable para almacenar el ultimo saldo
  var ultimoSaldo = 0;
  //aqui
  function mostrarPagos(iddesarrollo) {
    //console.log("Hola mostrarPagos")
    $.ajax({
      url: "../ajax/desarrollo-soporte.php?op=mostrarPagos&iddesarrollo=" + iddesarrollo,
      type: "POST",
      dataType: "json",
      success: function(data) {
     
        $('#tblpagos').empty(); // limpiar la tabla antes de agregar nuevas filas
  
        var filaCabecera = '<tr>' +
          '<th>Fecha de pago</th>' +
          '<th>Monto pagado</th>' +
          '<th>Saldo Restante</th>' +
          '<th>Tipo de pago  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" onclick="mostrarVentana()" value="+" id="btnagregar"></th>' +
          '</tr>';
        $('#tblpagos').append(filaCabecera);
  
        for (var i = 0; i < data.aaData.length; i++) {
         // console.log(data.aaData[i]);
          var fila = '<tr class="filas">' +
            '<td>' + data.aaData[i][0] + '</td>' +
            '<td>' + data.aaData[i][1] + '</td>' +
            '<td>' + data.aaData[i][2] + '</td>' +
            '<td>' + data.aaData[i][3] + '</td>' +
            '</tr>';
          $('#tblpagos').append(fila);
  
          // Actualiza el valor del último saldo en cada iteración
          ultimoSaldo = parseFloat(data.aaData[i][2]);
          //aqui
        }
  
       // console.log("Último saldo:", ultimoSaldo);
        
        // Realiza operaciones adicionales con el último saldo aquí
  
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la petición AJAX: " + textStatus + " - " + errorThrown);
        console.log(jqXHR.responseText);
      }
    });
      
  }


  function guardarPagos() {
    // Obtener los valores de los campos de entrada dentro de la ventana emergente
    var fecha = document.getElementById('fecha').value;
    var monto = parseFloat(document.getElementById('monto').value);
    var saldo = parseFloat(document.getElementById('saldo').value);
    var tipoPago = document.getElementById('tipo_pago').value;
    var idcliente = document.getElementById('idcliente').value;
    var iddesarrollo = document.getElementById('iddesarrollo').value;
  
   // Enviar los datos al servidor mediante AJAX
   $.ajax({
    url: '../ajax/desarrollo-soporte.php?op=insertarPago',
    method: 'POST',
    data: {
      fecha: fecha,
      monto: monto,
      saldo: saldo,
      tipo_pago: tipoPago,
      idcliente: idcliente,
      iddesarrollo: iddesarrollo,
    },
    success: function(datos)
	    {
			  // bootbox.alert(datos);
			
	        if(datos !="" || datos !=null){
            if (saldo === 0) {
              swal({
                title: "El servicio ha sido cancelado",
                text: "¡" + datos + "!",
                type: "success",
                confirmButtonText: "Cerrar",
                closeOnConfirm: true
              });
            } else {
              swal({
                title: "El pago se ha realizado con éxito",
                text: "¡" + datos + "!",
                type: "success",
                confirmButtonText: "Cerrar",
                closeOnConfirm: true
              });
            }
	        }else{
	        	swal({
				  title: "Error!",
				  text: "¡Ocurrio un error, por favor registre otra vez el pago",
				  type:"warning",
				  confirmButtonText: "Cerrar",
				  closeOnConfirm: true
				},
				);
	        }
	        mostrarPagos(iddesarrollo);
	    },
    error: function(xhr, status, error) {
      // Manejar los errores de la solicitud AJAX aquí
      console.log(xhr.responseText);
      console.log(status);
      console.log(error);
      alert("Hubo un error en la solicitud AJAX. Consulta la consola para más detalles.");
    }
  });

 // Cerrar la ventana emergente después de guardar los datos
  cerrarVentanaEmergente();
  
  // Limpiar los campos dentro de la ventana emergente
  document.getElementById('fecha').value = '';
  document.getElementById('monto').value = '';
  document.getElementById('saldo').value = '';
  document.getElementById('tipo_pago').value = '';

 // return mostrarPagos(iddesarrollo);
}
function mostrarform(flag)
{
  offdisabled()
  $("#colorin").show();
  $("#invisible").show();
  $("#formu").show();
    $("#cuotasdepago").hide();
  limpiar();
  if(flag)
  {
    $('#listadoregistros').hide();
    $('#formularioregistros').show();
    $('#btnGuardar').prop("disabled",false);   

  }
  else {
    $('#listadoregistros').show();
    $('#formularioregistros').hide();
    $("#agregarservicios").show();
    $("#agregarservicios").hide();
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
        url:'../ajax/desarrollo-soporte.php?op=listar',
        type:"get",
        dataType:"json",
        error:function(e)
        {
          console.log(e.responseText);
        }

      },
      "bDestroy":true,
      "iDisplayLength" :15, //Paginacion
      "order":[[0,"desc"]] //Ordenar (columna,orden)

    }
  ).DataTable();

}



function guardaryeditar(e)
{

  e.preventDefault();// No se activara la accion predeterminada del evento
  $("#btnGuardar").prop("disabled",true);
  var formData=new FormData($("#formulario")[0]);

  $.ajax(
    {
      url:"../ajax/desarrollo-soporte.php?op=guardaryeditar",
      type:"POST",
      data:formData,
      contentType:false,
      processData:false,

      success:function(datos)
      {
          alert(datos);
         // console.log(datos);
          mostrarform(false);
          tabla.ajax.reload();
      }
    }
  );
  limpiar();
}
//variable para almacenar el valor del total
var total=0;
function mostrar(iddesarrollo)
{
  console.log(iddesarrollo)
 $.post("../ajax/desarrollo-soporte.php?op=mostrar",{iddesarrollo:iddesarrollo}, function(data,status)
{
    data=JSON.parse(data);
    mostrarform(true);

   // $("#idcliente").val(data.nombre_cliente);
  //  $("#idcliente").selectpicker('refresh');

    $("#colorin").hide();
    $("#invisible").hide();
    $("#formu").hide();

    $("#idintegrant_desarrollo").val(data.nombre_integrantes);
    $("#idintegrant_desarrollo").selectpicker('refresh');//😂

    $("#iddesarrollo").val(data.iddesarrollo);
    $("#costo_desarrollo").val(data.costo_desarrollo);
    total=$("#costo_desarrollo").val();

    $("#nombre_proyecto").val(data.nombre_proyecto);
    $("#cuotasdepago").show();
    $("#iddet_pag_desarrollo").val(data.iddet_pag_desarrollo);
    //$("#idtecnico").val(data.nombre);
    var nombreCliente = $("#idcliente option:selected").text();
    $("#nomcliente").text(nombreCliente);
    $("#nomcliente").show();
    const myDiv = document.getElementById('select');
    myDiv.hidden = true;



})
mostrarPagos(iddesarrollo);

}

function eliminar(codigo_desarrollo)
{

  bootbox.confirm("Esta seguro eliminar el cliente",function(result)
{
  if(result)
  {
    $.post("../ajax/desarrollo-soporte.php?op=eliminar",{codigo_desarrollo:codigo_desarrollo},function(e){
      bootbox.alert(e);
        tabla.ajax.reload();
    });
  }
})
}
//let total = $("#total").val();
$(function () {
  //let total = $("#total");
  let monto = $("#monto");
  //console.log("El total:",total);
  /*total.keyup(function () {
    costoServicio();
  });*/

  monto.keyup(function () {
    costoServicio();
  });
});
//var saldo = mostrarPagos(idsoporte);
//console.log("Saldo fuera de la función:", ultimoSaldo);



function costoServicio(){
  //console.log("total fuera de la función:", total);
    let monto = $("#monto").val();
    let saldo;
  
    if (ultimoSaldo >0) {
      saldo = ultimoSaldo - monto;
      $("#saldo").val(saldo);
    } else {
      saldo = total - monto;
      $("#saldo").val(saldo);
    }

    if (saldo == 0) {
      $("#estado_pago").val("Pagado");
    }
  }


init();
