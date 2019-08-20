<?php include("menuadmin.php"); ?>

<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>  
 <table width="800"  border="0" align="center">
<form method="GET" action="reporte_mensual.php"> 
<tr>
<td height="30" colspan="3" align="center"><u>Reporte Mensual General</u></td>
</tr>
<tr>
<td width="244" align="left">
 Fecha Inicio:
   <input type="date" name="inicio" placeholder="<? echo date('Y-m-d'); ?>" value="<? echo date('Y-m-d'); ?>">
 </td>
 <td width="203" align="left"> Fin: 
  <input type="date" name="fin" placeholder="<? echo date('Y-m-d'); ?>" value="<? echo date('Y-m-d'); ?>"></td>
  <input type="hidden" name="grabar" value="si" />
  <td width="247" align="left"><input type="submit" name="buscar2" value="Buscar" /></td>
<td width="88" align="left">&nbsp;</td>
</tr></form>
<form method="GET" action="reporte_mensual_final_fijos.php"> 

<tr>
<td height="54" colspan="3" align="center" valign="bottom">&nbsp;</td>
<td width="88" align="left">&nbsp;</td>
</tr></form>
</table>    

<?  include("footer.php"); ?>