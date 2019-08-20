<?  include("menuadmin.php"); ?>
<html>
<head>
<?php
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_sancion_();
		
    exit;
}
?>

<div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
      
        <tr>
         <td width="189" align="right"><strong>Sancionar a:</strong></td>
          <td colspan="2" align="left">
                <?php
  $tim=new User();
 $id2=$_GET["id"];
$doc=$tim->get_tabla_id("id_persona",$id2,"persona");
 echo $doc[0]["nombres"].' '.$doc[0]["ap_paterno"].' '.$doc[0]["ap_materno"];

 ?>
</td>
        </tr>
        <tr>
          <td colspan="2" align="center"> </td>
        </tr>
        <tr>
          <td align="right"><strong>Tiempo de sancion:</strong></td>
          <td align="left"><input name="tiempo" type="text" required="required" id="tiempo" placeholder="Insertar tiempo en horas"  /></td>
        </tr>
          <tr>
          <td align="right"><strong>Fecha:</strong></td>
          <td align="left"><input name="fecha" type="date" required="required" id="fecha" placeholder="Insertar tiempo en horas"  /></td>
        </tr>
         <tr>
          <td align="right"><strong>Detalles</strong></td>
          <td align="left"><input type="text" name="detalle" id="detalle" size="45" /></td>
        </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='reportespersonales.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Nueva Maquina" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>