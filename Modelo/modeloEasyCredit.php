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
	$query="insert into usuario(username) values('".$_POST['nombre']."');";//echo $query;
	$conexion = mysqli_connect('localhost','root','','bd_easycredit');
	$resultado = mysqli_query($conexion, $query); 
	mysqli_close($conexion);
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
	//echo "Entro a la seccion de Actualizacion";
	$cambio=$_POST['cambio'];
	$id=$_POST['id'];
	$query="UPDATE solicitudes SET Autorizacion=".$cambio." where id_solicitud=".$id;
	//echo $query;
	$conexion = mysqli_connect('localhost','root','','bd_easycredit');
	$resultado = mysqli_query($conexion, $query); 
	mysqli_close($conexion);
	$valores=['1'];
	$aux=json_encode($valores);
	echo $aux;
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

function solicitud()
{
	$monto=$_POST['monto'];
	$edad=$_POST['edad'];
	$formaPago=$_POST['pago'];
	$plazo=$_POST['plazo'];
	$id=$_POST['id'];
	$texto="insert into solicitudes(detalle, estado, autorizacion, usuario) values(maxDetalle(), false, false, ".$id.");";
	$query="insert into detalle(Monto, edad, forma_de_pago, plazo) VALUES(".$monto.", ".$edad.", '".$formaPago."', ".$plazo."); ";
	
	$conexion = mysqli_connect('localhost','root','','bd_easycredit');
	$resultado = mysqli_query($conexion, $query);
	mysqli_close($conexion);
	conexion($texto);
	$valores=['1'];
	$aux=json_encode($valores);
	echo $aux;
}

function consultaAdmin(){
	$query="select * from vw_solicitudesSinAutorizar;";
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
		case 'solicitud':
			Solicitud();
			break;
		case 'consultaAdmin':
			consultaAdmin();
			break;
		default:
			# code...
			break;
	}

// Cerrando la conexión
//mysql_close($conexion);

 ?>