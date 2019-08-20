<?php
require_once("class/class.php");

if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	//print_r($_POST);
	$t=new User();
	$t->loguear();
	//echo $pass_php=sha1($_POST["pass"]);
	exit;
}

?>
<!doctype html>
<html class="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<style type="text/css">
.H3 {
	color: #006600;
}
</style>
</head>
<body>
<table width="889" height="188" border="0" align="center">
  <tr>
    <td width="52" height="173">&nbsp;</td>
    <td width="761"><img src="images/banner.png" alt="San Pedro" width="791" height="164" /></td>
    <td width="62">&nbsp;</td>
  </tr>
</table>
<form name="form" action="" method="post">
<div id="LayoutDiv1" align="center" style="background:url(imagenes/logo_camino2.png) no-repeat center" >
    
      <p>&nbsp;</p>
      <p>&nbsp;</p>
   
      <table align="center">
        <tr>
        <td ></td>
      </tr>
      <tr>
        <td valign="top" align="center" colspan="2" width="400"><h3 class="H3"> INGRESA TUS DATOS</h3>          
        <hr color="#66FF33"/></td>
      </tr>
      <tr style="background-color:#6F3;">
        <td valign="top" align="right" width="100"><strong>Usuario:</strong></td>
        <td valign="top" align="left" width="200"><input style="background:#FFC" type="text" name="user" placeholder="usuario" required /></td>
      </tr>
        <tr>
        <td valign="top" align="center" colspan="2"> 
      <tr style="background-color:#6F3"; >
        <td valign="top" align="right" width="100"> <strong>Password:</strong></td>
        <td valign="top" align="left" width="200"><input style="background:#FFC" type="password" name="pass" placeholder="Password" required /></td>
      </tr>
      <tr>
        <td valign="top" align="center" colspan="2"><hr color="#66FF33" />     
        <input type="hidden" name="grabar" value="si" />
          <input type="submit" value="INICIAR" title="Iniciar secion" /></td>
      </tr>
    </table></form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>


</body>
</html>
