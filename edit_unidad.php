<?  include("menuadmin.php"); ?>
<html>
<head>
<title>Listado de Articulos-Botica "San pedro"</title>
<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
   $tra=new User();
$datos=$tra->get_tabla_id("id_unidad",$_GET["id"],"unidad");

if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	//print_r($datos);
    $tra->edit_unidad();
    exit;
}
   
   ?>
  <div class="content">
    <form action="" method="post">
    <table width="374" border="0" align="center">
      <tr>
        <td colspan="2"><h3>Actualizar unidad</h3></td>
      </tr>
      <tr>
        <td width="133">nombre</td>
        <td width="198"><input name="nombre" type="text" size="35" value="<?php echo $datos[0]["nombre_u"];?>" required placeholder="nombre" /></td>
      </tr>
      <tr>
        <td>Precidente</td>
        <td><input name="descripcion" type="text" size="35"  value="<?php echo $datos[0]["descripcion_u"];?>" /></td>
      </tr
        ><td colspan="2" align="center">
        <input type="button" name="button2" id="button2" value="--Salir--"onclick = "location='listprocedencia.php'" />
        <input type="hidden" name="grabar" value="si" />
         <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
          <input type="submit" value="Guardar Cambios" onclick="window.opener.location.reload();"/></td>
      </tr>
    </table>
    </form>
  </div>
  <?  include("footer.php"); ?>
