<?php
//Se asignan a variables los parametros de conexión a BD
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="paleteria";
$db_table_name="cliente";
   
    //Realizo la conexión a BD
   $db_connection = mysqli_connect($db_host, $db_user, $db_password,$db_name);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}

//Pedimos los datos del formulario
$subs_nombre = utf8_decode($_POST['nombre']);
$subs_apellido = utf8_decode($_POST['apellido']);
$subs_rfc = utf8_decode($_POST['rfc']);
$subs_direccion = utf8_decode($_POST['direccion']);
$subs_telefono = utf8_decode($_POST['telefono']);
$subs_ciudad = utf8_decode($_POST['ciudad']);
$subs_estado = utf8_decode($_POST['estado']);
$subs_correo = utf8_decode($_POST['correo']);
$subs_password = utf8_decode($_POST['password']);
$subs_password = md5 ($subs_password);

//Buscar si el correo que viene del formulario existe en la BD
 $update="SELECT * FROM ".$db_table_name." WHERE correo = '".$subs_correo."'";
$resultado= $db_connection->query($update) or die("Error en: "  . mysql_error());

if (mysqli_num_rows($resultado)>0)
{

header('Location: Fail.html');

} else {
	
	//Insertar dentro de BD Los datos del formulario
	$insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`nombre` , `apellido` ,`rfc`, `direccion`,`telefono`,`ciudad`,`estado`,`correo`,`password`) VALUES ("' . $subs_nombre . '", "' . $subs_apellido . '", "' . $subs_rfc . '","' . $subs_direccion . '","' . $subs_telefono . '","' . $subs_ciudad . '","' . $subs_estado . '", "' . $subs_correo . '","' . $subs_password . '")';

//Ejecuta el comando Query
$db_connection->query($insert_value) or die("Error en: "  . mysql_error());


//Nos manda a Success.html para decirnos que se guardo correctamente
header('Location: Success.html');

}

//Nos cierra la conexión a la BD
mysqli_close($db_connection);

		
?>