class conectionController{

	constructor(datos){
		this.datos=datos;
	}

	Conexion() {
		$.ajax(
		{
			data:this.datos,
			url:"../Modelo/modeloEasyCredit.php",
			method:"post",
			type : 'GET',
	    	dataType : 'json',
			success: function(response){
				Respuesta(response);
			}
		});
	}

}