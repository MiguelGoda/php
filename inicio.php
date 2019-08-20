<? include("menuadmin.php"); ?>
<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$user="root";
$link=mysql_connect($host,$user,"admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>

<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
div.MsoNormal {	margin-right:0pt;
	text-indent:0pt;
	margin-top:0pt;
	margin-bottom:0pt;
	text-align:left;
	font-family:Tahoma;
	font-size:8pt;
	color:black;
}
li.MsoNormal {	margin-right:0pt;
	text-indent:0pt;
	margin-top:0pt;
	margin-bottom:0pt;
	text-align:left;
	font-family:Tahoma;
	font-size:8pt;
	color:black;
}
p.MsoNormal {	margin-right:0pt;
	text-indent:0pt;
	margin-top:0pt;
	margin-bottom:0pt;
	text-align:left;
	font-family:Tahoma;
	font-size:8pt;
	color:black;
}
</style>
</head>
<body>
<?php
extract($_POST);
if ($action == "upload") //si action tiene como valor UPLOAD haga algo (el value de este hidden es es UPLOAD iniciado desde el value
{
//cargamos el archivo al servidor con el mismo nombre(solo le agregue el sufijo bak_)
$archivo = $_FILES['excel']['name']; //captura el nombre del archivo
$tipo = $_FILES['excel']['type']; //captura el tipo de archivo (2003 o 2007)

$destino = "bak_".$archivo; //lugar donde se copiara el archivo

if (copy($_FILES['excel']['tmp_name'],$destino)) //si dese copiar la variable excel (archivo).nombreTemporal a destino (bak_.archivo) (si se ha dejado copiar)
{
echo "Archivo Cargado Con Exito";
}
else
{
echo "Error Al Cargar el Archivo";
}

////////////////////////////////////////////////////////
if (file_exists ("bak_".$archivo)) //validacion para saber si el archivo ya existe previamente
{
/*INVOCACION DE CLASES Y CONEXION A BASE DE DATOS*/
/** Invocacion de Clases necesarias */
require_once('Classes/PHPExcel.php');
require_once('Classes/PHPExcel/Reader/Excel2007.php');
//DATOS DE CONEXION A LA BASE DE DATOS
$cn = mysql_connect ("localhost","root","admin") or die ("ERROR EN LA CONEXION");
$db = mysql_select_db ("db_asistencia",$cn) or die ("ERROR AL CONECTAR A LA BD");

// Cargando la hoja de calculo
$objReader = new PHPExcel_Reader_Excel2007(); //instancio un objeto como PHPExcelReader(objeto de captura de datos de excel)
$objPHPExcel = $objReader->load("bak_".$archivo); //carga en objphpExcel por medio de objReader,el nombre del archivo
$objFecha = new PHPExcel_Shared_Date();

// Asignar hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0); //objPHPExcel tomara la posicion de hoja (en esta caso 0 o 1) con el setActiveSheetIndex(numeroHoja)

// Llenamos un arreglo con los datos del archivo xlsx
$i=1; //celda inicial en la cual empezara a realizar el barrido de la grilla de excel
$param=0;
$contador=0;
$tra=new User();
$tr=new User();
$tp=new User();
 $cero=0;

while($param==0) //mientras el parametro siga en 0 (iniciado antes) que quiere decir que no ha encontrado un NULL entonces siga metiendo datos
{
$dpto=$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
$nombres=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
$nro=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
$fechaexcel=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
 //$hora=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
//************************************************************************************************
// utilizo la funci?n y obtengo el timestamp
$timestamp = PHPExcel_Shared_Date::ExcelToPHP($fechaexcel);
$fecha = gmdate("Y-m-d",$timestamp);
$hora = gmdate("H:i:s",$timestamp);
$horaatual = strtotime("$hora");
  $cero=0;
        $fech = strtotime($fecha);
        $d = date("N", $fech);
		$datos=$tra->get_tabla_id("id_persona",$nro,"persona");
	  $horario =$datos[0]["id_horario"];
	 $tra=new User(); 
	   
	  $dat=$tr->get_tabla_id("id_horario",$horario,"horarios");
	   $tr=new User();   
	   $observacion="A";
		if($d==7) ;
		if($d==6){
			//___________ABRE
			if($horaatual >  strtotime($dat[0]["entrada1"]) + (71*60) && $horaatual <  strtotime("12:00:00") - (30*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (71*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))){
    $observacion ="F1";$cero=0;}

if($horaatual >  strtotime($dat[0]["entrada1"]) + (81*60) && $horaatual <  strtotime("12:00:00") - (30*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (81*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))) {
  	$observacion ="F2";$cero=0;}

if($horaatual >  strtotime($dat[0]["entrada1"]) + (91*60) && $horaatual <  strtotime("12:00:00") - (30*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (91*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))){
    $observacion ="F3";$cero=0;}

if($horaatual >  strtotime($dat[0]["entrada1"]) + (101*60) && $horaatual <  strtotime("12:00:00") - (60*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (101*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))){
    $cero=1;}
if($horaatual == strtotime("00:00:00")) {
    $cero=1;}
$link=Conectarse();
   $sqlver=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora = '$hora'",$link);
   if (mysql_fetch_array($sqlver) == $cero) {
//________________________________________COMPARO REGISTROS DUPLICADOS________________________________________
$ver=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora < '11:00:00'",$link);
   if ((mysql_fetch_array($ver) == 0)) {
	   	   if($hora<'10:00:00'){
$c1=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
mysql_query($c1);  
		      }else{
		   //___________________HORA 1::::::::::::::::::::::
				$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '11:00:00' AND hora < '14:00:00'",$link);
  		 			if (mysql_fetch_array($ver2) == 0) {
			  		if($hora > '11:00:00' && $hora<'14:00:00'){
				  $e=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
						mysql_query($e); 
						}else{
		//___________________
					   	$ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:00:00'",                      	$link);				
						//abre-------
  		 					if (mysql_fetch_array($ver3) == 0) {
		          				if($hora > '13:50:00' && $hora<'17:30:00'){
				  					//$f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
										mysql_query($f); 
				  		       }else{
					  
					           $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 			       if (mysql_fetch_array($ver2) == 0) {
		                         if($hora > '17:50:00' && $hora <'22:00:00'){
				 // $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
								mysql_query($g); 
				  			   }   }   }   }
					 //cierra------------
			              else{
			                 $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			               if (mysql_fetch_array($ver2) == 0) {
		                  if($hora > '17:50:00' && $hora <'22:00:00'){
				  //$g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
				       	mysql_query($g); 
				          }     
					   }
				     }
					  //___________________
					  
					  }
         }else{
			 $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:30:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'17:30:00'){
				  //$f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($f); 
				  }  else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  //$g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  //$g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($g); 
				  }     
					}
				}
			 
			 }
				
		 //__________________FIN HORA1::::::::::::::::::::::
             
		   }}else{
		$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '11:30:00' AND hora < '14:00:00'",$link);
  		 if (mysql_fetch_array($ver2) == 0) {
			  if($hora > '11:00:00' && $hora<'14:00:00'){
				$e=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($e); 
				  }else{
					  //___________________
					   $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:00:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'17:30:00'){
				  //$f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($f); 
				  } else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  //$g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  //$g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");//ste funciona para las 6
					mysql_query($g); 
				  }     
					}
				}
					  //___________________
					  
					  }
         }else{
			 $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:30:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'17:30:00'){
				  //$f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($f); 
				  }  else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				   //$g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  //$g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion');");
					mysql_query($g); 
				  }     
					}
				
	 }     
					} }     
					}
			//___________CIERRA
			
			}else{ 
			//_______________________________________________________________

//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;NUEVOS HORARIOS;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

if($horaatual >  strtotime($dat[0]["entrada1"]) + (11*60) && $horaatual <  strtotime($dat[0]["salida1"]) - (20*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (11*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))){
    $observacion ="F1";$cero=0;}

if($horaatual >  strtotime($dat[0]["entrada1"]) + (21*60) && $horaatual <  strtotime($dat[0]["salida1"]) - (20*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (21*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))) {
  	$observacion ="F2";$cero=0;}

if($horaatual >  strtotime($dat[0]["entrada1"]) + (31*60) && $horaatual <  strtotime($dat[0]["salida1"]) - (20*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (31*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))){
    $observacion ="F3";$cero=0;}

if($horaatual >  strtotime($dat[0]["entrada1"]) + (41*60) && $horaatual <  strtotime($dat[0]["salida1"]) - (20*60) or
  ($horaatual >  strtotime($dat[0]["entrada2"]) + (41*60) && $horaatual <  strtotime($dat[0]["salida2"]) - (20*60))){
    $cero=1;}
if($horaatual == strtotime("00:00:00")) {
    $cero=1;}
$link=Conectarse();
   $sqlver=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora = '$hora'",$link);
   if (mysql_fetch_array($sqlver) == $cero) {
//________________________________________COMPARO REGISTROS DUPLICADOS________________________________________
$ver=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora < '11:00:00'",$link);
   if ((mysql_fetch_array($ver) == 0)) {
	   	   if($hora<'10:00:00'){
$c1=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
mysql_query($c1);  
		      }else{
		   //___________________HORA 1::::::::::::::::::::::
				$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '12:00:00' AND hora < '14:00:00'",$link);
  		 			if (mysql_fetch_array($ver2) == 0) {
			  		if($hora > '11:00:00' && $hora<'14:00:00'){
				  $e=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
						mysql_query($e); 
						}else{
		//___________________
					   	$ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:30:00'",                      	$link);				
						//abre-------
  		 					if (mysql_fetch_array($ver3) == 0) {
		          				if($hora > '13:50:00' && $hora<'17:30:00'){
				  					$f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
										mysql_query($f); 
				  		       }else{
					  
					           $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 			       if (mysql_fetch_array($ver2) == 0) {
		                         if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
								mysql_query($g); 
				  			   }   }   }   }
					 //cierra------------
			              else{
			                 $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			               if (mysql_fetch_array($ver2) == 0) {
		                  if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
				       	mysql_query($g); 
				          }     
					   }
				     }
					  //___________________
					  
					  }
         }else{
			 $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:30:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'16:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($f); 
				  }  else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
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
				$e=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($e); 
				  }else{
					  //___________________
					   $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:30:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'17:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($f); 
				  } else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				  $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");//ste funciona para las 6
					mysql_query($g); 
				  }     
					}
				}
					  //___________________
					  
					  }
         }else{
			 $ver3=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '14:00:00' AND hora < '17:30:00'",$link);
  		 if (mysql_fetch_array($ver3) == 0) {
		          if($hora > '13:50:00' && $hora<'17:30:00'){
				  $f=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($f); 
				  }  else{
					  //_______________
					  $ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
  			 if (mysql_fetch_array($ver2) == 0) {
		                if($hora > '17:50:00' && $hora <'22:00:00'){
				   $g=("insert into biometrico values(NULL,'$dpto','$nombres','$nro','$fecha','$hora','$observacion','');");
					mysql_query($g); 
				  }     
					}
					  //_______________
					  }
            }else{
			$ver2=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$fecha' AND hora > '18:00:00' AND hora < '22:00:00'",$link);
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
  $cero = 0;
 }
			
			}//CIERRA WILE
if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()==NULL) //pregunto que si ha encontrado un valor null en una columna inicie un parametro en 1 que indicaria el fin del ciclo while
{
$param=1; //para detener el ciclo cuando haya encontrado un valor NULL
}
$i++;
$contador=$contador+1;
}
$totalIngresados=$contador-1; //(porque se se para con un NULL y le esta registrando como que tambien un dato)
echo "Total elementos subidos: $totalIngresados ";
 echo "<script type='text/javascript'>
			alert('Total elementos subidos: $totalIngresados ');
			window.location='reporte.php';
			</script>";

}
else//si no se ha cargado el bak
{
echo "Necesitas primero importar el archivo";}
unlink($destino); //desenlazar a destino el lugar donde salen los datos(archivo)
}

?>
<table width="1000" height="400" align="center" cellspacing="1" style="background-image:url(imagenes/INICIOSISCONPER.png); background-repeat:no-repeat; background-position:center">
<tbody>
  <tr></tr>
</tbody>
<tbody>
  <?php 
if($nom[0]["nombres"]==$admin){
?>
  <tr>
    <td height="26" colspan="6"><form name="importa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <h3 style="color:#154BDD">
      Selecciona el archivo Excel a importar:
      <input type="file" name="excel" />
      <input type='submit' name='enviar'  value="Importar"  />
      <input type="hidden" value="upload" name="action" />
    </form></td>
  </tr>
  <?php
}
$fecha_fin=date('Y-m-d'); 
$fecha_inicio = strtotime ( '-3 day' , strtotime ( $fecha_fin ) ) ;
$fecha_inicio = date ( 'Y-m-j' , $fecha_inicio );
/*$fecha_inicio='2015-04-14';
$fecha_fin='2015-04-17';*/
if($nom[0]["nombres"]==$admin)
{
	$tr=new User();
  $dtr=$tr->get_biometrico_fecha_final_todo($fecha_inicio,$fecha_fin); 
}
else{
	$tr=new User();
$dtr=$tr->get_biometrico_fecha_final_todo_user($nom[0]["id_unidad"],$fecha_inicio,$fecha_fin); 
	}
$con=0;
 	 for($ji=0;$ji<sizeof($dtr);$ji++){
			$con=$con+1;		
		 }
?>
 <tr>
    <td colspan="6">
    <strong style="font-size:18px"><ins>SISTEMA DE CONTROL DE PERSONAL 'SISCONPER'</ins></strong>
</td>
  </tr>
  <tr>
    <td width="109" align="center">&nbsp;</td>
    <td width="320" align="center"><strong style="font-size:18px"><ins>RECURSOS HUMANOS</ins></strong> <br /><br />

      <div class="cajatexto" id="cajatexto" align="left" style="font-size:15px">
        <li>Horarios de Ingresos y Salidas</li>
        <li>Control de Atrasos de Funcionarios</li>
        <li>Planilla de Asistencia Mensual</li>
        <li>Control de Vacaciones</li>
        <li>Control de Memos</li>
        <li>Gestion de Fichas de Usuarios</li>
        <li>Control de Boletas de Salidas</li>
        <li>Reportes de Atrasos y Faltas</li>
        <li>Reporte de Asistencia por Fechas</li>
      </div>
      <br />

      <span style="text-align: center; font-size:15">AREA DE RRHH SEDCAM-PANDO </span></td>
    <td width="143" height="354">&nbsp;</td>
    <td width="182">&nbsp;</td>
    <td width="121"><table width="215" height="159" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><img src="menu/cajados.jpg" width="220" height="60" /></td>
      </tr>
      <tr>
        <td width="21" height="64" bgcolor="#FFFFFF"><img src="menu/topa_r2_c1.gif" width="3" height="28" /></td>
        <td width="182" class="filas" bgcolor="#FFFFFF"><p class="cajas"><span class="newlink2">Bandeja de entrada</span></p>
          <p>Usted tiene <span class="campoletrasrojas">
            <?=$con?>
          </span>funcionarios con asistencia irregular.</p></td>
        <td width="17">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><a href="bandeja.php")"><img src="menu/bandeja.jpg" width="220" height="24" alt="bandeja" /></a></td>
      </tr>
    </table></td>
    <td width="122">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php

?>
</tbody>
<tbody>
</tbody>
</table>
<?php   include('footer.php');?> 