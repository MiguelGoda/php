<? include("menuadmin.php"); ?>
<html>
<title></title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
  <tr>
  <td colspan="10">Listado De Funcionarios</td>  </tr>
  <tr>
    <td width="113" height="30">&nbsp;</td>
   <td colspan="3" align="center"><h4>&nbsp;&nbsp;Buscar por nombre de usuario:
       <input type="text" id="texto" onkeypress="Buscarfuncionario();"  size="30"/>
   </h4></td>
    <td colspan="3" >
     <?php
if($nom[0]["nombres"]==$admin){
?>
 <a href="add_funcionario.php" title="AGREGAR FUNCIONARIO">
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
<?php
	}
?>   
   <img src="images/add.png" width="28" height="25" alt=""/>AGREGAR </a></td>
    
  </tr>
  </table>
  
  <table id="buscador"  width="1000" style="border-collapse : separate;" align="center">
  </table>
  <table width="1000" style="border-collapse : separate;" align="center" class="altrowstable" id="alternatecolor">
  <?php
$tra=new User();
$datos=$tra->get_persona($nom[0]["id_unidad"]);
if(sizeof($datos)==0)
{
    ?>
    <tr>
      <td colspan="10" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else{
?>
<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Nombre</strong></td>
<td width="122" align="center" valign="top" ><strong>Ap Paterno</strong></td>
<td width="128" align="center" valign="top" ><strong>Ap Materno</strong></td>
<td width="230" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="56" align="center" valign="top" ><strong>Familias</strong></td>
<td width="51" align="center" valign="top" ><strong>Memos</strong></td>
<td width="51" align="center" valign="top" ><strong>Horarios</strong></td>
<td width="51" align="center" valign="top" ><strong>Maquinaria</strong></td>
<td width="51" align="center" valign="top" ><strong>Correccion <BR>Asistencia</strong></td>
<td width="51" align="center" valign="top" ><strong>Eliminar<BR>Asistencia</strong></td>
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
  <td valign="top" align="center"><a href="ver_funcionario.php?id=<?php echo $datos[$i]["id_persona"];?>" title="<?php echo $datos[$i]["nombres"];?>"><?php echo $datos[$i]["nombres"];?></a></td>
<td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["ap_paterno"];?></font></td>
<td align="center" valign="top"><font face="serif" size="-1"><?php echo $datos[$i]["ap_materno"];?></font></td>
<td align="center" valign="top"><font face="serif" size="-1">
<?php
 $tra5=new User();
$dato5=$tra5->get_tabla_id("id_unidad",$datos[$i]["id_unidad"],"unidad");
echo $dato5[0]["nombre_u"]; ?></font></td>
<td align="center" valign="top">
 <?php
if($nom[0]["nombres"]==$admin){
?>
<a href="add_familia.php?id=<?php echo $datos[$i]["id_persona"];?>" title="insertar familiares" >
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Insertar Familiares <?php echo $datos[$i]["nombres"];?>" >
<?php
	}
?>
<img src="images/familias.jpg" width="25" height="25" /></a>
</td>
<td valign="top" align="center">
<?php
if($nom[0]["nombres"]==$admin){
?>
<a href="add_memo.php?id=<?php echo $datos[$i]["id_persona"];?>" title="Llamar Atencion <?php echo $datos[$i]["nombres"];?>" >
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Llamar Atencion <?php echo $datos[$i]["nombres"];?>" >
<?php
	}
?>
<img src="images/contratar.jpg" width="25" height="25" /></a></td>
<td valign="top" align="center">
<?php
if($nom[0]["nombres"]==$admin){
?>
<a href="add_hora.php?id=<?php echo $datos[$i]["id_persona"];?>" title="Nuevo Horario <?php echo $datos[$i]["nombres"];?>" >
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Nuevo Horario <?php echo $datos[$i]["nombres"];?>" >
<?php
	}
?>
<img src="imagenes/reloj.jpg" width="25" height="25" /></a></td>
<td valign="top" align="center">
<?php
if($nom[0]["nombres"]==$admin or $nom[0]["nombres"]== "Radio" ){
?>
<a href="add_maquinaria.php?id=<?php echo $datos[$i]["id_persona"];?>" title="Agregar Maquinaria a <?php echo $datos[$i]["nombres"];?>" >
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Agregar Maquinarias a <?php echo $datos[$i]["nombres"];?>" >
<?php
	}
?>
<img src="imagenes/tractor.jpg" width="25" height="25" /></a></td>

<td valign="top" align="center">
<?php
if($nom[0]["nombres"]==$admin){
?>
<a href="add_periodo.php?id=<?php echo $datos[$i]["id_persona"];?>" title="Corregir asistencia diaria a <?php echo $datos[$i]["nombres"];?>" >
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Agregar Maquinarias a <?php echo $datos[$i]["nombres"];?>" >
<?php
	}
?>
<img src="imagenes/user.bmp" width="25" height="25" /></a></td>
<td valign="top" align="center">
<?php
if($nom[0]["nombres"]==$admin){
?>
<a href="eliminar_marcado.php?id=<?php echo $datos[$i]["id_persona"];?>" title="Corregir asistencia diaria a <?php echo $datos[$i]["nombres"];?>" >
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Agregar Maquinarias a <?php echo $datos[$i]["nombres"];?>" >
<?php
	}
?>
<img src="imagenes/eliminar.jpg" width="25" height="25" /></a></td>
</tr>
<?php
}}

?>
   
</table>

<?  include("footer.php"); ?>
   