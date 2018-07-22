var inicioLogin = function () {
	
	var entrar = function (){
		Registro(true);
	}

	$("#entrar").on("click", entrar);
}
$(document).on("ready", inicioLogin);

function Registro(tipo){
	var usuario = document.getElementById('cajaUsuario').value;
	var opc="";
	var opc2="";
	if(tipo){
		opc="consulta";
		opc2="tabla";
	}
	else{
		opc="alta";
		opc2="usuario";
	}
	var datos = {datos:opc,
				nombre:usuario,
				tipo:opc2
			};

	var conexion = new conectionController(datos);
	conexion.Conexion();
}

function Respuesta(response){
	//alert(response.length!=0);
	if(response.length!=0){
		localStorage.setItem('userID',response[0]['userID']);
		window.location.replace("formulario.html");
	}
	else
		Registro(false);

}
