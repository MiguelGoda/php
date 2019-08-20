<?php
include("menuadmin.php");
?>
<body onload="deseleccionar_todo();">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<form name="form" method="post" action="marcados_maestransa_ejecutar.php">
    <tr> 
      <td width="370" align="left"><a href="add_campamento.php" title="Agregar canpamento" onclick="window.open(this.href,'window','width=500, height=400');return false" >Nuevo Campamento<img src="images/add.png" width="16" height="16" alt=""/></a></td>
      <td >
  <select name="id_campamento" required>
         <?php $nr=new User();
   			 $sup=$nr->get_tabla("campamento");
         ?>
              <?php
        for($j=0;$j<sizeof($sup);$j++)
        {
            ?>
 <option value="<?php echo $sup[$j]["id_campamento"];?>" selected="selected" title="<?php echo $sup[$j]["nombre"];?>"><?php echo $sup[$j]["nombre"];?></option>
              <?php
        }
        ?>
            </select>  
      </td>
            <td></td>
                  <td ></td>
      <td align="left" ><a href="insercion_manual_asistencia.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></td>
    </tr>
  <tr>
    <td colspan="5" align="center">
   <h4><strong>Seleccionar funcionarios y crear grupo para campamento</strong></h4></td>
   <td style="text-align: right">&nbsp;</td>
 <td style="text-align: right">&nbsp;</td>
  </tr>
  <?php

$tra=new User();
$datos=$tra->get_tabla("persona");

if(sizeof($datos)==0)
{
    ?>
    <tr>
      <td colspan="14" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else
{
?>

<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Nombres</strong></td>
<td width="122" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="128" align="center" valign="top" ><strong>Campamento</strong></td>
<td width="128" align="center" valign="top" >Secionar Asistencia</td>

</tr>
<?php

for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#C9F4EF" >';
}
?>

  <td align="center" valign="top"><font face="serif" size="-1"><?php echo $datos[$i]["nombres"].' '. $datos[$i]["ap_paterno"].' '.$datos[$i]["ap_materno"];?></font></td>
<td align="center" valign="top"><font face="serif" size="-2"><?php
   $tra2=new User();
$dato=$tra2->get_tabla_id("id_unidad",$datos[$i]["id_unidad"],"unidad");
echo $dato[0]["nombre_u"];
 ;?></font></td>
<td align="center" valign="top"><font face="serif" size="-2">
 <?php
   $pr=new User();
$dat=$pr->get_tabla_id("id_campamento",$datos[$i]["id_campamento"],"campamento");
echo $dat[0]["nombre"];
 ;?>
</font></td>
 <td align="center" valign="top"><font face="serif" size="-1"><input type="checkbox" name="checkbox[]" value="<?php echo $datos[$i]["id_persona"];?>" /></font></td>
</tr>

<?php
}
?> 
<tr>
<td colspan="4"  align="right">
 <input name="bandera" type="hidden" id="bandera" value="1" />
<input type="submit" value="A&ntilde;adir a Campamento" title="Asistencia" />
&nbsp;&nbsp;||&nbsp;&nbsp; 
<input type="button" value="Seleccionar Todo" title="Seleccionar Todo" onclick="seleccionar_todo();" />
&nbsp;&nbsp;||&nbsp;&nbsp;
<input type="button" value="Deseleccionar Todo" title="Deseleccionar Todo" onclick="deseleccionar_todo();" />
</form> 
</td></tr>
</table>
<? } include("footer.php"); ?>