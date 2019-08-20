<? include("menuadmin.php"); 
if($nom[0]["nombres"]==$admin){

?>
<html>
<title></title>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  <td colspan="10">Listado De Funcionarios</td>  </tr>
  <tr>
    <td width="113" height="30">&nbsp;</td>
   <td colspan="3" align="center"><h4>&nbsp;&nbsp;Buscar por nombre de usuario:
       <input type="text" id="texto" onkeypress="Buscarfuncionario2();"  size="30"/>
   </h4></td>
    <td colspan="3" >
     <?php
if($nom[0]["nombres"]==$admin){
?>
 <a href="add_funcionario.php" title="AGREGAR FUNCIONARIO">
<?php
}else{
?>	
<a href="salir.php?id=funcionarios.php" title="Eliminar <?php echo $datos[$i]["usuario"];?>" >
<?php
	}
?>   
   <img src="images/add.png" width="28" height="25" alt=""/>AGREGAR </a></td>
    
  </tr>
  </table>
  <table width="700" align="center" id="buscador" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
   </table>
  

<? }else{	
 echo"<script type='text/javascript'>
			alert('No tiene persmisos para acceder a este contenido');
			window.location='inicio.php';
			</script>";

	}  

 include("footer.php"); ?>
