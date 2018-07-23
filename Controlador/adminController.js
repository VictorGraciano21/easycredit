var admin = function (){
	inicia();
}
$(document).on("ready",admin);

function inicia(){
	var datos = {datos:'consultaAdmin'
			};

	var conexion = new conectionController(datos);
	conexion.Conexion();

}

function CreaTabla(datos){
	if (datos.length==1) {location.reload();}else{
	var texto="";
	for (var i = 0; i < datos.length; i++) {
		var interes=0;
		var total=0;

		var  num = parseInt(datos[i]['plazo']);
		switch(num){
			case 3:
				interes=datos[i]['Monto']*0.05;
				break;
			case 6:
				interes=datos[i]['Monto']*0.07;
				break;
			case 9:
				interes=datos[i]['Monto']*0.12;
				break;
			default:
				break;
		}
		total=datos[i]['plazo']+interes;

		if(datos[i]['Estado']==1) estado="Liquidado"; else estado="Pendiente";
		if(datos[i]['Autorizado']==1) autorizado="Autorizado"; else autorizado="No autorizado";
		texto=texto+"<tr><td>"+datos[i]['usuario']+"</td> <td>"+datos[i]['username']+"</td> <td>Folio: "+datos[i]['ID_Solicitud']+"</td> <td>$"+datos[i]['Monto']+"</td> <td>"+datos[i]['edad']+" años</td> <td>"+datos[i]['forma_de_pago']+"</td> <td>"+datos[i]['plazo']+" meses</td><td>"+interes+"</td><td>"+total+"</td> <td><button onclick='javascript:autorizaRechaza("+datos[i]['ID_Solicitud']+",true)'>Autorizar</button></td> <td><button onclick='javascript:autorizaRechaza("+datos[i]['ID_Solicitud']+",false)'>Rechazar</button></td></tr>";
	}
	document.getElementById("contenido").innerHTML = texto;
}
}

function autorizaRechaza(folio, opc){
	if(opc){//Sección que se encarga de actualizar y marcar como autorizada la solicitud
		//alert("Autorizarás la solicitud: "+folio);
		var datos = {datos:'actualizacion',
					cambio:true,
					id:folio
			};
	}else{ //Sección que se encarga de actualizar y marcar como rechazada la solicitud
		//alert("Rechazarás la solicitud: "+folio);
		var datos = {datos:'actualizacion',
					cambio:3,
					id:folio
			};
	}

	var conexion = new conectionController(datos);
	conexion.Conexion();
}

function Respuesta(response){
	if(response!=null || response){
		CreaTabla(response);
	}

}