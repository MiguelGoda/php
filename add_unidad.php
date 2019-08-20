<?  include("menuadmin.php"); ?>
<html>
<head>
<title>Listado de Articulos-Botica "San pedro"</title>
<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body><p>
   <?php
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_unidad();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
        <tr>
          <td colspan="2" align="center"><h3>Ingrese Unidad</h3></td>
        </tr>
        <tr>
          <td width="189">Nombre unidad:</td>
          <td width="290"><input name="nombre" type="text" id="nombre" size="35" required="required" placeholder="Nombre Comision" /></td>
        </tr>
         <tr>
          <td width="189">Descripcion Unidad:</td>
          <td width="290"><input name="descripcion" type="text" id="descripcion" size="35"  placeholder="descripcion unidad" /></td>
        </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='listprocedencia.php'" />
           
            <input type="hidden" name="grabar" value="si" />
            <input type="submit" name="button" id="button" value="Agregar Tramite" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>