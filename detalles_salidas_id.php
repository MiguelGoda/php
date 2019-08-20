<?php include("menuadmin.php"); ?>
<html>
<head>
<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<body>         
 <table width="800" align="center" >
        
          <?php
		  if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
		$inicio = $_POST["inicio"];
		$fin    = $_POST["fin"];
		$id = $_POST["id"];
		$tra=new User();
$datos=$tra->get_biometrico_dist3_salidas_id_2($id,$inicio,$fin);
}else{
$id = $_GET["id"];
$tra=new User();
$datos=$tra->get_biometrico_dist3_salidas_id($id);
}


// AQUI HACEMOS LA PAGINACION
    ?>  
     <tr valign="top" bgcolor="#75C2F3">
          
          <td colspan="6" align="center">Seleccione una Fecha para buscar</td>
         </tr>
        <tr valign="top" bgcolor="#75C2F3">
          <form action="" method="post">
          <td align="center">inicio:<input type="date" name="inicio" value="<? echo $inicio; ?>"> </td>
        <td align="center">fin:<input type="date" name="fin" value="<? echo $fin; ?>"></td>
        <td align="center" valign="top" colspan="3" >
         <input type="hidden" name="grabar" value="si">
         <input type="hidden" name="id" value="<? echo $_GET["id"] ?>">
        <input type="submit" name="enviar" value="buscar"></td><td style="text-align: right"><a href="permisos.php"><img src="images/boton_volver.jpg" width="98" height="25" alt=""/></a></td>
        </form>
         </tr>
 
          <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Nombre </strong></td>   
             <td align="center" valign="top" ><strong>Tipo <br> Tramite </strong></td> 
               <td align="center" valign="top" ><strong>Fecha </strong></td>    
                <td align="center" valign="top" ><strong>Hora <br>Salida </strong></td>  
                 <td align="center" valign="top" ><strong>Hora <br> Retorno </strong></td>     
             <td align="center" valign="top" colspan="3" ><strong>Total  permisos <br> en Min</strong></td>
 
          </tr>
          <?php
for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#7AE5E7" >';
}

?>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["nombres"]; ?></font></td>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["tipo_tramite"]; ?></font></td>
   <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["fecha"]; ?></font></td>
   <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["hora_salida"]; ?></font></td>
   <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["hora_retorno"]; ?></font></td>
   <td align="center" valign="top" colspan="3" style="text-align: justify"><font face="serif" size="-1"><?php  echo $datos[$i]["total_horas"]; ?> </font></td>
    
  
            </tr>
            
  <?php
}
?>

        </table>
<?  include("footer.php"); ?>