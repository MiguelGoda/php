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
    $tra->add_memo();
		
    exit;
}
?>

  <div class="content">

    <form id="form1" name="form1" method="post" action="">
      <table width="489" border="0" align="center">
        <tr>
          <td colspan="2" align="center"><h3> Meritos y Demeritos a: 
      <?
	  $tra2=new User();
$dato=$tra2->get_tabla_id("id_persona",$_GET["id"],"persona");
echo $dato[0]["nombres"].' '.$dato[0]["ap_paterno"].' '.$dato[0]["ap_materno"];?>
          </h3></td>
        </tr>
         <tr>
           <td align="left">Nro Memo:</td>
           <td align="left"></span>
           <input name="nro_memo" type="text" id="nro_memo" required="required" placeholder="Nro de Memo" /></td>
         </tr>
        
        
        <tr>
          <td width="189" align="left">Tipo Memo:</td>
          <td width="290" align="left"><span style="text-align: left">
          <select name="id_tipo_memo" required>
              <?php $tra=new User();
   			 $sup=$tra->get_tabla("tipo_memo");
         ?>
              <?php
        for($i=0;$i<sizeof($sup);$i++)
        {
            ?>
              <option value="<?php echo $sup[$i]["id_tipo_memo"];?>" title="<?php echo $sup[$i]["memo"];?>"><?php echo $sup[$i]["memo"];?></option>
              <?php
        }
        ?>
            </select>
         <a href="nuevo_memo.php" title="Agregar tipo memo" onclick="window.open(this.href,'window','width=500, height=400');return false" >Nuevo<img src="images/add.png" width="16" height="16" alt=""/></a></span></td>
        </tr>
        <tr>
           <td align="left">Fecha:</td>
           <td align="left"></span>
           <input name="fecha" type="date" id="fecha" required="required" placeholder="Fecha de memorandum" value="<? echo  $fin    = date('Y-m-d'); ?>"/></td>
         </tr>
         <tr>
           <td align="left">Observaciones:</td>
           <td align="left"></span>
           <input name="observaciones" type="text" id="observaciones" required="required" placeholder="MOTIVOS" /></td>
         </tr>
              
        <tr>
          <td colspan="2" align="center"><input type="button" name="button2" id="button2" value="--Salir--" onclick="location='funcionarios.php'" />
           
            <input type="hidden" name="grabar" value="si" />
             <input type="hidden" name="id" value="<? echo $_GET["id"]; ?>" />
            <input type="submit" name="button" id="button" value="Agregar Memo" /></td>
        </tr>
      </table>
  </form>


<?  include("footer.php"); ?>