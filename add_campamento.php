
   <?php
 require_once("class/class.php");
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_campamento();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
        <tr>
          <td colspan="2" align="center"><h3> Nuevo Campamento: 
          </h3></td>
        </tr>
        <tr>
          <td width="189" align="left">Nombre Campamento:</td>
          <td width="290" align="left"><input name="nombre" type="text" id="nombre" placeholder="Nombre del Memorandum"  required/></td>
        </tr>
         <tr>
           <td align="left">Descripcion:</td>
           <td align="left"></span>
           <input name="descripcion" type="text" id="descripcion" placeholder="Opsional" /></td>
         </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='listprocedencia.php'" />
           
            <input type="hidden" name="grabar" value="si" />
                   <input type="submit" name="button" id="button" value="Agregar" onclick="window.opener.location.reload();" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>