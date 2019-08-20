<? include("menuadmin.php");
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
 ?>
<?php
$i=0; 
$link=Conectarse();
while ($i < count ($_POST["checkbox"]) ) {
	 $nro=$_POST["checkbox"][$i];
   $fecha=$_POST["fecha"][$i];
    $a=("update biometrico set estado = 'visto' where nro= $nro AND fecha='$fecha'");
      mysql_query($a);	
    print '<br />';
    $i++;
	 echo"<script type='text/javascript'>
			alert('registros borrados correctamente');
			window.location='inicio.php';
			</script>";

}
?>

