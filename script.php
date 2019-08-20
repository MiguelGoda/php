<? include("menuadmin.php"); ?>
 <?php
$fecha_inicio='2015-04-21';
$fecha_fin='2015-04-24';
$tr=new User();
$dtr=$tr->get_biometrico_fecha_final($fecha_inicio,$fecha_fin); 
 ?>
<table width="500" border="0" align="center">
  <tbody>
    <tr>
      <td colspan="4" style="text-align: center"><strong>Lista de Funcionarios Con Marcaciones Irregulares</strong></td>
    </tr>
    <tr bgcolor="#A0F3D8">
    <td style="text-align: center"><strong>#</strong></td>
      <td style="text-align: center"><strong>Nombre</strong></td>
      <td style="text-align: center"><strong>Nro</strong></td>
      <td style="text-align: center"><strong>Fecha</strong></td>
    </tr>
 <?php
  for($ji=0;$ji<sizeof($dtr);$ji++){
	 $tr_n=new User();
  	 $var_nro=$dtr[$ji]["nro"]; 
  	 $fech=$dtr[$ji]["fecha"];
	 $dt=$tr_n->get_biometrico_con_reg($fech, $var_nro); 
	 
	  for($s=0;$s<sizeof($dt);$s++){
		  $dt[$s]["nro"];
		  $dt[$s]["fecha"]; 
		  $atrasos=$dt[$s]["TOTAS_DIARIA"];
		if($atrasos!=' '){
			print '
			  <tr>
	   <td>'.$res=$res+1 .'</td>
      <td>'.$dt[$s]["nombres"].' '.$dt[$s]["ap_paterno"].' '.$dt[$s]["ap_materno"].'</td>
      <td>'.$dt[$s]["nro"].'</td>
      <td>'.$dt[$s]["fecha"].'</td>
    </tr>
			';
			$con=$con+1;
			}
		 }
		 }
  ?>
    <tr>
      <td colspan="4" align="center">
     <form method="GET" action="reporte_mensual.php">
      <input type="button" name="imprimir" value="Imprimir" onclick="imprimir();"/>
      <input type="hidden" name="inicio" value="<?php echo $fecha_inicio?>">
      <input type="hidden" name="fin" value="<?php echo $fecha_fin?>">
        <input type="hidden" name="grabar" value="si" />
        <input type="submit" name="ENVIAR" value="Detalles">
      </form>
      
      </td>
      
      
    </tr>
  </tbody>
</table>
