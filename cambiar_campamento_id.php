<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<? include("menuadmin.php"); 
 $t=new User();
$datos=$t->get_tabla_id("id_persona",$_GET["id"],"persona");
?>
<form id="form1" name="form1" method="post">
<table width="331" align="center" style="border-collapse : separate; text-align: center;">
  <tbody>
    <tr>
      <td width="150" style="text-align: left"><strong>Campamento actual:</strong></td>
      <td width="165" style="text-align: left">
        <?
	  $d=$datos[0]["id_campamento"];
       $tr=new User();
       $dat=$tr->get_tabla_id("id_campamento",$d,"campamento");
	  echo $dat[0]["nombre"]
	  ?>
      </td>
    </tr>
    <tr>
      <td style="text-align: left"><strong>Nombres;</strong></td>
      <td style="text-align: left"><? echo $datos[0]["nombres"].' '.$datos[0]["ap_paterno"].' '.$datos[0]["ap_materno"]?></td>
    </tr>
    <tr>
      <td style="text-align: left"><strong>Cambiar a:</strong></td>
      <td style="text-align: left"><select name="id_campamento" required>
        <?
  $nr=new User();
  $sup=$nr->get_tabla("campamento"); 
  for($j=0;$j<sizeof($sup);$j++){
	  ?>
        <option value="'<? echo $sup[$j]["id_campamento"]  ?>'" selected="selected" title="'<? echo $sup[$j]["nombre"] ?>'"> <? echo $sup[$j]["nombre"] ?></option>
        <? }?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
      <input type="button" name="Volver" id="button2" value="--Salir--" onclick = "location='crear_campamentos_personal.php'" />
      <input type="hidden" name="grabar" value="si">
      <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
      <input type="submit" name="button" id="button" value="GUARDAR"></td>
    </tr>
  </tbody>
</table>

</form>

<?
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
		  $link=Conectarse();
	     $campamento=$_POST["id_campamento"];
		 $value=$_POST["id"];
	echo $a=("update persona set id_campamento = $campamento where id_persona= $value");
      mysql_query($a);
   
 echo"<script type='text/javascript'>
			alert('AGREDADO CORRECTAMENTE');
			window.location='crear_campamentos_personal.php';
			</script>";

}
 
			?>
     
	


<?  include("footer.php"); ?>