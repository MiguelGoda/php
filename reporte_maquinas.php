<? include("menuadmin.php"); ?>
<html>
<title></title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<body>
<table width="798" align="center" bgcolor="#FFFFFF" style="border-collapse : separate; ">
        <tr>
        <td colspan="1" ><?php
if($nom[0]["nombres"]==$admin or $nom[0]["nombres"]=="Radio"){
?>
            <a href="add_maquinarias.php" title="AGREGAR FUNCIONARIO" >
              <?php
}else{
?>
              <a href="salir.php?id=listprocedencia.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
              <?php
	}
?>
              <img src="images/add.png" width="28" height="25" alt=""/>AGREGAR </a></td>
          <td colspan="1" align="center"><h4><strong>Listado de Maquinarias</strong></h4></td>
                     
      <td width="180"><a href="insercion_manual_asistencia.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></td>
                 
        </tr>
        <?php

$tra=new User();
$datos=$tra->get_maquinas();

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
          <td width="129" align="center" valign="top" ><strong>Maquinarias</strong></td>
          <td width="473" align="center" valign="top" ><strong>Estado Actual</strong></td>
          <td width="180" align="center" valign="top" ><strong>Usuario</strong></td>
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
               <td valign="top" align="left"><?php echo $datos[$i]["cod_maquinas"];?></td>
          <td valign="top" align="left">
          <?php echo $datos[$i]["estado"];?>
          </td>
          <td valign="top" align="left">
                          <?php
  $tim=new User();
 $id2=$datos[$i]["cod_maquinas"];
$doc=$tim->get_tabla_id("cod_maquinas",$id2,"persona");
 $cod=$doc[0]["nombres"].' '.$doc[0]["ap_paterno"].' '.$doc[0]["ap_materno"];
  echo $cod;
 ?>
          </td>
        </tr>
        <?php
}
}
?>
      </table>
<?  include("footer.php"); ?>
