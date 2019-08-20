<? include("menuadmin.php"); 
$tra=new User(); 
 ?>  
 <?php
if(isset($_GET["id"])and $_POST["grabar"]!="si"){
$datos=$tra->get_biometrico_campamento($_GET["id"]);
}
?>

<html>
<title></title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<body>
<table width="1000" align="center" bgcolor="#FFFFFF" style="border-collapse : separate; ">
<tr></tr>
<tr>

    <form method="post" action="" >
 <td colspan="2" align="center"> Buscar:<input name="fecha" type="date" id="fecha" value="<?php echo $_POST['fecha'];?>" size="20">
 <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"];?>"> 
   <input type="hidden" name="grabar" value="si" />
   <input  type="submit" name="button" id="button" value="BUSCAR">
  </form>
   </td>
   <td colspan="1" align="center">
   <?php
   if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	$fecha=$_POST['fecha'];
	$id=$_POST['id'];
 $datos=$tra->get_campamento_buscar($id,$fecha);
 ?>
  <form method="post" action="exportar_excel_campamentos.php" >

  <input type="hidden" name="fecha" id="fecha" value="<? echo $_POST["fecha"]?>"> 
   <input type="hidden" name="campamento" value="<?php 
    $tra5=new User();
$dato5=$tra5->get_tabla_id("id_campamento",$_POST["id"],"campamento");
echo $dato5[0]["nombre"]; ?>">
   <input type="hidden" name="id" value="<?php echo $_POST["id"]?>">
   <input type=image src="images/Excel.png" width="45" height="30">
   </form>
   <?php }?>
   </td>
  <td colspan="4" align="center" ><h3><strong>Listado De Campamentos SEDCAM</strong> <a href="reporte_campamentos.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></h3></td>
</tr>
<tr>
  <td colspan="6" align="center">
  <?php 
    $t=new User();
$d=$t->get_tabla_id("id_campamento",$_GET["id"],"campamento");
echo $d[0]["nombre"]; ?>
  </td>
</tr>
<?php

if(sizeof($datos)==0)
{
    ?>
<tr>
  <td colspan="6" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td>
</tr>
<?php
}else
{
?>
<tr bgcolor="#75C2F3" >
  <td width="200" align="center" valign="top" ><strong>Nombres</strong></td>
  <td width="200" align="center" valign="top" ><strong>Cargo</strong></td>
  <td width="100" align="center" valign="top" ><strong>Cod. Maquinas</strong></td>
  <td width="350" align="center" valign="top" ><strong>Estado Maquinas</strong></td>
  <td width="150" align="center" valign="top" ><strong>Fecha</strong></td>
</tr>
<?php

for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#BBF0EF" >';
}
?>
    <td valign="top" align="left"><?php echo $datos[$i]["NOMBRE"].' '.$datos[$i]["PATERNO"].' '.$datos[$i]["MATERNO"];?></td>
    <td valign="top" align="left"><?php echo $datos[$i]["CARGO"];?></td>
    <td valign="top" align="left"><?php echo $datos[$i]["MAQUINAS"];?></td>
    <td valign="top" align="left"><?php echo $datos[$i]["ESTADO"];?></td>
    <td valign="top" align="left"><?php echo $datos[$i]["FECHA"]; ?></td>
  </tr>  
  <?php
}
}
?>
</table>
<?  include("footer.php"); ?>
