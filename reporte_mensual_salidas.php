<?php include("menuadmin.php"); ?>
<html>
<head>
<title></title>
<table width="1000" align="center" >
        
         <?php
$tra=new User();
$datos=$tra->get_biometrico_dist3_salidas();
   $inicio = $_POST["inicio"];
	$fin    = $_POST["fin"];
// AQUI HACEMOS LA PAGINACION
    ?>  
       <tr valign="top" bgcolor="#75C2F3">  
        <form action="reporte_mensual_salidas.php" method="post">
        <td colspan="13" align="center">inicio:<input type="date" name="inicio" value="<? echo $inicio; ?>">    
          fin:          
            <input type="date" name="fin" value="<? echo $fin; ?>" />          <input type="submit" name="enviar" value="buscar" /></td>
        <td width="142" align="center" valign="top" ><a href="permisos.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></td>
        </form>
         </tr>
    <tr valign="top" bgcolor="#75C2F3">  
   <td colspan="14" align="center"><strong>ASISTENCIAS DE FUNCIONARIOS GENERAL</strong></td>
 </tr>

          <tr bgcolor="#75C2F3" >
            <td width="20" align="center" valign="top"  ><strong>N&ordf;</strong></td> 
            <td align="center" valign="top" colspan="3" ><strong>Nombre </strong></td>   
             <td align="center" valign="top" colspan="3" ><strong>Fecha </strong></td>       
             <td width="150" align="center" valign="top" ><strong>Horas<br>de permiso<br> Particular</strong></td>
             <td align="center" valign="top" colspan="3" ><strong>Horas<br>de permiso<br> Oficial</strong></td>
             <td colspan="4" align="center" valign="top" ><strong>Detalles</strong></td>
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
<td align="center" width="20" style="text-align: justify"><font face="serif" size="-1"><?php echo $i+1; ?></font></td>
  <td align="center" valign="top" colspan="3" style="text-align: justify"><font face="serif" size="-1"><?php echo $datos[$i]["nombres"]; ?></font></td>
   <td align="center" valign="top" colspan="3" style="text-align: justify"><font face="serif" size="-1"><?php echo 'de: '.$inicio.'   hasta: '.$fin; ?></font></td>
   <td width="150" align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php 
    
 $id2=$datos[$i]["nro"];
$tr=new User();
$dato=$tr->get_biometrico_dist3_salidas_id_2($id2, $inicio, $fin);

$resultado=0;$resul=0;
for($j=0;$j<sizeof($dato);$j++)
{
	if(($dato[$j]["tipo_tramite"])=="PARTICULAR")$resultado = $resultado + ($dato[$j]["total_horas"]);
	if(($dato[$j]["tipo_tramite"])=="OFICIAL")$resul = $resul + ($dato[$j]["total_horas"]); 
}
   echo $resultado;
   //echo '  ';
   //echo date("i:s" , $resultado);  
    ?></font></td>
    
  <td valign="top" align="center" colspan="3"> <?php echo $resul; ?>  </td>
    <td valign="top" align="center" colspan="4"><a href="detalles_salidas_id.php?id=<?php echo $datos[$i]["nro"];?>&inicio=<?php echo $inicio;?>&fin=<?php echo $fin; ?>" title="<?php echo $datos[$i]["nombres"];?>"><img src="images/click2.jpg" width="25" height="25" /></a></td>
</tr>            
 <?php } ?>
</table>
<?  include("footer.php"); ?>