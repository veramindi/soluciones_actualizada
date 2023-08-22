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

  

  $.post("../ajax/servicios-soporte.php?op=selectCliente", function(r){
    $("#idcliente").html(r);
    $('#idcliente').selectpicker('refresh');
});

  $.post("../ajax/servicios-soporte.php?op=selectTecnico", function(r){
  $("#idtecnico").html(r);
  $('#idtecnico').selectpicker('refresh');
});

$("#idcliente").change(rellenarCliente);



}

function rellenarCliente(){//😀
	var idcliente=$("#idcliente").val();

	var cliente=$("#idsoporte").prop("selected",true);
	if(cliente){
		$.post("../ajax/cotizacion.php?op=mostrarDatoCliente",{idcliente : idcliente},function(data){
			data = JSON.parse(data);

      $("#telefono").val(data.telefono);
			$("#direccioncliente").val(data.direccion);

		});
	}
}

//Funcion limpiar
function limpiar() {
  $("#idtecnico").val("");
  $("#idsoporte").val("");
  $("#idcliente").val("");
  $("#telefono").val("");
  $("#direccioncliente").val("");
   $("#fecha_ingreso").val("");
   $("#fecha_salida").val("");
   $("#nombre_cliente").val("");
   $("#tipo_equipo").val("");
   $("#marca").val("");
   $("#problema").val("");
   $("#solucion").val("");
   //$("#tecnico_respon").val("");
   $("#codigo_soporte").val("");
   $("#estado_servicio").val("");
   $("#estado_pago").val("");
   $("#total").val("");
   $("#estado_entrega").val("");
   $("#direccion").val("");
   $("#accesorio").val("");
   $("#recomendacion").val("");
   $("#garantia").val("");
   
}
// funcion para habilitar los campos de los datos del cliente
function offdisabled(){
    $("#telefono").prop("readonly", false);
    $("#direccioncliente").prop("readonly", false);
    const myDiv = document.getElementById('select');
    myDiv.hidden = false;
    $("#nombre_cliente_span").hide();
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
function mostrarPagos(idsoporte) {
  //console.log("Hola mostrarPagos")
  $.ajax({
    url: "../ajax/servicios-soporte.php?op=mostrarPagos&idsoporte=" + idsoporte,
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
    //  console.log("Último saldos:", ultimoSaldo)
}

function guardarPagos() {
  // Obtener los valores de los campos de entrada dentro de la ventana emergente
  var fechaPago = document.getElementById('fecha_pago').value;
  var cuotas = parseFloat(document.getElementById('cuotas').value);
  var saldos = parseFloat(document.getElementById('saldos').value);
  var tipoPago = document.getElementById('tipo_pago').value;
  var idcliente = document.getElementById('idcliente').value;
  var idsoporte = document.getElementById('idsoporte').value;

  // Enviar los datos al servidor mediante AJAX
  $.ajax({
    url: '../ajax/servicios-soporte.php?op=insertarPago',
    method: 'POST',
    data: {
      fecha_pago: fechaPago,
      cuotas: cuotas,
      saldos: saldos,
      tipo_pago: tipoPago,
      idcliente: idcliente,
      idsoporte: idsoporte,
    },
    success: function(datos)
	    {
			  // bootbox.alert(datos);
			
	        if(datos !="" || datos !=null){
            if (saldos === 0) {
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
	        mostrarPagos(idsoporte);
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
  document.getElementById('fecha_pago').value = '';
  document.getElementById('cuotas').value = '';
  document.getElementById('saldos').value = '';
  document.getElementById('tipo_pago').value = '';

 // return mostrarPagos(idsoporte);
}

function mostrarform(flag)
{
  offdisabled()
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
        url:'../ajax/servicios-soporte.php?op=listar',
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
      url:"../ajax/servicios-soporte.php?op=guardaryeditar",
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
function mostrar(idsoporte)
{
  console.log(idsoporte)
 $.post("../ajax/servicios-soporte.php?op=mostrar",{idsoporte:idsoporte}, function(data,status)
{
    data=JSON.parse(data);
    mostrarform(true);
    //console.log("funcion mostrar");
    $("#idcliente").hide();
    $("#idcliente").val(data.nombre_cliente);//😂
    //$("#idtecnico").hide();
    $("#idtecnico").val(data.tecnico_respon);//😂
    $("#idtecnico").selectpicker('refresh');//😂
    //console.log(iddeltecnico)
    $("#fecha_ingreso").val(data.fecha_ingreso);
    $("#fecha_salida").val(data.fecha_salida);
    $("#telefono").val(data.telefono);//😂
    $("#telefono").prop("readonly", true);//para que no se pueda editar
    $("#direccioncliente").val(data.direccion);//😂
    $("#direccioncliente").prop("readonly", true);//para que no se pueda editar
    $("#tipo_equipo").val(data.tipo_equipo);
    $("#marca").val(data.marca);
    $("#problema").val(data.problema);
    $("#solucion").val(data.solucion);
    $("#codigo_soporte").val(data.codigo_soporte);
    $("#idsoporte").val(data.idsoporte);
    $("#estado_servicio").val(data.estado_servicio);
    $("#estado_pago").val(data.estado_pago);
    $("#estado_entrega").val(data.estado_entrega);
    //aqui
    $("#total").val(data.total);
    total=$("#total").val();
    $("#accesorio").val(data.accesorio);
    $("#recomendacion").val(data.recomendacion);
    $("#garantia").val(data.garantia);
    $("#cuotasdepago").show();
    $("#fecha_pago").val(data.fecha_pago);
    $("#idsoportepago").val(data.idsoportepago);
    //$("#idtecnico").val(data.nombre);

    var nombreCliente = $("#idcliente option:selected").text();
    $("#nombre_cliente_span").text(nombreCliente);
    $("#nombre_cliente_span").show();
    const myDiv = document.getElementById('select');
    myDiv.hidden = true;

})
mostrarPagos(idsoporte);
}

function eliminar(codigo_soporte)
{

  bootbox.confirm("Esta seguro eliminar el cliente",function(result)
{
  if(result)
  {
    $.post("../ajax/servicios-soporte.php?op=eliminar",{codigo_soporte:codigo_soporte},function(e){
      bootbox.alert(e);
        tabla.ajax.reload();
    });
  }
})
}
//let total = $("#total").val();
$(function () {
  //let total = $("#total");
  let cuotas = $("#cuotas");
  //console.log("El total:",total);
  /*total.keyup(function () {
    costoServicio();
  });*/

  cuotas.keyup(function () {
    costoServicio();
  });
});
//var saldo = mostrarPagos(idsoporte);
//console.log("Saldo fuera de la función:", ultimoSaldo);



function costoServicio(){
  //console.log("total fuera de la función:", total);
    let cuotas = $("#cuotas").val();
    let saldos;
  
    if (ultimoSaldo >0) {
      saldos = ultimoSaldo - cuotas;
      $("#saldos").val(saldos);
    } else {
      saldos = total - cuotas;
      $("#saldos").val(saldos);
    }

    if (saldos == 0) {
      $("#estado_pago").val("Pagado");
    }
  }

 
  //let saldos = total - cuotas;
  //$("#saldos").val(saldos);



init();
