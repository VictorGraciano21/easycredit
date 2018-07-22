var inicioLogin = function () {
	
	var entrar = function (){
		var usuario = document.getElementById('cajaUsuario').value;
		var datos = {datos:'consulta',
					nombre:usuario
				};

		var conexion = new conectionController(datos);
		conexion.Conexion();
	}

	$("#entrar").on("click", entrar);
}
$(document).on("ready", inicioLogin);

function Respuesta(response){
	if(response!=null)
		console.log("bueno");
	else
		console.log("malo");

}
