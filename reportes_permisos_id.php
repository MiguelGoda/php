<?php  
include("menuadmin.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin t?tulo</title>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<?php
  $tra=new User();
  $datos=$tra->get_boletas_id($_GET["id"]);  
   ?>
<table width="666" align="center" >
 <tr valign="top" bgcolor="#75C2F3">     
   <td colspan="6" align="center"><strong>Listado de Funcionarios</strong></td> </tr>
    <tr valign="top" bgcolor="#75C2F3"> 
     <form method="post" action="exportar_excel_id.php" >
 <td colspan="4" align="center"> Exportar de:<input type="date" name="fecha_inicio" value="<?php echo date("Y-m-d");?>" size="20"> Hasta:<input type="date" name="fecha_fin" value="<?php echo date("Y-m-d");?>" size="20"></td>
 <td colspan="2" align="right">
   Exportar registros:
   <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"];?>"> 
<input type=image src="images/Excel.png" width="45" height="30">

  </td>
  </form>
          </tr>
   <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Departamento </strong></td>
            <td align="center" valign="top" ><strong>Nombre</strong></td>
            <td align="center" valign="top" ><strong>Nro</strong></td>
               <td align="center" valign="top" ><strong>Fecha</strong></td>
            <td align="center" valign="top" ><strong>Hora</strong></td>
            <td align="center" valign="top" ><strong>Seleccionar</strong></td>
          </tr>
   <?php
for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){  echo '<tr bgcolor="#F4F7EB" >';}
		else{    echo '<tr bgcolor="#F5E68E" >'; }
?>
 <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["dpto"];?></font></td>
            <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["nombres"];?></font></td>
             <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["nro"];?></font></td>
             <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["fecha"];?></font></td>
             <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["hora"];?></font></td>
             <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["observacion"];?></font></td>
</tr>
<?php
}
?>
   </table> 
   
<?  include("footer.php"); ?>