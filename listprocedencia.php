<? include("menuadmin.php"); ?>
<html>
<title></title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<body>
<table width="1000" align="center" style="border-collapse : separate; " class="altrowstable" id="alternatecolor">
  <tbody>
    <tr>
      <td width="458" valign="top">
      <table width="418" align="center" bgcolor="#FFFFFF" style="border-collapse : separate; ">
        <tr>
          <td colspan="2" align="center"><h4><strong>Listado De Unidades O Areas</strong></h4></td>
          <td colspan="1" ><?php
if($nom[0]["nombres"]==$admin){
?>
            <a href="add_unidad.php" title="AGREGAR FUNCIONARIO">
              <?php
}else{
?>
              <a href="salir.php?id=listprocedencia.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
              <?php
	}
?>
              <img src="images/add.png" width="28" height="25" alt=""/>AGREGAR </a></td>
        </tr>
        <?php

$tra=new User();
$datos=$tra->get_tabla("unidad");

if(sizeof($datos)==0)
{
    ?>
        <tr>
          <td colspan="3" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td>
        </tr>
        <?php
}else
{
?>
        <tr bgcolor="#75C2F3" >
          <td width="267" align="center" valign="top" ><strong>Unidad</strong></td>
          <td width="60" align="center" valign="top" ><strong>Editar</strong></td>
          <td width="91" align="center" valign="top" ><strong>Eliminar</strong></td>
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
        
          <td valign="top" align="left"><a href="edit_unidad.php?id=<?php echo $datos[$i]["id_unidad"];?>" title="<?php echo $datos[$i]["nombre_u"];?>"><?php echo $datos[$i]["nombre_u"];?></a></td>
          <td valign="top" align="center"><?php
if($nom[0]["nombres"]==$admin){
?>
            <a href="edit_unidad.php?id=<?php echo $datos[$i]["id_unidad"];?>" title="Editar <?php echo $datos[$i]["id_unidad"];?>" >
              <?php
}else{
?>
              <a href="salir.php?id=listprocedencia.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
              <?php
	}
?>
              <img src="images/editar.jpg" width="25" height="25" /></a></td>
          <td valign="top" align="center"><?php
if($nom[0]["nombres"]==$admin){
?>
            <a href="delet_unidad.php?id=<?php echo $datos[$i]["id_unidad"];?>" title="Eliminar <?php echo $datos[$i]["id_unidad"];?>" >
              <?php
}else{
?>
              <a href="salir.php?id=listprocedencia.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
              <?php
	}
?>
              <img src="images/cancel.png" width="25" height="25" /></a></td>
        </tr>
        <?php
}
}
?>
      </table></td>
      <td width="23">&nbsp;</td>
      <td width="505" valign="top"><table width="418" align="center" bgcolor="#FFFFFF" style="border-collapse : separate; " >
        <tr>
          <td colspan="2" align="center"><h4><strong>Listado de Campamentos</strong></h4></td>
          <td colspan="1" ><?php
if($nom[0]["nombres"]==$admin){
?>
            <a href="add_campamento.php" title="AGREGAR FUNCIONARIO" onclick="window.open(this.href,'window','width=500, height=400');return false">
              <?php
}else{
?>
              <a href="salir.php?id=listprocedencia.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
              <?php
	}
?>
              <img src="images/add.png" width="28" height="25" alt=""/>AGREGAR </a></td>
        </tr>
        <?php

$tra=new User();
$datos=$tra->get_tabla("campamento");

if(sizeof($datos)==0)
{
    ?>
        <tr>
          <td colspan="3" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td>
        </tr>
        <?php
}else
{
?>
        <tr bgcolor="#75C2F3" >
          <td width="287" align="center" valign="top" ><strong>Campamento</strong></td>
          <td width="70" align="center" valign="top" ><strong>Editar</strong></td>
          <td width="61" align="center" valign="top" ><strong>Eliminar</strong></td>
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
               <td valign="top" align="left"><a href="edit_unidad.php?id=<?php echo $datos[$i]["id_unidad"];?>" title="<?php echo $datos[$i]["nombre_u"];?>"><?php echo $datos[$i]["nombre"];?></a></td>
          <td valign="top" align="center"><?php
if($nom[0]["nombres"]==$admin){
?>
            <a href="edit_campamento.php?id=<?php echo $datos[$i]["id_campamento"];?>" title="Editar <?php echo $datos[$i]["id_campamento"];?>" >
              <?php
}else{
?>
              <a href="salir.php?id=listprocedencia.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
              <?php
	}
?>
              <img src="images/editar.jpg" width="25" height="25" /></a></td>
          <td valign="top" align="center"><?php
if($nom[0]["nombres"]==$admin){
?>
            <a href="delet_campamento.php?id=<?php echo $datos[$i]["id_campamento"];?>" title="Eliminar <?php echo $datos[$i]["id_campamento"];?>" >
              <?php
}else{
?>
              <a href="salir.php?id=listprocedencia.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
              <?php
	}
?>
              <img src="images/cancel.png" width="25" height="25" /></a></td>
        </tr>
        <?php
}
}
?>
      </table></td>
    </tr>
  </tbody>
</table>
<?  include("footer.php"); ?>
