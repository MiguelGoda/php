<?  include("menuadmin.php"); ?>
<html>
<head>
<?php
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_maquinas_();
		
    exit;
}
?>

<div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
      
        <tr>
         <td width="189"><strong>Maquina Actual:</strong></td>
          <td colspan="2" align="left">
                <?php
  $tim=new User();
 $id2=$_GET["id"];
$doc=$tim->get_tabla_id("id_persona",$id2,"persona");
  $cod=$doc[0]["cod_maquinas"];
   $tra4=new User();
$d=$tra4->get_tabla_id("cod_maquinas",$cod,"maquinas"); 
 echo $d[0]["cod_maquinas"];

 ?>
</td>
        </tr>
        <tr>
          <td colspan="2" align="center"> </td>
        </tr>
              <tr>
          <td width="189"><strong>Cambiar :</strong></td>
          <td width="290"><select name="cod_maquinas" required>
                <option value=" "> Ninguna</option>
                <?php $tra=new User();
   			 $sup=$tra->get_tabla("maquinas");
         ?>
                <?php
        for($i=0;$i<sizeof($sup);$i++)
        {
            ?>
                <option value="<?php echo $sup[$i]["cod_maquinas"];?>" title="<?php echo $sup[$i]["cod_maquinas"];?>"><?php echo $sup[$i]["cod_maquinas"];?></option>
                <?php
        }
        ?>
          </select>
          
           <a href="add_maquinarias.php" title="AGREGAR FUNCIONARIO" onclick="window.open(this.href,'window','width=600, height=500');return false">
 <img src="images/add.png" width="28" height="25" alt=""/>AGREGAR </a>
          </td>
        </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='funcionarios.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Nueva Maquina" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>