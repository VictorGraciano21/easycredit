<?php 
// Conectando y seleccionado la base de datos 
function conexion($query)
{
	$conexion = mysqli_connect('localhost','root','','bd_easycredit');
	$resultado = mysqli_query($conexion, $query);
	return $resultado;
}


function Alta()
{
	echo "Entro a la seccion de altas";
}

function Baja()
{
	echo "Entro a la seccion de Baja";
}

function Actualizacion()
{
	echo "Entro a la seccion de Actualizacion";
}

function Consulta()
{
	$nombre=$_POST['nombre'];
	$query="select username from usuario where username like '".$nombre."';";
	$valores=mysqli_fetch_row(conexion($query));
	$respuesta=json_encode($valores);
	echo $respuesta;
	//echo "Entro a la seccion de Consulta";
}

//Menú principal
	$opc = $_POST['datos'];
	switch ($opc) {
		case 'alta':
			Alta();
			break;
		case 'baja':
			Baja();
			break;
		case 'actualizacion':
			Actualizacion();
			break;
		case 'consulta':
			Consulta();
			break;
		default:
			# code...
			break;
	}

// Cerrando la conexión
//mysql_close($conexion);

 ?>