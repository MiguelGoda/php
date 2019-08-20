<?php include("menuadmin.php"); ?>
<html>
<head>
<title>SISTEMA BIOMETRICO</title>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
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

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::
if($nom[0]["nombres"]==$admin){	
$datos=$tra->get_biometrico_dist3();
}
else{
$datos=$tra->get_biometrico_dist3_user($nom[0]["id_unidad"]);
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::

    ?>  
        <tr valign="top" bgcolor="#75C2F3">  
        <form action="reportes_gral_fecha_a_fecha.php" method="post">
        <td colspan="3" align="center">inicio:<input type="date" name="inicio" value="<? echo $inicio; ?>"> </td><td colspan="3" align="center">fin:<input type="date" name="fin" value="<? echo $fin; ?>"></td><td align="center" valign="top" colspan="2" ><input type="submit" name="enviar" value="buscar"></td>
        </form>
         </tr>
    <tr valign="top" bgcolor="#75C2F3">  
   <td colspan="6" align="center"><strong>ASISTENCIAS DE FUNCIONARIOS GENERAL</strong></td>
   <form method="post" action="exportar_excel2.php" >
 <td colspan="1" align="right">
   
   <input type="hidden" name="fin" value="<? echo $fin; ?>">
   <input type="hidden" name="incio" value="<? echo $inicio; ?>"> 
<input type=image src="images/Excel.png" width="45" height="30">
  </td></form>
    </tr>

          <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Nombre </strong></td>
            <td align="center" valign="top" ><strong>Total dias</strong></td>
            <td align="center" valign="top" ><strong>Asistencias</strong></td>
             <td align="center" valign="top" ><strong>Faltas<br>1 dia Dto.</strong></td>
            <td align="center" valign="top" ><strong>Atraso<br>2 Hr. Dto.</strong></td>
            <td align="center" valign="top" ><strong>Atraso<br>3 Hr. Dto</strong></td>
            <td align="center" valign="top" ><strong>Total Horas<br>de Atraso</strong></td>
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
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo ($datos[$i]["TOTALDIAS"])/4;?></font></td>
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

        </table>
<?  include("footer.php"); ?>