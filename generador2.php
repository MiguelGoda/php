
<?php
include ('fpdf17/fpdf.php');
require_once("class/class.php");
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>

 <?php
        $pdf = new FPDF('L','mm','Legal');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B', 9);
		$pdf->Text(132,10,'CONTROL DE ASISTENCIA DIARIOS DE LOS TRABAJADORES');
	 	$pdf->Text(149,14,'SERVICIO DEPARTAMENTAL DE CAMINOS');
		$pdf->Text(166,18,'SEDCAM - PANDO');
		//$pdf->SetLineWidth(0.7);
		$pdf->Line(100,20,250,20);
		$pdf->SetXY(40,26);
		$pdf->SetFont('Arial','B', 8);
		$pdf->Ln();
		$pdf->Ln();

	$aux=$_GET['fin'];
	$fech = strtotime($aux);
	$d = date("n", $fech);
	if($d==1)$mes='ENERO'; if($d==2)$mes='FEBRERO'; if($d==3)$mes='MARZO'; if($d==4)$mes='ABRIL';
	if($d==5)$mes='MAYO'; if($d==6)$mes='JUNIO'; if($d==7)$mes='JULIO'; if($d==8)$mes='AGOSTO';
	if($d==9)$mes='SEPTIEMBRE'; if($d==10)$mes='OCTUBRE'; if($d==11)$mes='NOVIEMBRE'; if($d==12)$mes='DICIEMBRE';
	$pdf->Write(7,"REPORTE MENSUAL DEL MES DE: ".$mes."    ");
		$con=$_GET['con'];
    $pdf->Write(6,"FUNCIONARIOS DE CONTRATO: ".$con."    ");
$tra=new User();
$tr=new User();
$link=Conectarse();	
	 $nombre = $_GET['nombre'];
	 $u = $_GET['unidad'];
	  $BAJAMEDICA = $_GET['BM'];
	   $COMICION = $_GET['C'];
	    $VACIONES = $_GET['V'];
$RegistrosAMostrar =18;
if(isset($_GET['page'])) {
	$inicio=$_GET['inicio'];
	$fin=$_GET['fin'];
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    $PaginaActual=$_GET['page'];
	 $con = $_GET['con'];
	if($_GET['page']==0)
	{
    $RegistrosEmpezar=0;
    $PaginaActual=1;
	}
	
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
	 $inicio = $_GET['inicio'];
	 $fin = $_GET['fin'];
	  $con = $_GET['con'];
	 
} 
?>
 <?php
if($nombre=='admin'){
	$datos=$tra->get_biometrico_dist6($RegistrosEmpezar,$RegistrosAMostrar,$inicio,$fin,$con);
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno,p.ci AS CI, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona = b.nro
  AND p.contrato = '$con'
  AND c.id_persona = p.id_persona
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC",$link));
	
?>

<?php
}else{
	$datos=$tra->get_biometrico_dist6_user($u,$RegistrosEmpezar,$RegistrosAMostrar,$inicio,$fin,$con);
	
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno,p.ci AS CI, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona = b.nro
  AND p.contrato = '$con'
  AND
 c.id_persona = p.id_persona
 and p.id_unidad='$u'
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC",$link));
	
	
?>	
<?php
	}
?> 
 <?php    
$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;
?>
<?php
$pdf->Ln();
 $pdf->Cell(45,6.2, 'DIAS = Marcaciones Diarias ',1,0,'A');
$pdf->Cell(45,6.2, "FECHA INICIO: ".$_GET['inicio'],1,0,'A');
$pdf->Cell(45,6.2, "FECHA FIN: ".$_GET['fin'],1,0,'A');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(6,5.8, '#',1,0,'A');
		 $pdf->Cell(50,5.8, 'NOMBRES',1,0,'A');
		 $pdf->Cell(30,5.8, 'NIVEL',1,0,'A');
	 $pdf->Cell(50,5.8, 'CARGO',1,0,'A');
	 $pdf->Cell(20,5.8, 'CI',1,0,'A');
 //_______________________________________________________________________________________________________________
		 ?> 
         
         <?php	  
if(sizeof($datos)==0)
{ ?>
  <tr>
      <td colspan="8" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else
{
?>
   <?php
     $tr=new User();
  	 $fin=$_GET['fin'];
	 $inicio=$_GET['inicio'];
	 $id=$id=$datos[$i]["nombres"];
	 $sexo=$datos[$i]["sexo"];
     $dat=$tr->get_biometrico_fecha($inicio,$fin); 
	 ?>
     
    <?php
for($j=0;$j<(sizeof($dat));$j++)
{ 
$pdf->SetFont('Arial','B', 8);
$aux=$dat[$j]["fecha"];
$fech = strtotime($aux);
$d = date("N", $fech);
$nro = date("d", $fech);
 if($d==1) $d='L';
   if($d==2) $d='M';
   if($d==3) $d='M';
   if($d==4) $d='J';
   if($d==5) $d='V';
   if($d==6) $d='S';
   if($d==7) $d='D';
   $auxiliar = $d.''.$nro;  
   	//$pdf->SetFont('Arial','B', 5.5);
   // $pdf->Cell(4.6,8, $auxiliar,1,0,'A'); 
}
	$pdf->SetFont('Arial','B',8);
echo $pdf->Cell(10,5.8, "Dia",1,0,'A');
echo $pdf->Cell(12,5.8, "Faltas",1,0,'A');
//echo $pdf->Cell(12,8, "H Atraso",1,0,'A');
echo $pdf->Cell(22,5.8, "H Permiso",1,0,'A');
echo $pdf->Cell(22,5.8, "H Sancion",1,0,'A');
echo $pdf->Cell(20,5.8, "B Medicas",1,0,'A');
echo $pdf->Cell(30,5.8, "Comision",1,0,'A');
echo $pdf->Cell(30,5.8, "Vacaciones",1,0,'A');
$pdf->Ln();

?>
 <?php
 
for($i=0;$i<sizeof($datos);$i++)
{
 ?>
<?php 
$pdf->SetFont('Arial','B', 8);
	$nombre=$datos[$i]["nombre"].' '.$datos[$i]["ap_paterno"].' '.$datos[$i]["ap_materno"];
	$texto = utf8_decode($nombre);
	$NIVEL = utf8_decode($datos[$i]["NIVEL"]);
	$CARGO = utf8_decode($datos[$i]["CARGO"]);
	$cont=$i+1+(18*($PaginaActual-1));
	$pdf->Cell(6,5.5,$cont,1,0,'A');
    $pdf->Cell(50,5.5, $texto,1,0,'A');
    $pdf->Cell(30,5.5, $NIVEL,1,0,'A');
	$pdf->Cell(50,5.5, $CARGO,1,0,'A');
	$pdf->Cell(20,5.5, $datos[$i]["CI"],1,0,'A');
 // echo $pdf->Cell(50,4, $datos[$i]["dpto"],1,0,'A');
?>
  
   <?php
     $tr=new User();
	 $t=new User();
  	 $fin=$_GET['fin'];
	 $inicio=$_GET['inicio'];
	 $id=$id=$datos[$i]["nro"];
	  $sexo=$datos[$i]["sexo"];
     $dat=$tr->get_biometrico_fecha($inicio,$fin); 
	 ?>
     
        <?php
				$resul=0;
$otra=0;
 $BM=array();
  $C=array();
   $V=array();
     $total_faltas=0; $total_faltas_sabado=0;
for($j=0;$j<sizeof($dat);$j++)
{ 
$aux=$dat[$j]["fecha"];
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
 $productos=array();
 $var=0;
  $dia=0; $dia2=0; $tard=0;$tard2=0;
if(sizeof($d)==0)
{   
        if($d2 == 6 or $d2 == 7){
		if($sexo == "F" and $d2 == 6)  'sab'.$resul = $resul + 0; 
		if($sexo == "M" and $d2 == 6)  'sab'.$resul = $resul + 0.5;
		if($d2==7)  'dom'.$resul = $resul + 0;
		}  else 	 $resul = $resul + 1;
 }else{
	 	 $otra=1;
	
	 $dia=0; $dia2=0; $tard=0;$tard2=0;
    for($k=0;$k<sizeof($d);$k++)
{
$productos[]=$d[$k]["OBSERVACION"];
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
	    $aux2 = $d[$k]["FECHA"];
       $fech2 = strtotime($aux2);
          $d3 = date("d", $fech2);
		$V[] = $d3;
		}

	//para las 8
		if($d2 == 6){
				//_______________ ABRE SABADO HOMBRES________________
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["entrada1"]) - (120*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["entrada1"]) + (120*60) ) 					            { 
if($pat[0]["nom_horario"]=='SERENOS'){ $otra=$otra-0.5;}
			$dia=1; 
			$otra=$otra-0.5;
			}  
if(strtotime($d[$k]["HORA"]) > strtotime("12:00:00") - (35*60) && strtotime($d[$k]["HORA"]) < strtotime("12:00:00") + (100*60) && $dia==1 ) { 
                     $dia2=1;
    	 			 $otra=$otra-0.5;
				 } 
			}else{
		
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["entrada1"]) - (90*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["entrada1"]) + (90*60) ) { 
				  $dia=1;
				  if($pat[0]["nom_horario"]=='SERENOS'){ $otra=$otra-1; }
				    if($pat[0]["nom_horario"] == 'Horario Continuo'){ $otra=$otra-0.5; }				   }  
if(strtotime($d[$k]["HORA"]) > strtotime($pat[0]["salida1"]) - (30*60) && strtotime($d[$k]["HORA"]) < strtotime($pat[0]["salida1"]) + (89*60) && $dia==1 ) { 
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
}$total_faltas= $otra + $total_faltas;
	
} 


		  //$pdf->SetFont('Arial','B',5.5);	
		  if($productos[0]== '-'){
			 //  $pdf->Cell(4.6,6,$productos[0],1,0,'A');
			  }
		  else{
   		  //$pdf->Cell(4.6,6,($dia+$dia2).'-'.($tard+$tard2),1,0,'A');
			  }
}		
?>
<?php
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Arial','B',7.5);
  $pdf->Cell(10,5.5,$datos[$i]["DIAS_PAGO"],1,0,'C');
  $nuevodia = 30-$datos[$i]["DIAS_PAGO"];
  $pdf->Cell(12,5.5,((($resul+$total_faltas)*($datos[$i]["TIPO_DESCUENTO"]))),1,0,'C');
    $cuatro=$datos[$i]["FALTAS"]; 
   $tres=$datos[$i]["ATRASOS"]; 
 $dos=$datos[$i]["ATRASO"];
 
 //<!--HORA PERMISOS-->
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

    
 //<!--CIERRA PERMISOS-->
 $resul = ($cuatro*4)+($tres*3)+($dos*2);
  $resul=$resul*60;
  
   $resul = ($cuatro*4)+($tres*3)+($dos*2);
   $resul=($resul*60)+($nuevo_resultado);
  $hora=floor($resul/60);
  $minu=floor($resul-($hora*60));
 $pdf->Cell(22,5.5,$hora.'.'.$minu,1,0,'C');  
 
 //____________HORAS DE SANCION
 $SAM=new User();
$AL=$SAM->get_horas_sancion($id2, $inicio, $fin);
$SANCION=$AL[0]["tiempo"];
//CIERRA HORAS DE SANCION  
  
    $pdf->Cell(22,5.5,$SANCION,1,0,'C');
  
 //__________COMIENZO VECTORES BM C V____________________
 $BM2=array();
  $BM3=array();
for($f=0; $f<count($BM); $f++) {
	  if($BM[$f+1]-$BM[$f] == 1 or $BM[$f+1]-$BM[$f] == 0 or $BM[$f+1]-$BM[$f] == 2) $BM2[]=$BM[$f];
	   else{  $BM3[]=(($BM2[0])).'-'.(end($BM2).'/');		 $BM2=array();  }
}
	 $C2=array();
	  $C3=array();
for($f=0; $f<count($C); $f++) {
	  if($C[$f+1]-$C[$f] == 1 or $C[$f+1]-$C[$f] == 0 or $C[$f+1]-$C[$f] == 2) $C2[]=$C[$f];
	   else{  $C3[]=(($C2[0])).'-'.(end($C2).'/');	 $C2=array();  }
}

 $V2=array();
 $V3=array();
for($f=0; $f<count($V); $f++) {
	  if($V[$f+1]-$V[$f] == 1 or $V[$f+1]-$V[$f] == 0 or $V[$f+1]-$V[$f] == 2) $V2[]=$V[$f];
	   else{   $V3[] =(($V2[0])).'-'.(end($V2).'/');	 $V2=array();}
}
$baja = implode($BM3);
$comi = implode($C3);
$vaca = implode($V3);

  echo $pdf->Cell(20,5.5,$baja,1,0,'C');
  echo $pdf->Cell(30,5.5,$comi,1,0,'C');
  echo $pdf->Cell(30,5.5,$vaca,1,0,'C');
  //___________FIN VECTORES BM C V______________________
 $pdf->Ln(); //salto de linea
 ?>         
  <?php } }?>           
         <?php
//______________________________________________________________________________________________________________
		  $pdf->Output("Reporte-Gral.pdf",'D');
		exit;
		
	?>
