<?
// iniciamos sesiones
session_start();
// destruimos la session de usuarios y variables usadas.
$usuarios_sesion = "id_persona";
session_name($usuarios_sesion);
session_unset();
session_destroy();
echo "<META HTTP-EQUIV=Refresh CONTENT='1;URL=index.php'>";  
?>
<html>
	<head>
		<title> FARMACIA SAN PEDRO || VENTA DE MEDICINA, NACIONAL E IMPORTADA </title>
		<link rel="stylesheet" href="css/estilos.css" type="text/css">
	</head>
	<body background="images/fondo.gif">
		<br><br>
		<center>
  <font face="Verdana, Arial, Helvetica, sans-serif" size="3" color="000063"><b> 
  Cerrando Session de Usuario .....!!! </b></font> 
</center>
	</body>
</html>

