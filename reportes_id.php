<?php  
include("menuadmin.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php
$tra=new User();
$tra2=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	 $fin=$_POST['fin'];
	 $inicio=$_POST['inicio'];
	 $id=$_POST['id'];
 $datos=$tra2->get_biometrico_id_buscar($id,$inicio,$fin); 
 ?>  
 <table width="750" align="center" >
 <tr valign="top" bgcolor="#75C2F3">     
   <td colspan="6" align="right" >
 Exportar registros:
<a href="exportar_excel_id.php?inicio=<?php echo $inicio; ?>&fin=<?php echo $fin; ?>&id=<?php echo $id; ?>" title="EXPORTAR DATOS"><img src="images/Excel.png" width="28" height="25" alt=""/></a>
</td> </tr>
</table>
<?php
}
if(isset($_GET["id"])and $_POST["grabar"]!="si"){
$datos=$tra->get_biometrico_id($_GET["id"]);
}
?>

<table width="750" align="center" class="altrowstable" id="alternatecolor" >
 <tr valign="top" bgcolor="#75C2F3">     
   <td colspan="6" align="center"><strong>Listado de Funcionarios</strong></td> </tr>
    <tr valign="top" bgcolor="#75C2F3"> 
     <form method="post" action="" >
 <td colspan="6" align="center"> Exportar de:<input type="date" name="inicio" value="<?php echo date("Y-m-d");?>" size="20"> Hasta:<input type="date" name="fin" value="<?php echo date("Y-m-d");?>" size="20">
  <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"];?>"> 
   <input type="hidden" name="grabar" value="si" />
   <input  type="submit" name="button" id="button" value="BUSCAR"></td>
  </form>
          </tr>
   <tr bgcolor="#75C2F3" >
            <td width="204" align="center" valign="top" ><strong>Departamento </strong></td>
            <td width="178" align="center" valign="top" ><strong>Nombre</strong></td>
            <td width="58" align="center" valign="top" ><strong>Nro</strong></td>
               <td width="102" align="center" valign="top" ><strong>Fecha</strong></td>
            <td width="83" align="center" valign="top" ><strong>Hora</strong></td>
            <td width="97" align="center" valign="top" ><strong>Asistencia</strong></td>
          </tr>
   <?php
for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
	?>
    <tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#F4F7EB';" >
    <?php
}else{
	?>
   <tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#F5E68E';">
   <?php
}
?>
<td valign="top" align="left"><font face="serif" size="-1"><?php echo $datos[$i]["UNIDAD"];?></font></td>
            <td valign="top" align="left"><font face="serif" size="-1"><?php echo $datos[$i]["NOMBRE"].' '.$datos[$i]["PATERNO"].' '.$datos[$i]["MATERNO"];?></font></td>
             <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["NRO"];?></font></td>
             <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["FECHA"];?></font></td>
             <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["HORA"];?></font></td>
            <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["OBSERVACION"];?></font></td>
</tr>
<?php
}
?>
   </table> 
   
<?  include("footer.php"); ?>