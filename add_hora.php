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
    $tra->add_hora();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
      
        <tr>
         <td width="189"><strong>Horario actual :</strong></td>
          <td colspan="2" align="left">
                <?php
  $tim=new User();
 $id2=$_GET["id"];
$doc=$tim->get_tabla_id("id_persona",$id2,"persona");
  $cod=$doc[0]["id_horario"];
   $tra4=new User();
$d=$tra4->get_tabla_id("id_horario",$cod,"horarios"); 
 echo $d[0]["nom_horario"];

 ?>
</td>
        </tr>
        <tr>
          <td colspan="2" align="center"> </td>
        </tr>
              <tr>
          <td width="189"><strong>Cambiar Horario :</strong></td>
          <td width="290"><select name="id_horario" required>
                
                <?php $tra=new User();
   			 $sup=$tra->get_tabla("horarios");
         ?>
                <?php
        for($i=0;$i<sizeof($sup);$i++)
        {
            ?>
                <option value="<?php echo $sup[$i]["id_horario"];?>" title="<?php echo $sup[$i]["nom_horario"];?>"><?php echo $sup[$i]["nom_horario"];?></option>
                <?php
        }
        ?>
          </select></td>
        </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='funcionarios.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Cambiar Horario" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>