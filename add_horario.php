<?  include("menuadmin.php"); ?>
<html>
<head>
<title></title>
<p>
  <?php
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_horario();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="531" border="0" align="center">
        <tr>
          <td colspan="4" align="center"><h3>Nuevo Horario</h3></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><h3 style="text-align: left">Nombre Horario:
            <input type="text" name="nombre_h" id="nombre_h" required="required" />
          </h3></td>
        </tr>
              
        <tr>
          <td width="120" align="center" style="text-align: left">Entrada Ma&ntilde;ana</td>
          <td  align="center"><input type="time" name="entrada1" id="entrada1" required="required" /></td>
          <td width="120" align="center" style="text-align: left">Salidad Ma&ntilde;ana</td>
          <td  align="center"><input type="time" name="salida1" id="salida1" required="required" /></td>
        </tr>
        <tr>
          <td align="center" style="text-align: left">Entrada Tarde</td>
          <td align="center"><input type="time" name="entrada2" id="entrada2" required="required" /></td>
          <td align="center" style="text-align: left">Salidad Tarde</td>
          <td align="center"><input type="time" name="salida2" id="salida2" required="required" /></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='horarios.php'" />
            <input type="hidden" name="grabar" value="si" />
          <input type="submit" name="button" id="button" value="Agregar Tramite" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>