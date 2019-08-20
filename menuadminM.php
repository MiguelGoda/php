<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Sistema de Tramite Documentario</title>
<?php  require_once("class/class.php");?>
<script type="text/javascript" src="menuadmin/stmenu.js"></script>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FF0000;
	font-weight: bold;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #6633FF;
}
-->
</style>
</head>
<body bgcolor="#D3D3D3">
<table width="1000" height="228" border="0" align="center">
  <tr>
    <td width="52" height="173">&nbsp;</td>
    <td width="1000"><img src="images/banner.png" alt="San Pedro" width="990" height="180" /></td>
    <td width="62">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >
			<script type="text/javascript" src="menuadmin.js"></script>	</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  <?  date_default_timezone_set('America/La_Paz');?>
    <td align="center" ><div align="right"><? $stime=date("d-m-Y H:i:s");$fecha_actual=date("d")."  de  ".date("m")."  del  ".date("Y")." Hora ".date("H:i");
			$fecha_ingreso=$fecha_actual; ?><img src="imagenes/user.jpg" width="25" height="23" /> &nbsp;&nbsp;&nbsp;&nbsp;<span class="Estilo1">Fecha del Sistema:</span><span class="Estilo2"> <? echo $fecha_ingreso ?>
    </span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><hr color="#679bb0" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>