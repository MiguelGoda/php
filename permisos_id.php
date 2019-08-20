<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<? include("menuadmin.php");
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	echo $stado =$_POST['select'];
	echo "<br>";
	echo $inicio =$_POST['inicio'];
	echo "<br>";
	echo $fin =$_POST['fin'];
	echo "<br>";
	echo $observaciones =$_POST['observaciones'];
	echo "<br>";
		echo $id =$_POST['id'];
	 $tra2=new User();
    $dato=$tra2->get_tabla_id("id_persona",$id,"persona");
    $nombre =$dato[0]["ap_paterno"]." ".$dato[0]["ap_materno"]." ".$dato[0]["nombres"];
	$nro = $dato[0]["id_persona"];
	$unid = $dato[0]["id_unidad"];
	$tr=new User();
    $dat=$tr->get_tabla_id("id_unidad",$unid,"unidad");
	$dpto = $dat[0]["nombre_u"];
	echo "<br>";
	$link=Conectarse();
	$tra=new User();
    $tra->add_vacaciones();
 
for($i=(strtotime($inicio)/86400);$i<=(strtotime($fin)/86400);$i++)
	{
		$aux= $fecha = date("Y-m-d",($i*86400));
        $fech = strtotime($aux);
        $d = date("N", $fech);
		if($d==7){
			echo '';
			}
		else{
			
		//::::::::::::::::::::COMPARO REGISTRO DUPLICADOS::::::::::::::::::::::::::::::::::::::
		for($j=0;$j<=3;$j++){
			if($j==0) $hora='08:00:00';
			if($j==1) $hora='12:30:00';
			if($j==2) $hora='15:00:00';
			if($j==3) $hora='18:30:00';
		$ver=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora < '11:00:00'",$link);
   if ((mysql_fetch_array($ver) == 0)) {
	   	   if($hora<'10:00:00'){
$c1=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','$hora','$stado','');");
mysql_query($c1);  
		   }else{
		   //___________________HORA 1::::::::::::::::::::::
		$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '12:00:00' AND hora < '14:00:00'",$link);
  		 if (mysql_fetch_array($ver2) == 0) {
			  if($hora > '11:00:00' && $hora<'14:00:00'){
				  $e=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','12:30:00','$stado','');");
					mysql_query($e); 
				  }else{
					  //___________________
					   $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '16:00:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'16:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','15:00:00','$stado','');");
					mysql_query($f); 
				  } else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
				}
					  //___________________
					  
					  }
         }else{
			 $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '16:00:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'16:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','15:00:00','$stado','');");
					mysql_query($f); 
				  }  else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
				}
			 
			 }
		   
		 //__________________FIN HORA1::::::::::::::::::::::
             
		   }}else{
		$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '12:00:00' AND hora < '14:00:00'",$link);
  		 if (mysql_fetch_array($ver2) == 0) {
			  if($hora > '11:00:00' && $hora<'14:00:00'){
				  $e=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','12:30:00','$stado','');");
					mysql_query($e); 
				  }else{
					  //___________________
					   $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '16:00:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'16:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','15:00:00','$stado','');");
					mysql_query($f); 
				  } else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
				}
					  //___________________
					  
					  }
         }else{
			 $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '16:00:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'16:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','15:00:00','$stado','');");
					mysql_query($f); 
				  }  else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$fecha','18:30:00','$stado','');");
					mysql_query($g); 
				  }     
					}
				}
			 
			 }
		
		
		}
		}
	   //:::::::::::::::::::::::::::::CIERRO COMPARACION::::::::::::::::::::::::::::::::::::::::::::::
	  
		}	
	}
	
// Ejemplo de uso:

	
    exit;
}

 ?>
<html>
<title></title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<form method="post" action="" ><table width="804" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  <td colspan="10">Listado De Funcionarios</td>  </tr>
  <tr>
    <td width="96" height="30">&nbsp;</td>
   <td colspan="3" align="left"><h4>
     <label for="observaciones">Fecha Inicio:</label>
     <input type="date" name="inicio" id="inicio" />
     <label for="fin"> Fecha fin:</label>
     <input type="date" name="fin" id="fin" />
   </h4></td>
    <td width="62" colspan="3" >
    </td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td colspan="3" align="left"><h4>
      <label for="observaciones">Motivo permiso:</label>
      <input name="observaciones" type="text" id="observaciones" size="60"  required/>
    </h4></td>
    <td colspan="3" ></td>
    </tr>
     <tr>
    <td height="30">&nbsp;</td>
    <td colspan="3" align="left"><h4>
      <label for="select">Seleccionar tipo de permiso:</label>
      <select name="select" id="select">
<option value="A">ASISTENCIA</option>
<option value="V">VACACIONES</option>
<option value="BM">BAJA MEDICA</option>
<option value="P">PERMISOS</option>
<option value="C">COMISION</option>
<option value="AB">COMISION</option>
<option value="N">NUEVO</option>
<option value="-">-</option>
      </select>
  
    </h4></td>
    <td colspan="3" ></td>
    </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td colspan="3" align="center"><input type="button" name="button2" id="button2" value="--Salir--"onclick = "location='excepciones_asistencia.php'" />
        <input type="hidden" name="grabar" value="si" />
         <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
    <input type="submit" value="ENVIAR DATOS" /></td>
    <td colspan="3" ></td>
  </tr>
  </table> 
  </form>

<?  include("footer.php"); ?>
