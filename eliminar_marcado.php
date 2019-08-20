<?  include("menuadmin.php"); ?>
<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>


<?php
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
echo $id=$_POST["id"];  
echo '<BR>';
echo $inicio= $_POST["inicio"];
echo $fin= $_POST["fin"];
$link=Conectarse();
$c1=("DELETE FROM biometrico WHERE nro = '$id' AND fecha >= '$inicio' AND fecha <= '$fin'");
mysql_query($c1); 

echo "<script type='text/javascript'>
			alert('Registro eliminado Correctamente');
			window.location='funcionarios.php';
			</script>";              
exit;
}
?>
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
    //$tra->add_familia();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
        <tr>
          <td colspan="4" align="center"><h3> Eliminar Marcacion a: 
      <?
	  $tra2=new User();
$dato=$tra2->get_tabla_id("id_persona",$_GET["id"],"persona");
echo $dato[0]["nombres"].' '.$dato[0]["ap_paterno"].' '.$dato[0]["ap_materno"];?>
          </h3></td>
        </tr>
        <tr>
          <td width="189">Seleccione una Fecha:</td>
          <td width="290"><input name="inicio" type="date" id="inicio" size="35" required="required" /></td>
          <td width="290"><input name="fin" type="date" id="fin" size="35" required="required" /></td>
        </tr>
              
        <tr>
          <td colspan="3" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='funcionarios.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Eliminar" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>