<?php include("menuadmin.php"); ?>

<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">

<body>
<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>         
 <table width="800" align="center" >
        
          <?php
$tra=new User();
$link=Conectarse();	
$RegistrosAMostrar = 20;
if(isset($_GET['page'])) {
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    $PaginaActual=$_GET['page'];
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
} 
//:::::::::::::::::::::::::::::::::::::::::::::::
if($nom[0]["nombres"]==$admin){
$datos=$tra->get_biometrico_dist2($RegistrosEmpezar,$RegistrosAMostrar);
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD, sum(b.observacion='F3') AS FALTAS, sum(b.observacion='F1') AS ATRASO, sum(b.observacion='F2') AS ATRASOS, sum(b.observacion='A') AS ASISTENCIAS, count(b.observacion) AS TOTALDIAS FROM biometrico b, persona p, unidad u where b.nro = p.id_persona and p.id_unidad = u.id_unidad group by b.nro",$link));
}else{
$datos=$tra->get_biometrico_dist2_user($nom[0]["id_unidad"],$RegistrosEmpezar,$RegistrosAMostrar);
$u=$nom[0]["id_unidad"];
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD, sum(b.observacion='F3') AS FALTAS, sum(b.observacion='F1') AS ATRASO, sum(b.observacion='F2') AS ATRASOS, sum(b.observacion='A') AS ASISTENCIAS, count(b.observacion) AS TOTALDIAS FROM biometrico b, persona p, unidad u where b.nro = p.id_persona and p.id_unidad = u.id_unidad and p.id_unidad = '$u' group by b.nro",$link));
}
//:::::::::::::::::::::::::::::::::::::::::::::::

// AQUI HACEMOS LA PAGINACION

$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;
$inicio = '2015-01-01';
$fin    = date('Y-m-d');
    ?>  
        <tr valign="top" bgcolor="#75C2F3">  
        <form action="reportes_gral_fecha_a_fecha.php" method="post">
        <td colspan="3" align="center">inicio:<input type="date" name="inicio" value="<? echo $inicio; ?>"> </td><td colspan="3" align="center">fin:<input type="date" name="fin" value="<? echo $fin; ?>"></td><td align="center" valign="top" colspan="2" ><input type="submit" name="enviar" value="buscar"></td>
        </form>
         </tr>
    <tr valign="top" bgcolor="#75C2F3">  
   <td colspan="8" align="center"><strong>ASISTENCIAS DE FUNCIONARIOS GENERAL</strong></td> </tr>

          <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Nombre </strong></td>
            <td align="center" valign="top" ><strong>Asistencias</strong></td>
            <td align="center" valign="top" ><strong>Asistencias<br>Regulares</strong></td>
             <td align="center" valign="top" ><strong>Faltas<br>1/2 dia Dto.</strong></td>
            <td align="center" valign="top" ><strong>Atraso<br>2 Hr. Dto.</strong></td>
            <td align="center" valign="top" ><strong>Atraso<br>3 Hr. Dto</strong></td>
            <td align="center" valign="top" ><strong>Total Horas<br>de Atraso</strong></td>
             <td align="center" valign="top" >
   </tr>
          <?php
for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#7AE5E7" >';
}

?>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["NOMBRE"].' '.$datos[$i]["PATERNO"].' '.$datos[$i]["MATERNO"]; ?></font></td>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["TOTALDIAS"];?></font></td>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["ASISTENCIAS"];?></font></td>
 <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["FALTAS"]; ?></font></td>
 <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["ATRASO"];
  $resul=$datos[$i]["ATRASO"]*2;
 ?></font></td>
 <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["ATRASOS"];
  $resul2=$datos[$i]["ATRASOS"]*3;
 ?></font></td>
 <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $resul+$resul2;?> </font></td
  >
            </tr>
            
          <?php
}
?>
<tr valign="top"><td colspan="6" align="center"><h4><strong> <?php if($Respuesta>0) $UltimaPagina=floor($UltimaPagina)+1;
echo "<a href=\"listtramitesarchivados.php\">Inicio</a> |";
if($PaginaActual>1) echo "<a href=\"listtramitesarchivados.php?page=".$PaginaAnteior."\">Anterior</a> |";echo "<b>(".$PaginaActual." / ".$UltimaPagina.")</b> |";
if($PaginaActual<$UltimaPagina)  echo " <a href=\"listtramitesarchivados.php?page=".$SiguientePagina."\">Siguiente</a> |";
echo "<a href=\"listtramitesarchivados.php?page=".$UltimaPagina."\">Ultima</a>";?> </strong></h4></td></tr>
        </table>
<?  include("footer.php"); ?>