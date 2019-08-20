<? include("menuadmin.php"); ?>


<table width="700" border="0" align="center">
  <tbody>
    <tr> 
      <td width="370"><a href="add_campamento.php" title="Agregar canpamento" onclick="window.open(this.href,'window','width=500, height=400');return false" >Nuevo Campamento<img src="images/add.png" width="16" height="16" alt=""/></a></td>
      <td width="170">    <?php
	$tra= new User();
    $super=$tra->get_tabla_cam("campamento");
    ?>
      Categoria
      
      <select id="valor" onchange="enviasuper();">
        <option value="0">Seleccione</option>
        <?php
        for($i=0;$i<sizeof($super);$i++)
        {
            if(isset($_GET["s"]))
            {
                if($_GET["s"]==$super[$i]["id_campamento"])
                {
                  ?>
        <option value="<?php echo $super[$i]["id_campamento"];?>" title="<?php echo $super[$i]["nombre"];?>" selected="selected"><?php echo $super[$i]["nombre"];?></option>
        <?php  
                }else
                {
                  ?>
        <option value="<?php echo $super[$i]["id_campamento"];?>" title="<?php echo $super[$i]["nombre"];?>"><?php echo $super[$i]["nombre"];?></option>
        <?php  
                }
                
            }else
            {
                ?>
        <option value="<?php echo $super[$i]["id_campamento"];?>" title="<?php echo $super[$i]["nombre"];?>"><?php echo $super[$i]["nombre"];?></option>
        <?php
            }
        }
        ?>
      </select></td>
      <td width="308"><a href="insercion_manual_asistencia.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></td>
    </tr>
  </tbody>
</table>
<body onload="deseleccionar_todo();">
<form name="form" method="post" action="marcados_maestransa.php">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="113" height="30">&nbsp;</td>
   <td align="center"><h4><strong>Listado De Funcionarios</strong></h4></td>
   <td style="text-align: right">&nbsp;</td>
 <td style="text-align: right">&nbsp;</td>
  </tr>
  <?php

$tra=new User();
$datos=$tra->get_campamento();
$vect = array();
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
<td colspan="7" align="center">
Insertar asistencia de:<input type="date" name="inicio" value="<?php echo date("Y-m-d");?>" size="20">
     
</td>
</tr>
<tr bgcolor="#75C2F3" >
<td  width="20" align="center" valign="top" ><strong>Nro</strong></td>
<td  width="180" align="center" valign="top" ><strong>Nombres</strong></td>
<td width="125" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="120" align="center" valign="top" ><strong>Campamento</strong></td>
<td width="100" align="center" valign="top" >Asistencia</td>
<td width="128" align="center" valign="top" >Maquinas</td>
<td width="128" align="center" valign="top" >Estado</td>
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
<td  align="center"><?php 
echo $i+1;
?></td>
  <td align="left" valign="top"><font face="serif" size="-1"><?php echo $datos[$i]["nombres"].' '. $datos[$i]["ap_paterno"].' '.$datos[$i]["ap_materno"];?></font></td>
<td align="center" valign="top"><font face="serif" size="-2"><?php
   $tra2=new User();
$dato=$tra2->get_tabla_id("id_unidad",$datos[$i]["id_unidad"],"unidad");
echo $dato[0]["nombre_u"];
 ;?></font></td>
<td align="center" valign="top"><font face="serif" size="-2">
  <?php
   $tra3=new User();
$dat=$tra3->get_tabla_id("id_campamento",$datos[$i]["id_campamento"],"campamento");
echo $dat[0]["nombre"];
 ;?>
</font></td>
 <td align="center" valign="top"><font face="serif" size="-1"><input type="checkbox" name="checkbox[]" value="<?php echo $datos[$i]["id_persona"];?>" /></font></td>
 <td align="center" valign="top"><font face="serif" size="-2">
  <?php
$tr1=new User();
$d=$tr1->get_tabla_id_desc("cod_maquinas",$datos[$i]["cod_maquinas"],"maquinas");
?>
  <?php echo $d[0]["cod_maquinas"]; ?>
</font></td>
<td align="center" valign="top"><font face="serif" size="-2">

 <input type="hidden" name="id[]"   value="<?php echo $d[0]["cod_maquinas"];?>" /> 
 <input type="text"   name="vect[]" value="<?php echo $d[0]["estado"];?>" size="33">

</font></td>
</tr>
<?php
}
?> 
<tr>
<td colspan="4"  align="right">
 <input name="bandera" type="hidden" id="bandera" value="1" />
<input type="submit" value="marcar asistencia" title="Asistencia" />
&nbsp;&nbsp;||&nbsp;&nbsp; 
<input type="button" value="Seleccionar Todo" title="Seleccionar Todo" onclick="seleccionar_todo();" />
&nbsp;&nbsp;||&nbsp;&nbsp;
<input type="button" value="Deseleccionar Todo" title="Deseleccionar Todo" onclick="deseleccionar_todo();" />
</form> 
</td></tr>
</table>
<? } include("footer.php"); ?>