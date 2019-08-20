<?php
require_once("class/class.php");
if(isset($_SESSION['ses_user']))
{
//print_r($_SESSION);
$t=new User();
$nom=$t->saluda_al_usuario($_SESSION["ses_user"]);

$admin="admin";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Sistema de Tramite Documentario</title>
<script type="text/javascript">
function altRows(id){
 if(document.getElementsByTagName){ 
 var table = document.getElementById(id);  
 var rows = table.getElementsByTagName("tr");
 for(i = 0; i < rows.length; i++){        
 if(i % 2 == 0){
 rows[i].className = "evenrowcolor";
 }else{
 rows[i].className = "oddrowcolor";
 }      
 }
 }
}
window.onload=function(){
 altRows('alternatecolor');
}
</script>
 <style type="text/css">
 table.altrowstable {
 font-family: verdana,arial,sans-serif;
 font-size:11px;
 color:#333333;
 border-width: 1px;
 border-color: #a9c6c9;
 border-collapse: collapse;
 }
 table.altrowstable th {
 border-width: 1px;
 padding: 8px;
 border-style: solid;
 border-color: #a9c6c9;
 }
 table.altrowstable td {
 border-width: 1px;
 padding: 8px;
 border-style: solid;
 border-color: #a9c6c9;
 }
 .oddrowcolor{
 background-color:#F4F7EB;
 }
 .evenrowcolor{
 background-color:#c3dde0;
 }
 </style>
<script type="text/javascript" src="js/funcione.js"></script>
<script language="javascript" type="text/javascript">
function seleccionar_todo(){ 

   for (i=0;i<document.form.elements.length;i++) 

      if(document.form.elements[i].type == "checkbox") 

         document.form.elements[i].checked=1 

} 

function deseleccionar_todo(){ 

   for (i=0;i<document.form.elements.length;i++) 

      if(document.form.elements[i].type == "checkbox") 

         document.form.elements[i].checked=0 

} 
</script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<script type="text/javascript" src="menuadmin/stmenu.js"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css">
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
<table width="1000" height="153" border="0" align="center">
  <tr>
    <td width="80" height="72">&nbsp;</td>
    <td width="1000"><img src="imagenes/BANNER.jpg" alt="San Pedro" width="990" height="70" /></td>
    <td width="62">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >
    
              <?php
if($nom[0]["nombres"]==$admin or $nom[0]["nombres"]== "Radio" ){
	if($nom[0]["nombres"]==$admin){
?>
 <script type="text/javascript" src="menuadmin.js"> </script>

 		<?php }	
		if($nom[0]["nombres"]=="Radio"){
		?>
        <script type="text/javascript" src="MenuRadio.js"> </script>
     
 		<?php }        ?>
<?php
}else{
?>	
	<script type="text/javascript" src="MenuUser.js"> </script>
 
<?php
	}
?>             
            
            	</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  <?  date_default_timezone_set('America/La_Paz');?>
    <td align="left" colspan="4" ><div align="right"><? $stime=date("d-m-Y H:i:s");$fecha_actual=date("d")."  de  ".date("m")."  del  ".date("Y")." Hora ".date("H:i");
			$fecha_ingreso=$fecha_actual; ?><img src="imagenes/user.jpg" width="25" height="23" /> 
 <span class="Estilo1">Hola </span> <span class="Estilo2"><?php echo $nom[0]["nombres"];?></span><span class="Estilo1">  bienvenido</span>
       <span class="Estilo1">Fecha del Sistema:</span><span class="Estilo2"> <? echo $fecha_ingreso ?>
    </span></td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><hr color="#679bb0" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
}else
{
	echo "
	<script type='text/javascript'>
	alert('Debe loguearse primero para acceder a este contenido');
	window.location='index.php';
	</script>
	";
}
?>