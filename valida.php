<?php
  session_start();

 //include 'registro/conecta.php';
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="paleteria";
$db_table_name="cliente";
   
   //Realizo la conexión a BD
   $db_connection = mysqli_connect($db_host, $db_user, $db_password,$db_name); 

// Obtengo los datos cargados en el formulario de login.
  $email = $_POST['email'];
  $password = $_POST['password'];

$password = md5 ($password);

if (!$db_connection) {
  die('No se ha podido conectar a la base de datos');
}


$valida="SELECT * FROM ".$db_table_name." WHERE correo = '".$email."' and password = '".$password."'";

$resultado= $db_connection->query($valida) or die("Error en: "  . mysql_error());

if (mysqli_num_rows($resultado)>0)
{
 $_SESSION['email'] = $email;
header('Location: ./index.php');
} 
 else
{
  echo 'El email o password es incorrecto, <a href="./index.html">vuelva a intenarlo</a>.<br/>';
}

//Nos cierra la conexión a la BD
mysqli_close($db_connection);
 
?>