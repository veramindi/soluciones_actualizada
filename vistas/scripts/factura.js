var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	// $('#impuesto').prop('disabled',true);

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	});
	//Cargamos los items al select proveedor
	$.post("../ajax/factura.php?op=selectCliente", function(r){
	            $("#idcliente").html(r);
	            $('#idcliente').selectpicker('refresh');
	});

	$.post("../ajax/factura.php?op=selectTipoPago", function (r) {
		$('#codigotipo_pago').html(r);
		$('#codigotipo_pago').selectpicker('refresh');

	});

	$.post("../ajax/factura.php?op=selectTipoComprobante",function(r){
		$('#tipo_comprobante').html(r);
		$('#tipo_comprobante').selectpicker('refresh');

	});
	
	$.post("../ajax/factura.php?op=selecTipoIGV",function(r){
		$('#impuesto').html(r);
		$('#impuesto').selectpicker('refresh');
	
	});

	// $.post("../ajax/venta2.php?op=selectTipoComprobante",function(r){
	// 	$('#codigotipo_comprobante').html(r);
	// 	$('#codigotipo_comprobante').selectpicker('refresh');

	// });


    $("#idcliente").change(rellenarCliente);
	
	$('input[type=radio][name=tipo_comprobante]').change(function(){
		if($(this).val()=="Factura"){
			$.post("../ajax/factura.php?op=maximaVenta",{tipo_comprobante:"Factura"},function(data){
				data=JSON.parse(data);
				$("#serie").val(data.maxSerie);
				$("#correlativo").val(data.maxCorrelativo);
			})
		}
		if($(this).val()=="Boleta"){
			$.post("../ajax/factura.php?op=maximaVenta",{tipo_comprobante:"Boleta"},function(data){
				data=JSON.parse(data);
				$("#serie").val(data.maxSerie);
				$("#correlativo").val(data.maxCorrelativo);
			})
			
		}
	})
	// var fs=$("#factura").checked;
	// console.log(fs);
	// var tipo_comprobante = $("#")
	// $.post("../ajax/Venta.php?op=maximaVenta",{tipo_comprobante:})
}
function rellenarCliente(){
	var clientee=$("#idcliente").val();

	var idcliente=$("#idcliente").prop("selected",true);
	if(idcliente){
		// console.log(clientee);

		$.post("../ajax/factura.php?op=mostrarDatoCliente",{idcliente : clientee},function(data){
			data = JSON.parse(data);

			$("#tipo_documento").val(data.tipo_documento);
			$("#num_documento").val(data.num_documento);
			$("#direccioncliente").val(data.direccion);

		});

	}
}

function LPad(ContentToSize,PadLength,PadChar)
  {
     var PaddedString=ContentToSize.toString();
     for(var i=ContentToSize.length+1;i<=PadLength;i++)
     {
         PaddedString=PadChar+PaddedString;
     }
     return PaddedString;
  }


function limpiar()
{
	$("#idcliente").val("");
	$("#idcliente").selectpicker("refresh");
	$("#cliente").val("");
	$("#serie").val("");
	$("#correlativo").val("");
	$("#tipo_documento").val("");
	$("#num_documento").val("");
	$("#direccioncliente").val("");
	// $("#factn").prop("checked",true);
	// $("#facts").prop("checked",false);

	$("#op_gravadas").val("");
	$("#totalg").html("0.00");
	$("#igv_total").val("");
	$("#totaligv").html("0.00");

	$("#total_venta").val("");
	$(".filas").remove();
	$("#totalventa").html("0.00");

	$("#codigotipo_pago").val("Efectivo");
	$("#codigotipo_pago").selectpicker('refresh');

	//Marcamos el primer tipo_documento
    $("#tipo_comprobante").val("Boleta");
	$("#tipo_comprobante").selectpicker('refresh');

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
	$('#fecha_ven').val(today)
	
    // $("#tipo_comprobante").on("checked",true);

	//Obtenemos la fecha actual
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);
	var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);

    //Marcamos el primer tipo_documento
}
//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		

		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		$("#btnAgregarArt").show();
		detalles=0;
		$.post("../ajax/factura.php?op=maximaVenta",{tipo_comprobante:"Factura"},function(data){
				data=JSON.parse(data);
				$("#serie").val(data.maxSerie);
				$("#correlativo").val(data.maxCorrelativo);
			})

	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/factura.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 9,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}



function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/factura.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          bootbox.alert(datos);
	          mostrarform(false);
	          listar();
	    }

	});
	limpiar();
}


//Función para anular registros
function anular(id_factura)
{
	bootbox.confirm("¿Está Seguro de anular la factura?", function(result){
		if(result)
        {
        	$.post("../ajax/factura.php?op=anular", {id_factura : id_factura}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});
        }
	})
  limpiar();
}

function eliminar(id_factura){
  	bootbox.confirm("¿Esta seguro eliminar la factura",function(result){
		if(result){
			$.post("../ajax/factura.php?op=eliminar",{id_factura:id_factura},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
  		}
	})
	// limpiar();
}

function mostrar(id_factura){
		mostrarform(true);
	$.post("../ajax/factura.php?op=mostrar",{id_factura : id_factura},function(data){
		data = JSON.parse(data);

		var clientee = $("#idcliente").val(data.idcliente);
		$("#idcliente").selectpicker("refresh");

		$("#tipo_documento").val(data.tipo_documento);
		$("#num_documento").val(data.num_documento);
		$("#direccioncliente").val(data.direccion);

	    // $("#tipo_comprobante").on("checked",true);
		$("#codigotipo_pago").val(data.codigotipo_pago);
		$("#codigotipo_pago").selectpicker('refresh');
		$("#tipo_comprobante").val(data.tipo_comprobante);
		$("#tipo_comprobante").selectpicker('refresh');
		$("#fecha_ven").val(fecha_ven);

		$("#serie").val(data.serie);
		$("#correlativo").val(data.correlativo);
		$("#fecha_hora").val(data.fecha);

		$("#op_gravadas").val(data.op_gravadas);
		$("#totalg").html(data.op_gravadas);
		$("#igv_total").val(data.igv_total);
		$("#totaligv").html(data.igv_total);

		$("#total_venta").val(data.total_venta);
		$(".filas").remove();
		$("#totalventa").html(data.total_venta);
		
		$.post("../ajax/factura.php?op=listarDetalle&id="+id_factura,function(r){
			$("#detalles").html(r);
		})

	})
}


//Declaración de variables necesarias para trabajar con las compras y
//sus detalles
var impuesto=18;
var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();


function agregarDetalle(){
		var cantidad=1;
	  	var precio_venta=1;
	    // var descuento=0;
   
    	var subtotal=cantidad*precio_venta/1.18;
	    var igvv= subtotal*0.18;
    	igvv=igvv.toFixed(2);
    	subtotal=subtotal.toFixed(2);
    	var importe=cantidad*precio_venta;
    	
    	var fila='<tr class="filas" id="fila'+cont+'">'+
    	'<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
    	'<td style="width:12%"><input type="text" name="codigo_prod[]" style="width:90px;"></td>'+
    	'<td style="width:30%"><input type="text" name="descripcion_prod[]" style="width:400px;" placeholder="Escriba la descripción del Servicio" required></td>'+
    	'<td style="width:10%"><input type="text" name="unidad_medida[]" value="NIU" id="unidad_medida'+cont+'"  style="width:120px;" required readonly></td>'+
    	'<td style="width:7%"><input type="number" min="0" step="0.01" name="precio_venta[]" id="precio_v'+cont+'" value="'+precio_venta+'" style="width:60px;"></td>'+
    	'<td style="width:7%"><input type="number" min="0" name="cantidad[]" id="cantidad'+cont+'" value="'+cantidad+'" style="width:60px;"></td>'+

    	'<td style="width:12%"><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
    	'<td style="width:12%"><span name="igv" id="igv'+cont+'">'+igvv+'</span></td>'+
    	'<td style="width:12%"><span name="importe" id="importe'+cont+'">'+importe+'</span></td>'+
    	'</tr>';
    	$('#detalles').append(fila);
    	$("#precio_v"+cont).keyup(modificarSubtotales);
    	$("#cantidad"+cont).keyup(modificarSubtotales);
    	$("#precio_v"+cont).change(modificarSubtotales);
    	$("#cantidad"+cont).change(modificarSubtotales);
    	cont++;
    	detalles=detalles+1;
    	modificarSubtotales();
}


  function modificarSubtotales()
  {
  	var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_venta[]");
    var sub = document.getElementsByName("importe");
  	var subt = 0.0;
  	var newvparcial=0;
  	var igvt=0;

    for (var i = 0; i <cant.length; i++) {
    	var inpC=cant[i];
    	var inpP=prec[i];
    	var inpS=sub[i];

    	inpS.value=inpP.value*inpC.value;
		var igv = document.getElementById("impuesto").value;
		igv = (igv*(1/100));
		
		var st = inpS.value;
		var ig = st*igv;
	
    	newvparcial += parseFloat(inpS.value*(1+igv));
    	subt =newvparcial/1.18;
    	igvt=subt*igv;


    	document.getElementsByName("subtotal")[i].innerHTML = addCommas(st.toFixed(2));
    	document.getElementsByName("igv")[i].innerHTML = addCommas(ig.toFixed(2));
    	document.getElementsByName("importe")[i].innerHTML = addCommas(inpS.value.toFixed(2));
    }

    $('#totalg').html("S/. " + addCommas(subt.toFixed(2)));
    $('#op_gravadas').val(subt.toFixed(2));

    $('#totaligv').html("S/. " + addCommas(igvt.toFixed(2)));
    $('#igv_total').val(igvt.toFixed(2));

    $("#totalventa").html("S/. " + addCommas(newvparcial.toFixed(2)));
    $("#total_venta").val(newvparcial.toFixed(2));
    evaluar();
    // calcularTotales();
  }

 function evaluar(){
  	if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide();
      cont=0;
    }
  }

  function eliminarDetalle(indice){
  	$("#fila" + indice).remove();
  	modificarSubtotales();
  	detalles=detalles-1;
  	evaluar()
  }
   function addCommas(nStr){
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
init();
