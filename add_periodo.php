<? include("menuadmin.php"); ?>
<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<?php
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
 echo $_POST["id"];  
$fecha= $_POST["fecha"];
$hora=$_POST["periodo"];
$observacion=$_POST["select"];
   $tim=new User();
 $id2=$_GET["id"];
$doc=$tim->get_tabla_id("id_persona",$id2,"persona");
$nombres = $doc[0]["nombres"].' '.$doc[0]["ap_paterno"].' '.$doc[0]["ap_materno"];
$dpto = $doc[0]["id_unidad"];
$nro = $doc[0]["id_persona"];
  $link=Conectarse();
 //____________________________________________________
 $link=Conectarse();
   $sqlver=mysql_query("SELECT * FROM biometrico WHERE nombres = '$nombres' AND fecha = '$fecha' AND hora = '$hora'",$link);
   if (mysql_fetch_array($sqlver) == 0) {
//____________________________________COMPARO REGISTROS DUPLICADOS________________________________________
$ver=mysql_query("SELECT * FROM biometrico WHERE nombres = '$nombres' AND fecha = '$fecha' AND hora < '11:00:00'",$link);
   if (mysql_fetch_array($ver) == 0) {
$c1=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
mysql_query($c1);               
    }else{
		$ver2=mysql_query("SELECT * FROM biometrico WHERE nombres = '$nombres' AND fecha = '$fecha' AND hora > '12:00:00' AND hora < '14:00:00'",$link);
  		 if (mysql_fetch_array($ver2) == 0) {
			  if($hora > '11:00:00' && $hora<'14:00:00'){
				  $e=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($e); 
				  } 
         }else{
			 $ver3=mysql_query("SELECT * FROM biometrico WHERE nombres = '$nombres' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '16:00:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'16:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($f); 
				  } 
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nombres = '$nombres' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($g); 
				  }     
					}
				}
			 
			 }
		
		
		}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//************************************************************************************************
			}else{ 
  echo"el usuario $nro ya fue ingresado a la base de datos";
 }
 //____________________________________________________
echo "<script type='text/javascript'>
			alert('Asistencia Agregada Correctamente ');
			window.location='funcionarios.php';
			</script>";
exit;
}
?>
<form id="form1" name="form1" method="post" action="">
<table width="462" border="1" align="center">
  <tbody>
    <tr>
      <td colspan="2" align="center">Corregir hora de:
    <?  
      $tim=new User();
 $id2=$_GET["id"];
$doc=$tim->get_tabla_id("id_persona",$id2,"persona");
  echo $doc[0]["nombres"].' '.$doc[0]["ap_paterno"].' '.$doc[0]["ap_materno"];
      ?>
      </td>
    </tr>
    <tr>
      <td width="154">Fecha:</td>
      <td width="242">
      <input type="date" name="fecha" id="fecha" /></td>
    </tr>
    <tr>
      <td>Periodo</td>
      <td><select name="periodo" id="periodo">
       <option value="08:00:00">Entrada Ma&ntilde;ana</option>
       <option value="12:30:00">Salida Ma&ntilde;ana</option>
       <option value="15:00:00">Entrada Tarde</option>
       <option value="18:30:00">Salida Tarde</option>
      </select></td>
    </tr>
     <tr>
    <td height="30"><label for="select">Seleccionar </label></td>
    <td colspan="2" align="left"><h4>
      <select name="select" id="select">
  <option value="A">ASISTENCIA</option>
<option value="V">VACACIONES</option>
<option value="BM">BAJA MEDICA</option>
<option value="P">PERMISOS</option>
<option value="C">COMISION</option>
    </select>
  
    </h4></td>
 
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input type="button" name="button2" id="button2" value="--Salir--" onclick="location='funcionarios.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Asignar asistencia" />
      
      </td>
    </tr>
  </tbody>
</table>

</form>
<?  include("footer.php"); ?>