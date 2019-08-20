<?php include("menuadmin.php"); ?>
<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
</head>
<body>  
<table  class="altrowstable" id="alternatecolor" align="center" >
<!--PRUEBA DE REPORTES MENSULASE CON PAGINACION-->
  <td align="center">Reporter Detallado Mensual
<form method="GET" action="generador.php">
<input type="hidden" name="BM" value="<?php echo $_GET['BM']; ?>">
<input type="hidden" name="C" value="<?php  echo $_GET['C']; ?>">
<input type="hidden" name="V" value="<?php  echo $_GET['V']; ?>">
<input type="hidden" name="inicio" value="<?php echo $_GET['inicio']; ?>">
<input type="hidden" name="fin"  value="<?php echo $_GET['fin']; ?>">
<input type="hidden" name="page"  value="<?php echo $_GET['page']; ?>">
<input type="hidden" name="nombre"  value="<?php echo $nom[0]["nombres"]; ?>">
<input type="hidden" name="unidad"  value="<?php echo $nom[0]["id_unidad"]; ?>">
 <input type="image" name="buscar" src="imagenes/pdf.png" width="50" height="50" value="exportar" > 
  </form>
   </td>
   <td align="center">Reporte General Mensual contratos fijo
  <form method="GET" action="generador2.php">
<input type="hidden" name="inicio" value="<?php echo $_GET['inicio']; ?>">
<input type="hidden" name="fin"  value="<?php echo $_GET['fin']; ?>">
<input type="hidden" name="page"  value="<?php echo $_GET['page']; ?>">
<input type="hidden" name="nombre"  value="<?php echo $nom[0]["nombres"]; ?>">
<input type="hidden" name="con"  value="FIJO">
<input type="hidden" name="unidad"  value="<?php echo $nom[0]["id_unidad"]; ?>">
<input type="image" name="buscar" src="imagenes/pdf.png" width="50" height="50" value="exportar" > 
  </form>
   </td>
     <td align="center">Reporte General Mensual Contratos Eventaual
<form method="GET" action="generador2.php">
<input type="hidden" name="inicio" value="<?php echo $_GET['inicio']; ?>">
<input type="hidden" name="fin"  value="<?php echo $_GET['fin']; ?>">
<input type="hidden" name="page"  value="<?php echo $_GET['page']; ?>">
<input type="hidden" name="nombre"  value="<?php echo $nom[0]["nombres"]; ?>">
<input type="hidden" name="con"  value="EVENTUAL">
<input type="hidden" name="unidad"  value="<?php echo $nom[0]["id_unidad"]; ?>">
<input type="image" name="buscar" src="imagenes/pdf.png" width="50" height="50" value="exportar" > 
  </form>
   </td>
</table>
<table  class="altrowstable" id="alternatecolor" >
 <?php
$tra=new User();
$tr=new User();
$link=Conectarse();	
$RegistrosAMostrar=20;
if(isset($_GET['page'])) {
	$inicio=$_GET['inicio'];
	$fin=$_GET['fin'];
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    $PaginaActual=$_GET['page'];	
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
	 $inicio = $_GET['inicio'];
	 $fin = $_GET['fin'];
} 
?>
 <?php
if($nom[0]["nombres"]==$admin){
$datos=$tra->get_biometrico_dist5($RegistrosEmpezar,$RegistrosAMostrar,$inicio,$fin);
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno,p.ci AS CI, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona = b.nro AND
 c.id_persona = p.id_persona
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC",$link));	

}else{
	$datos=$tra->get_biometrico_dist5_user($nom[0]["id_unidad"],$RegistrosEmpezar,$RegistrosAMostrar,$inicio,$fin);
	$u=$nom[0]["id_unidad"];
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno,p.ci AS CI, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona = b.nro AND
 c.id_persona = p.id_persona
 and p.id_unidad='$u'
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC",$link));
	}
?> 
 <?php  
  
$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;
?> 
<!--CIERRA PRUEBA DE REPORTES MENSUALES CON PAGINACION-->
  <?php	  

if(sizeof($datos)==0)
{
    ?>
    
  <tr  >
      <td colspan="9" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else
{
?>
 <?php
for($i=0;$i<sizeof($datos);$i++)
{
if($i==0){
 ?>

<tr style="padding: 4px; font-size: 11px; background-color: #83aec0; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #FFFFFF; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #558FA6; border-bottom-color: #558FA6; font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;" >
<td><strong>N#</strong></td>
 <td   width="200"><strong>&nbsp;&nbsp;Nombres&nbsp;</strong></td>
  <td   width="200"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nivel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
   <td   width="150"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cargo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td   width="80"><strong>&nbsp;&nbsp;&nbsp;Nro.&nbsp;&nbsp;&nbsp;<BR>&nbsp;&nbsp;&nbsp; CI&nbsp;&nbsp;&nbsp;</strong></td>
 <?php
  $tr=new User();
  $dtr=$tr->get_biometrico_fecha($inicio,$fin); 
  
  for($ji=0;$ji<sizeof($dtr);$ji++)
{ 

$aux=$dtr[$ji]["fecha"];
$fech = strtotime($aux);
$d = date("N", $fech);
$nro = date("d", $fech);
   if($d==1){echo '<td   width="40" ><strong>'; $d='L';}
   if($d==2) {echo '<td   width="40" ><strong>';$d='M';}
   if($d==3) {echo '<td   width="40" ><strong>';$d='M';}
   if($d==4) {echo '<td   width="40" ><strong>';$d='J';}
   if($d==5) {echo '<td   width="40" ><strong>';$d='V';}
   if($d==6){echo '<td   width="40" style="padding: 5px; font-size: 12px; background-color: #83aec0; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #FFFFFF; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #558FA6; border-bottom-color: #558FA6; font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;" ><strong>'; $d='S';}
   if($d==7){echo '<td   width="40" style="padding: 5px; font-size: 12px; background-color: #83aec0; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #FFFFFF; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #558FA6; border-bottom-color: #558FA6; font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;" ><strong>'; $d='D';}
 echo $d.'<BR>'.$nro;
 echo '</strong></td>';
}?>
<td   width="50"><strong>Dias</strong></td>
<td   width="50"><strong>Faltas</strong></td>
<td   width="90"><strong>Hrs Sancion</strong></td>
 <td   width="90"><strong>Hrs Atraso</strong></td>
 <td   width="90"><strong>Hrs Permisos</strong></td>
  <td   width="80"><strong>Bajas<BR>Medicas</strong></td>
   <td   width="80"><strong>Fechas<BR>Camision</strong></td>
   <td   width="100"><strong>Vacaciones</strong></td>
 </tr>  
  <?php }?>
  
<tr width='20' onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#d4e3e5';" style='padding: 5px; font-size: 12px; background-color: #D2F3F1; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #000000; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #D2F3F1; border-buttom-color:#D2F3F1 font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;'>
<td   width="100"><font face="serif" size="-1"><?php echo $i+1+(20*($PaginaActual-1));   ?></font></td>
  <td   width="100"><font face="serif" size="-1"><?php echo $datos[$i]["nombre"].' '.$datos[$i]["ap_paterno"].' '.$datos[$i]["ap_materno"];
   ?></font></td>
  <td   width="100"><font face="serif" size="-1">
    <?php   echo $datos[$i]["NIVEL"];?>
  </font></td>
   <td   width="100"><font face="serif" size="-1">
     <?php   echo $datos[$i]["CARGO"];?>
   </font></td>
    <td   width="100"><font face="serif" size="-1">
      <?php   echo $datos[$i]["CI"];?>
    </font></td>
 
   <?php
     $tr=new User();
  	 $fin=$_GET['fin'];
	 $inicio=$_GET['inicio'];
	 $id=$datos[$i]["nro"];
	 $sexo=$datos[$i]["sexo"];
     $dat=$tr->get_biometrico_fecha($inicio,$fin); 
	 ?>
     
        <?php
		$resul=0;
		$DOM=0;
$var=0;
$var2=0;
 $BM=array();
 $C=array();
 $V=array();
 $SUM=0;
  $N=0;
  $total_faltas=0; $total_faltas_sabado=0;
for($j=0;$j<sizeof($dat);$j++)
{ 
$aux=$dtr[$j]["fecha"];
$fech = strtotime($aux);
$d2 = date("N", $fech);
$nro = date("d", $fech);

$TOTALASISTENCIAS = $j+1;
$confecha =$dat[$j]["fecha"];
	///ABRIR INSERTAR HORARIOS
		$tra=new User(); $tr=new User(); 
		$patos=$tra->get_tabla_id("id_persona",$id,"persona");
	  	$horario =$patos[0]["id_horario"];  
	  	$pat=$tr->get_tabla_id("id_horario",$horario,"horarios");
		///CERRAR INSERTAR HORARIOS       
 $t=new User();
 $d=$t->get_biometrico_com($confecha,$id);
 
 if($d2==6 or $d2==7){echo "<td width='20' style='padding: 5px; font-size: 12px; background-color: #83aec0; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #FFFFFF; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #558FA6; border-bottom-color: #558FA6; font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;'>";
           }else echo "<td width='20' style='padding: 5px; font-size: 12px; background-color: #D2F3F1; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #000000; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #D2F3F1; border-buttom-color:#D2F3F1 font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;'>";
 $imprime_observaciones=array();
if(sizeof($d)==0)
{   
//echo $sexo.'--'.$d2;
 
       if($d2 == 6 or $d2 == 7){
		if($sexo == "F" && $d2 == 6)  $resul = $resul - 0; 
		if($sexo == "M" && $d2 == 6) $resul = $resul + 0.5; 
		if($d2==7){  $resul = $resul - 0; }
		}else 	 $resul = $resul + 1;
 }else{
	 $var=0;
	 $man=0;
	 $tarde=0;
	 $otra=1;
	
	 $dia=0; $dia2=0; $tard=0;$tard2=0;
    for($k=0;$k<sizeof($d);$k++)
  {	  
 $imprime_observaciones[]=$d[$k]["OBSERVACION"];
      if($d[$k]["OBSERVACION"]=="N"){
	    $N=1+$N;
		}
	
	if($d[$k]["OBSERVACION"]=="BM"){
	    $aux2 = $d[$k]["FECHA"];
        $fech2 = strtotime($aux2);
        $d3 = date("d", $fech2);
		$BM[] = $d3;
		}
		if($d[$k]["OBSERVACION"]=="C"){
	    $aux2 = $d[$k]["FECHA"];
        $fech2 = strtotime($aux2);
        $d3 = date("d", $fech2);
		$C[] = $d3;
			}
		if($d[$k]["OBSERVACION"]=="V"){
	    $aux2  = $d[$k]["FECHA"];
        $fech2 = strtotime($aux2);
        $d3 = date("d", $fech2);
		$V[] = $d3;
			}
			if($d[$k]["OBSERVACION"]=="AB"){
	   $SUM=$SUM+1;
			}
		//para las 8
		//abre sabado
		if($d2 == 6 or $d2 == 7 ){
			if($d2 == 6){
				//echo $d[$k]["HORA"];
				//_______________ ABRE SABADO HOMBRES________________
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["entrada1"]) - (120*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["entrada1"]) + (120*60) ){ 
if($pat[0]["nom_horario"]=='SERENOS'){ $otra=$otra-0.5;}
			$dia=1; 
			$otra=$otra-0.5;
			}  
if(strtotime($d[$k]["HORA"]) > strtotime("12:00:00") - (35*60) && strtotime($d[$k]["HORA"]) < strtotime("12:00:00") + (120*60) && $dia==1 ) { 
                     $dia2=1;
    	 			 $otra=$otra-0.5;
				 } 
				//__________________CIERRA SABADO_____________
			   }else 'no';
			}
		//para cierr sabado	
			else{
			
		 //__________PRUEBA CON NUMEROS______________
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["entrada1"]) - (90*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["entrada1"]) + (90*60) ) { 
				 
				  if($pat[0]["nom_horario"]=='SERENOS'){ $otra=$otra-1; }
				  if($pat[0]["nom_horario"] == 'Horario Continuo'){  $otra=$otra-0.5; }
				   $dia=1; 

				   }  
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["salida1"]) - (30*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["salida1"]) + (100*60) && $dia==1 ) { 
    	 			 $dia2=1; 
					$otra=$otra-0.5;
				 } 
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["entrada2"]) - (70*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["entrada2"]) + (45*60) ) { 
    	 			 $tard = 2;
				 }  
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["salida2"]) - (30*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["salida2"]) + (180*60) && $tard==2 ) { 
    	 			 $tard2 = 2; 
					 $otra=$otra-0.5;
				 }	 
		//CIERRA PRUEBA CON NUMEROS
		}
		//imprimir reportes de personal nuevo
		
		//cierra reportes de personal nuevo
}

/////___________________________________
if($imprime_observaciones[0]== '-'){echo $imprime_observaciones[0];}else{
 echo ($dia+$dia2).'-'.($tard+$tard2);}
 
 
 $total_faltas= $otra + $total_faltas;
 
//////__________________________________
}
echo "</td>";
}
?>

<td  width="50" align="center"><?php  echo $datos[$i]["DIAS_PAGO"]; ?>
</td>
<td  width="50" align="center">
<?php  $nuevodia = 30-$datos[$i]["DIAS_PAGO"];

 echo "&nbsp;".((($resul+$total_faltas)*($datos[$i]["TIPO_DESCUENTO"])))."&nbsp;";?>
 </td>
<?php  $cuatro=$datos[$i]["FALTAS"]; ?>
  <?php $tres=$datos[$i]["ATRASOS"]; ?>
 <?php $dos=$datos[$i]["ATRASO"]; ?>
 
 <!--HORA PERMISOS-->
 <?php 
    
$id2=$datos[$i]["nro"];
$tr=new User();
$dato=$tr->get_biometrico_dist3_salidas_id_2($id2, $inicio, $fin);
$resultado_permiso=0;
$nuevo_resultado=0;
for($j=0;$j<sizeof($dato);$j++)
{
	if(($dato[$j]["tipo_tramite"])=="PARTICULAR")$resultado_permiso = $resultado_permiso + ($dato[$j]["total_horas"]);
}
  if($resultado_permiso > 120) $nuevo_resultado=$resultado_permiso-120;

    ?>
 <!--CIERRA PERMISOS-->
  <td  width="100" align="center"><?php
  //____________HORAS DE SANCION
 $SAM=new User();
$AL=$SAM->get_horas_sancion($id2, $inicio, $fin);
$SANCION=$AL[0]["tiempo"];
//CIERRA HORAS DE SANCION
echo $SANCION;
?></td>
 <td  width="100" align="center"><?php 
  $resul = ($cuatro*4)+($tres*3)+($dos*2) ; 
  $resul=$resul*60;
  $hora=floor($resul/60);
  $minu=floor($resul-($hora*60));
  echo $hora.'.'.$minu;
  ?></td>
   <td  width="100" align="center"><?php 
   $hor=floor($nuevo_resultado/60);
   $min=floor($nuevo_resultado-($hor*60));
   echo $hor.'.'.$min;
  ?></td>
   <td  width="100" align="center"> <?php
   //_______________________ABRE
   $BM2=array();
   $BM3=array();
for($f=0; $f<count($BM); $f++) {
	  if($BM[$f+1]-$BM[$f] == 1 or $BM[$f+1]-$BM[$f] == 0 or $BM[$f+1]-$BM[$f] == 2) $BM2[]=$BM[$f];
	   else{ $BM3[] =(($BM2[0])).' '.(end($BM2)); $BM2=array();  }
}
      echo $baja=implode($BM3);
    ?></td>
    <td  width="80" align="center"> <?php
	 $C2=array();
	 $C3=array();
for($f=0; $f<count($C); $f++) {

	  if($C[$f+1]-$C[$f] == 1 or $C[$f+1]-$C[$f] == 0 or $C[$f+1]-$C[$f] == 2) $C2[]=$C[$f];
	   else{ $C3[]=(($C2[0])).'-'.(end($C2)).' / ';	 $C2=array();
			  }
} echo $comi=implode($C3);
	
	 ?></td>
     <td  width="80" align="center"> <?php
	 	 $V2=array();
		  $V3=array();
for($f=0; $f<count($V); $f++) {
	  if($V[$f+1]-$V[$f] == 1 or $V[$f+1]-$V[$f] == 0 or $V[$f+1]-$V[$f] == 2){   $V2[]=$V[$f];  } 
	   else{ $V3[]=(($V2[0])).'-'.(end($V2)).' / ';		 $V2=array();
			  }
}echo $vaca=implode($V3); 
	  ?></td>
 </tr>         
  <?php } ?>
  
  <tr valign="top"><td colspan="30" align="center"><h4><strong> <?php if($Respuesta>0) $UltimaPagina=floor($UltimaPagina)+1;
echo "<a href=\"reporte_mensual.php?inicio=".$_GET["inicio"]."&fin=".$_GET["fin"]."\">Inicio</a> |";
if($PaginaActual>1) echo "<a href=\"reporte_mensual.php?inicio=".$_GET["inicio"]."&fin=".$_GET["fin"]."&page=".$PaginaAnteior."\">Anterior</a> |"; echo "<b>(".$PaginaActual." / ".$UltimaPagina.")</b> |";
if($PaginaActual<$UltimaPagina)  echo " <a href=\"reporte_mensual.php?inicio=".$_GET["inicio"]."&fin=".$_GET["fin"]."&page=".$SiguientePagina."\">Siguiente</a> |";
echo "<a href=\"reporte_mensual.php?inicio=".$_GET["inicio"]."&fin=".$_GET["fin"]."&page=".$UltimaPagina."\">Ultima</a>";?> </strong></h4></td></tr>
  </table>
<?  }include("footer.php"); ?>