<?  include("menuadmin.php"); ?>
<html>
<head>
<body>
<div class="content">
  <table width="666" align="center" >
  <td colspan="5" align="center">
  <?php
if($nom[0]["nombres"]==$admin){
?>
<a href="add_usuario.php" title="Nuevo Usuario">
<?php
}else{
?>	
<a href="salir.php?id=listusuario.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
<?php
	}
?>
 <img src="images/add.png" width="25" height="25" /> Nuevo Usuario</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buscar por nombre de usuario:
              <input type="text" id="texto" onKeyPress="Buscarusuario();"  size="30"/>
</tr>
 </table>
   <table width="666" align="center" id="buscador">
   </table>
<table width="666" align="center" class="altrowstable" id="alternatecolor" >
<?php

$tra=new User();
$datos=$tra->get_tabla("usuario");

if(sizeof($datos)==0)
{
    ?>
    <tr>
      <td colspan="6" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else
{
?>
<tr bgcolor="#75C2F3">
  <td colspan="9" align="center" valign="top">Listado de Usuarios</td>
  </tr>

<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Usuario</strong></td>
<td align="center" valign="top" ><strong>Password</strong></td>
<td align="center" valign="top" ><strong>Detalles</strong></td>
<td align="center" valign="top" ><strong>Eliminar</strong></td>
</tr>
<tr>
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
<td valign="top" align="center"><a href="ver_funcionario.php?id=<?php echo $datos[$i]["id_persona"];?>" title="<?php echo $datos[$i]["usuario"];?>"><?php echo $datos[$i]["usuario"];?></a></td>
<td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["password"];?></font></td>
<td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["detalles"];?></font></td>
<td valign="top" align="center">
<?php
$nom[0]["nombres"];
if($nom[0]["nombres"]==$admin){
?>
<a href="delet_usuario.php?id=<?php echo $datos[$i]["id_usuario"];?>" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
<?php
}else{
?>	
<a href="salir.php?id=listusuario.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
<?php
	}
?>
<img src="images/cancel.png" width="25" height="25" /></a></td>

</tr >

<?php
}
}
?>
</table>
<?  include("footer.php"); ?>