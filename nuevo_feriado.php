<?php
include("menuadmin.php");
 if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<?php
$link=Conectarse();

$tra=new User();
$datos=$tra->get_tabla('persona');
for($i=0;$i<sizeof($datos);$i++)
{
	$nro=$datos[$i]["id_persona"];
	$fecha=$_POST['fecha'];
	$dpto=' ';
	$nombres=' ';
	$observacion='F';

$c=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','08:00:00','$observacion','' );");
mysql_query($c);	
$c1=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','12:30:00','$observacion','');");
mysql_query($c1);
$c2=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','15:00:00','$observacion','');");
mysql_query($c2);	
$c3=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','18:30:00','$observacion','');");
mysql_query($c3); 
	

}
  echo"<script type='text/javascript'>
			alert('Feriado Ingresado Correctamente');
			window.location='insercion_manual_asistencia.php';
			</script>";
}

?>

<form action="" method="post">
  <table width="302" border="0" align="center">
    <tbody>
    <tr>
      <td colspan="2" style="text-align: center"><strong>Ingrese la fecha del feriado</strong></td>
      </tr>
    <tr>
      <td><input type="date" value="<?php echo date("Y-m-d");?>" name="fecha"></td>
      <td><input type="hidden" name="grabar" value="si" />
        <input  type="submit" name="button" id="button" value="Insertar"></td>
    </tr>
  </tbody>
</table>
</form>

