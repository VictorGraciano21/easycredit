var solicitando = function(){

	var cajauno = function(){ seleccionar(false); }

	var cajados = function(){ seleccionar(true); }

	var volver = function(){ window.location.replace("formulario.html"); }

	//Función que prepara los datos para alta de una nueva solicitud
	var solicitar = function(){
		var monto=document.getElementById('cajaMonto').value;
		var edad=document.getElementById('cajaEdad').value;
		var plazo=document.getElementById('plazo');
		var mes=plazo.options[plazo.selectedIndex].text;
		var cajaSeleccionada = document.getElementById('cajaForma2').checked;
		if(!cajaSeleccionada){
			var creditCard=document.getElementById('card');
			var tarjeta=creditCard.options[creditCard.selectedIndex].text;
		}else
			var tarjeta="Pago en efectivo";

		var usuario = localStorage.getItem('userID');
		var datos = {datos:'solicitud',
				id:usuario,
				monto:monto,
				edad:edad,
				pago:tarjeta,
				plazo:mes
			};

		var conexion = new conectionController(datos);
		conexion.Conexion();
	}

	$('#cajaForma1').on('click', cajauno);
	$('#cajaForma2').on('click', cajados);
	$('#volver').on('click', volver);
	$('#solicitar').on('click', solicitar);
}
$(document).on("ready",solicitando);

function seleccionar(seleccionado){
	if (seleccionado){
		document.getElementById('cajaForma1').checked=false;
		document.getElementById('tarjeta').hidden=true;
	}
	else{
		document.getElementById('cajaForma2').checked=false;
		document.getElementById('tarjeta').hidden=false;
	}
}

function Respuesta(response){
	if(response.length!=0){
		alert("Solicitud registrada");
		window.location.replace("formulario.html");
	}
}
