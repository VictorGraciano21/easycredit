<?php 
// Conectando y seleccionado la base de datos 
function conexion($query)
{
	$conexion = mysqli_connect('localhost','root','','bd_easycredit');
	$resultado = mysqli_query($conexion, $query);
	mysqli_close($conexion);
	return $resultado;

}


function Alta()
{
	$texto="";
	$tipo=$_POST['tipo'];
	switch ($tipo) {
		case 'usuario':
			$texto="usuario(username) values('".$_POST['nombre']."');";
			break;
		case 'solicitud':
			$texto="detalle(Monto, edad, forma_de_pago, plazo) VALUES("+$_POST['monto']+", "+$_POST['edad']+", "+$_POST['pago']+", "+$_POST['palzo']+");
			insert into solicitudes(detalle, estado, autorizacion, usuario) values(maxDestalle(), false, false, "+$_POST['id']+");";
			break;
		default:
			break;
	}
	$query="insert into ".$texto;
	$valores=conexion($query);
	$valores=['1'];
	$aux=json_encode($valores);
	echo $aux;
}

function Baja()
{
	echo "Entro a la seccion de Baja";
}

function Actualizacion()
{
	echo "Entro a la seccion de Actualizacion";
}

function Consulta($query)
{
	$arreglo=array();
	$i=0;
	$conexion = mysqli_connect('localhost','root','','bd_easycredit');
	$resultado = mysqli_query($conexion, $query);
	while ($valores=mysqli_fetch_object($resultado)) {
		$arreglo[$i]=$valores;
		$i++;
	}
	mysqli_close($conexion);
	//$valores=mysqli_fetch_(conexion($query));
	$respuesta=json_encode($arreglo);
	echo $respuesta;
}

function postConsulta(){
	$query="select * from";
	$tabla="";
	$condicion="";
	$tipo=$_POST['tipo'];
	switch ($tipo) {
		case 'tabla':
			$tabla="usuario";
			$condicion="where username like '".$_POST['nombre']."';";
			break;
		case 'vista':
			$vista=$_POST['vista'];
			switch ($vista) {
				case 0: //vw_solicitudesPendientes
					$tabla="vw_solicitudesPendientes";
					break;
				case 1: //vw_historial
					$tabla="vw_historial";
					break;
				case 2: //vw_solicitudesSinAutorizar
					$tabla="vw_solicitudesSinAutorizar";
					break;
				default:
					break;
			}
			$condicion="where usuario = ".$_POST['id']." order by Estado DESC;";
			break;
		default:
			break;
	}
	$query=$query." ".$tabla." ".$condicion;
	Consulta($query);
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
			postConsulta();
			break;
		default:
			# code...
			break;
	}

// Cerrando la conexión
//mysql_close($conexion);

 ?>