<? include("menuadmin.php"); ?>
<html>
<body>
<link href="css/styles.css" rel="stylesheet" type="text/css">

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
$link=Conectarse();	
$RegistrosAMostrar = 8;
if(isset($_GET['page'])) {
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    	$PaginaActual=$_GET['page'];
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
} 
$datos=$tra->get_biometrico_dist_per($RegistrosEmpezar,$RegistrosAMostrar);
// AQUI HACEMOS LA PAGINACION
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, u.nombre_u AS UNIDAD from boletas_salida b, persona p, unidad u WHERE p.id_persona=b.nro and p.id_unidad=u.id_unidad GROUP BY b.nro",$link));
$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;
    ?> 
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="113" height="30">&nbsp;</td>
   <td colspan="6" align="center">
     <?php
if($nom[0]["nombres"]==$admin){
?>
    
   <form name="importa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
<input type="file" name="excel" />
<input type='submit' name='enviar'  value="Importar"  />
<input type="hidden" value="upload" name="action" />
</form> 
<?php
}else{
?>	
 <h4 style="color:#154BDD">Reporte personal de funcionarios de SEDCAM</h3>
<?php
	}
?>   
   </td>   
  </tr>
  <?php
/*$tra=new User();
$datos=$tra->get_tabla_lim_unicas("boletas_salida","nro",$RegistrosEmpezar,$RegistrosAMostrar);*/
if(sizeof($datos)==0)
{ ?>
  <tr>
  <td colspan="8" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
   <?php
}else
{
?>
  <tr>
    <td height="30" colspan="4"><form action="reporte_mensual_salidas.php" method="post"><p>Buscar permisos por fecha de:
        <input type="date" name="inicio" placeholder="2015-01-01">Hasta<input type="date" name="fin" placeholder="2015-01-31">
    </p></td>
   <td>
   <input type="hidden" name="grabar" value="si" >
   <input type="submit" name="buscar" value="Buscar" ></form></td>
   
   
   
   </td>
    <td colspan="3" ></td>
  </tr>
<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Nombre</strong></td>
<td width="122" align="center" valign="top" ><strong>Apellido Paterno</strong></td>
<td width="128" align="center" valign="top" ><strong>Apellido Materno</strong></td>
<td width="230" align="center" valign="top" ><strong>Unidad</strong></td>

<td width="51" align="center" valign="top" ><strong>Permisos</strong></td>
</tr>
<?php

for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}
?>
  <td valign="top" align="center"><a href="ver_funcionario.php?id=<?php echo $datos[$i]["id_persona"];?>" title="<?php echo $datos[$i]["nombres"];?>"><?php echo $datos[$i]["NOMBRE"];?></a></td>
<td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["PATERNO"]; ?></font></td>
<td align="center" valign="top"><font face="serif" size="-1"><?php echo $datos[$i]["MATERNO"];?></font></td>
<td align="center" valign="top"><font face="serif" size="-2"><?php echo $datos[$i]["UNIDAD"]; ?></font></td>
<td valign="top" align="center"><a href="detalles_salidas_id.php?id=<?php echo $datos[$i]["id_persona"];?>" title="Reporte personal de salidas <?php echo $datos[$i]["nombres"];?>" ><img src="images/click2.jpg" width="25" height="25" /></a></td>
<?php } ?>
<tr valign="top"><td colspan="6" align="center"><h4><strong> <?php if($Respuesta>0) $UltimaPagina=floor($UltimaPagina)+1;
echo "<a href=\"permisos.php\">Inicio</a> |";
if($PaginaActual>1) echo "<a href=\"permisos.php?page=".$PaginaAnteior."\">Anterior</a> |";echo "<b>(".$PaginaActual." / ".$UltimaPagina.")</b> |";
if($PaginaActual<$UltimaPagina)  echo " <a href=\"permisos.php?page=".$SiguientePagina."\">Siguiente</a> |";
echo "<a href=\"permisos.php?page=".$UltimaPagina."\">Ultima</a>";?> </strong></h4></td></tr>
</tr>
<?php
}
?>
   
</table>

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
$observacion=0;
while($param==0) //mientras el parametro siga en 0 (iniciado antes) que quiere decir que no ha encontrado un NULL entonces siga metiendo datos
{
          $nro=$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		  $nombres=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
          $tipo=$objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
	      $hora_1=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		  $hora_2=$objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		  $fecha=$objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
            
 //$hora=$objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
//************************************************************************************************
// utilizo la funci?n y obtengo el timestamp
$hora_1 = PHPExcel_Shared_Date::ExcelToPHP($hora_1);
$hora_2 = PHPExcel_Shared_Date::ExcelToPHP($hora_2);
$fecha = PHPExcel_Shared_Date::ExcelToPHP($fecha);
$hora_n1 = gmdate("H:i:s",$hora_1);
$hora_n2 = gmdate("H:i:s",$hora_2);
$fecha_n = gmdate("Y-m-d",$fecha);

//************************************************************************************************
 $c=("insert into boletas_salida values (NULL,'$nro','$nombres','$tipo','$hora_n1','$hora_n2','$fecha_n',' ');");
mysql_query($c);

if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()==NULL) //pregunto que si ha encontrado un valor null en una columna inicie un parametro en 1 que indicaria el fin del ciclo while
{
$param=1; //para detener el ciclo cuando haya encontrado un valor NULL
}
$i++;
$contador=$contador+1;
}
$totalIngresados=$contador-1; //(porque se se para con un NULL y le esta registrando como que tambien un dato)
echo "Total elementos subidos: $totalIngresados ";
 echo"<script type='text/javascript'>
			alert('Total elementos subidos: $totalIngresados ');
			window.location='permisos.php';
			</script>";
}
else//si no se ha cargado el bak
{
echo "Necesitas primero importar el archivo";}
unlink($destino); //desenlazar a destino el lugar donde salen los datos(archivo)
}
?>

<?  include("footer.php"); ?>
