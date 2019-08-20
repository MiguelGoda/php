<? include("menuadmin.php"); ?>
<html>
<title></title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<body>
<table width="798" align="center" bgcolor="#FFFFFF" style="border-collapse : separate; " class="altrowstable" id="alternatecolor">
        <tr>
        <td colspan="4" align="center" ><h3><strong>Listado De Campamentos SEDCAM</strong></h3></td>
                 
        </tr>
        <?php

$tra=new User();
$datos=$tra->get_tabla('campamento');

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
        <tr style="background-color:#75C2F3" >
          <td width="129" align="center" valign="top" ><strong>Nro</strong></td>
          <td width="473" align="center" valign="top" ><strong>Nombre Campamento</strong></td>
          <td width="180" align="center" valign="top" ><strong>Descripcion</strong></td>
          <td width="180" align="center" valign="top" ><strong>Reporte</strong></td>
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

               <td valign="top" align="left"><?php echo $datos[$i]["id_campamento"];?></td>
          <td valign="top" align="left">    <?php echo $datos[$i]["nombre"];?>         </td>
          <td valign="top" align="left">    <?php echo $datos[$i]["descripcion"]; ?>   </td>
          <td valign="top" align="center">
          <a href="reporte_diario_campamentos.php?id=<?php echo $datos[$i]["id_campamento"];?>" title="reporte diario de <?php echo $datos[$i]["nombre"];?>" >
			<img src="imagenes/final-asistencia.jpg" width="35" height="30" /></a></td>
        </tr>
        <?php
}
}
?>
      </table>
<?  include("footer.php"); ?>
'