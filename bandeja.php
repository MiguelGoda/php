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
$link=Conectarse();	
$RegistrosAMostrar = 50;
if(isset($_GET['page'])) {
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    $PaginaActual=$_GET['page'];
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
}
$fecha_fin=date('Y-m-d'); 
$fecha_inicio = strtotime ( '-3 day' , strtotime ( $fecha_fin ) ) ;
$fecha_inicio = date ( 'Y-m-j' , $fecha_inicio );
/*$fecha_inicio='2015-04-14';
$fecha_fin='2015-04-17';*/
$tr=new User();
if($nom[0]["nombres"]==$admin)
{
$dtr=$tr->get_biometrico_fecha_final($fecha_inicio,$fecha_fin,$RegistrosEmpezar,$RegistrosAMostrar); 
$NumeroRegistros=mysql_num_rows(mysql_query("select fecha, nro 
											from biometrico 
											where fecha >= '$fecha_inicio' 
											AND fecha <= '$fecha_fin'
											AND estado != 'visto' 
											GROUP BY nro, fecha 
											HAVING COUNT(nro)<=3 
											ORDER BY nro ASC ",$link));
}
else{
	$u=$nom[0]["id_unidad"];
	$dtr=$tr->get_biometrico_fecha_final_user($u,$fecha_inicio,$fecha_fin,$RegistrosEmpezar,$RegistrosAMostrar); 
$NumeroRegistros=mysql_num_rows(mysql_query("select b.fecha, b.nro 
											from biometrico b, persona p
											where b.fecha >= '$fecha_inicio' 
											AND b.fecha <= '$fecha_fin'
											AND b.estado != 'visto' 
											AND p.id_unidad = '$u'
											AND p.id_persona = b.nro
											GROUP BY b.nro, b.fecha 
											HAVING COUNT(b.nro)<=3 
											ORDER BY b.nro ASC ",$link));
	}
					
$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;

?>
<body onload="deseleccionar_todo();">
<form name="form" method="post" action="vaciar_bandeja.php">
<table width="650" border="0" align="center" cellpadding="0">
<tr bgcolor="#B6F3E6">
<td   width="50"><strong>#</strong></td>
 <td   width="300"><strong>Nombres</strong></td>
  <td   width="100"><strong>Fecha</strong></td>
   <td   width="100"><strong>Observacion</strong></td>
   <td   width="100"><strong>Selec</strong></td>
</tr>
 <?php
 $con=0;
 	 for($ji=0;$ji<sizeof($dtr);$ji++){
  		$var_nro=$dtr[$ji]["nro"]; 
   		$fech=$dtr[$ji]["fecha"];
	
	 		$tr_n=new User();
	   		$dt=$tr_n->get_biometrico_con_reg($fech, $var_nro); 	 
	    	   $atrasos=$dt[0]["TOTAS_DIARIA"];
			$confecha=$dt[0]["fecha"];
			$id=$dt[0]["nro"];
			
			if ($i%2==0){
	?>
    <tr bgcolor="#D8F6F8" onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#F4F7EB';" style="font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif; color:#000000; size:12px" >
    <?php
}else{
	?>
   <tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#F5E68E';">
   <?php
}

		echo '<td>'.$con=$con+1 .'</td>';	
		echo '<td>'.$dt[0]["nombres"].' '.$dt[0]["ap_paterno"].' '.$dt[0]["ap_materno"].'</td>'; 
		echo '<td>'.$confecha.'</td>'; 
		echo '<td>';
		///ABRIR INSERTAR HORARIOS
		$tra=new User(); $tr=new User(); 
		$datos=$tra->get_tabla_id("id_persona",$id,"persona");
	  	$horario =$datos[0]["id_horario"];  
	  	$dat=$tr->get_tabla_id("id_horario",$horario,"horarios");
		///CERRAR INSERTAR HORARIOS       
			 $ts=new User();
             $ds=$ts->get_biometrico_com($confecha,$id);
			 $dia=0; $dia2=0; $tard=0;$tard2=0;
			   for($st=0;$st<sizeof($ds);$st++){
				  //__________PRUEBA CON NUMEROS______________
if(strtotime($ds[$st]["HORA"]) > strtotime($dat[0]["entrada1"]) - (45*60) && strtotime($ds[$st]["HORA"]) < strtotime($dat[0]["entrada1"]) + (45*60) ) { 
				  $dia=1;
				   }  
if(strtotime($ds[$st]["HORA"]) > strtotime($dat[0]["salida1"]) - (30*60) && strtotime($ds[$st]["HORA"]) < strtotime($dat[0]["salida1"]) + (89*60) && $dia==1 ) { 
    	 			 $dia2=1;
				 } 
if(strtotime($ds[$st]["HORA"]) > strtotime($dat[0]["entrada2"]) - (60*60) && strtotime($ds[$st]["HORA"]) < strtotime($dat[0]["entrada2"]) + (45*60) ) { 
    	 			 $tard=2;
				 }  
if(strtotime($ds[$st]["HORA"]) > strtotime($dat[0]["salida2"]) - (30*60) && strtotime($ds[$st]["HORA"]) < strtotime($dat[0]["salida1"]) + (45*60) && $tard==2 ) { 
    	 			 $tard2=2;
				 }
				
				   }
				   echo ($dia+$dia2).''.($tard+$tard2);
				   ?>		    		
		</td>
		<td>
        <input type="checkbox" name="checkbox[]" value="<?php echo $dt[0]["nro"]; ?>" />
         <input type="hidden" name="fecha[]" value="<?php echo $confecha; ?>" />
        </td>
			</tr>
               <?php }	?>
        <tr>
<td colspan="4"  align="right">
 <input name="bandera" type="hidden" id="bandera" value="1" />
<input type="submit" value="Vaciar Datos" title="Asistencia" />
&nbsp;&nbsp;||&nbsp;&nbsp; 
<input type="button" value="Seleccionar Todo" title="Seleccionar Todo" onclick="seleccionar_todo();" />
&nbsp;&nbsp;||&nbsp;&nbsp;
<input type="button" value="Deseleccionar Todo" title="Deseleccionar Todo" onclick="deseleccionar_todo();" />
</form>
</div> 
</td></tr
><tr valign="top"><td colspan="6" align="center"><h4><strong> <?php if($Respuesta>0) $UltimaPagina=floor($UltimaPagina)+1;
echo "<a href=\"bandeja.php\">Inicio</a> |";
if($PaginaActual>1) echo "<a href=\"bandeja.php?page=".$PaginaAnteior."\">Anterior</a> |";echo "<b>(".$PaginaActual." / ".$UltimaPagina.")</b> |";
if($PaginaActual<$UltimaPagina)  echo " <a href=\"bandeja.php?page=".$SiguientePagina."\">Siguiente</a> |";
echo "<a href=\"bandeja.php?page=".$UltimaPagina."\">Ultima</a>";?> </strong></h4></td></tr>
        </table>
<?  include("footer.php"); ?>
