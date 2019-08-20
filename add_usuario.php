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
    $tra->add_usuario();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
        <tr>
          <td colspan="2" align="center"><h3>Ingrese Usuario</h3></td>
           <tr>
          <td width="189">Usuario:</td>
          <td colspan="4" style="text-align: center">
            <select name="id_persona">
                           
              <?php $tra=new User();
   			 $sup=$tra->get_tabla("persona");
         ?>
              
              <?php
        for($i=0;$i<sizeof($sup);$i++)
        {
            ?>
              <option value="<?php echo $sup[$i]["id_persona"];?>" title="<?php echo $sup[$i]["nombres"].' '.$sup[$i]["ap_paterno"];?>"><?php echo $sup[$i]["nombres"].' '.$sup[$i]["ap_paterno"];?></option>
              <?php
        }
        ?>   
              </select></td>
        </tr>
        </tr>
        <tr>
          <td width="189">Usuario:</td>
          <td width="290"><input name="usuario" type="text" size="35" required="required" placeholder="usuario" /></td>
        </tr>
         <tr>
          <td width="189">Contraseña:</td>
          <td width="290"><input name="password" type="password" size="35"  required="required" placeholder="contraseña" /></td>
        </tr>
         <tr>
          <td width="189">Detalles:</td>
          <td width="290"><input name="detalles" type="text" size="35" placeholder="opsional" /></td>
        </tr>
    
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='listusuario.php'">           
            <input type="hidden" name="grabar" value="si" />
            <input type="submit" name="button" id="button" value="Agregar Tramite"/></td>
        </tr>
      </table>
  </form>
  
 </div>
<?  include("footer.php"); ?>