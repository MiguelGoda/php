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
    $tra->add_familia();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
        <tr>
          <td colspan="2" align="center"><h3> Agregar Familiar a : 
      <?
	  $tra2=new User();
$dato=$tra2->get_tabla_id("id_persona",$_GET["id"],"persona");
echo $dato[0]["nombres"].' '.$dato[0]["ap_paterno"].' '.$dato[0]["ap_materno"];?>
          </h3></td>
        </tr>
        <tr>
          <td width="189">Nombre y Apellido:</td>
          <td width="290"><input name="nombre" type="text" id="nombre" size="35" required="required" placeholder="Nombres y Apellidos" /></td>
        </tr>
         <tr>
           <td>Fecha Nacimiento:</td>
           <td><input name="fecha" type="text" id="fecha" size="35"  placeholder="fecha" /></td>
         </tr>
         <tr>
          <td width="189">Parentesco</td>
          <td width="290"><input name="parentesco" type="text" id="parentesco" size="35"  placeholder="Parentesco" required="required"/></td>
        </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='funcionarios.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Agregar familia" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>