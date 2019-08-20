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
    $tra->add_maquinas();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
        <tr>
          <td colspan="2" align="center"><h3> Nueva Maquinaria: 
               </h3></td>
        </tr>
         <tr>
           <td width="189" align="left">Codigo Maquina</td>
           <td width="290" align="left"></span>
           <input name="cod" type="text" id="cod" required="required" placeholder="Nro de Memo" /></td>
         </tr>
         <tr>
           <td align="left">Estado Mquina</td>
           <td align="left"></span>
           <input name="estado" type="text" size="50" id="estado" required="required" placeholder="Estado" /></td>
         </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='reporte_maquinas.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Agregar" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>