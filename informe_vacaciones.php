<? include("menuadmin.php"); ?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="214" height="30">&nbsp;</td>
   <td colspan="3" align="center"><h4><strong>Listado de permisos</strong></h4></td>
 <td style="text-align: right"><a href="informe_vacaciones.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></td>
  </tr>
  <?php

$tra=new User();
$datos=$tra->get_permisos();

if(sizeof($datos)==0)
{
    ?>
    <tr>
      <td colspan="8" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else
{
?>
<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Nombres</strong></td>
<td width="237" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="104" align="center" valign="top" ><strong>Incio Permios</strong></td>
<td width="102" align="center" valign="top" ><strong>Fin Permios</strong></td>
<td width="343" align="center" valign="top" ><strong>Detalles</strong></td>
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

<td align="center" valign="top" style="text-align: left"><font face="serif" size="-1"><?php echo $datos[$i]["NOMBRE"].' '. $datos[$i]["PATERNO"].' '.$datos[$i]["MATERNO"];?></font></td>
<td align="center" valign="top" style="text-align: left"><font face="serif" size="-2"><?php
   $tra2=new User();
$dato=$tra2->get_tabla_id("id_unidad",$datos[$i]["UNIDAD"],"unidad");
echo $dato[0]["nombre_u"];
 ;?></font></td>
 <td align="center" valign="top" style="text-align: left"><font face="serif" size="-1"><?php echo $datos[$i]["INICIO"];?></font></td>
  <td align="center" valign="top" style="text-align: left"><font face="serif" size="-1"><?php echo $datos[$i]["FIN"];?></font></td>
   <td align="center" valign="top" style="text-align: left"><font face="serif" size="-1"><?php echo $datos[$i]["DETALLES"];?></font></td>
</tr>

<?php
}
?>   
</table>

<?  } include("footer.php"); ?>