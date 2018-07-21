var inicioLogin = function () {
	
	var entrar = function (){
		alert("Soy: "+document.getElementById('cajaUsuario').value);
	}

	$("#entrar").on("click", entrar);
}
$(document).on("ready", inicioLogin);