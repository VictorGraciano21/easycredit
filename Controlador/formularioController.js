var inicio = function(){
	for (var i = 0; i < 3; i++){
		DatosFormulario(i);
	} 
		
	var solicitar = function(){
		window.location.replace("solicitud.html");
	}

	$("#solicitar").on("click", solicitar);
}
$(document).on("ready", inicio);

function DatosFormulario(tipo){
	var usuario = localStorage.getItem('userID');
	var opc="consulta";
	var datos = {datos:opc,
				id:usuario,
				tipo:"vista",
				vista:tipo
			};

	var conexion = new conectionController(datos);
	conexion.Conexion();
}

function CreaTabla(datos){
	var texto="";
	var estado="";
	var autorizado="";
	for (var i = 0; i < datos.length; i++) {
		if(datos[i]['Estado']==1) estado="Liquidado"; else estado="Pendiente";
		if(datos[i]['Autorizado']==1) autorizado="Autorizado"; else autorizado="No autorizado";
		texto=texto+"<tr><td><br></td></tr> <tr><td>Folio: "+datos[i]['ID_Solicitud']+"</td></tr> <tr><td>Monto solicidato: </td><td>"+datos[i]['Monto']+"</td></tr> <tr><td>Edad: </td><td>"+datos[i]['edad']+" años</td></tr> <tr><td>Forma de pago:</td><td>"+datos[i]['forma_de_pago']+"</td></tr> <tr><td>Plazo: </td><td>"+datos[i]['plazo']+" meses</td></tr> <tr><td>Solicitud: </td><td>"+autorizado+"</td></tr> <tr><td>Estado de la solicitud: </td><td>"+estado+"</td></tr>";
	}
	if(datos[0]['Estado']==0){
		if (datos[0]['Autorizacion']==1) {
			//alert("Soy vw_solicitudesPendientes");
			texto="<tr><td>Nombre: </td> <td>"+datos[0]['username']+"</td></tr>"+texto;
			document.getElementById("contenidoUsuario").innerHTML = texto;
		}else{
			//alert("Soy vw_solicitudesSinAutorizar");
			document.getElementById("contenidoSolicitud").innerHTML = texto;
		}
	}else{
		//alert("Soy vw_historial");
		document.getElementById("contenidoHistorial").innerHTML = texto;
	}
	
}

function Respuesta(response){
	if(response!=null || response){
		CreaTabla(response);
	}

}
