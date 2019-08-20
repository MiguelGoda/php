<?php
include("menuadmin.php");
?>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <tr> 
      <td width="186" align="left"></td>
      <td width="183" >&nbsp;</td>
            <td width="201">&nbsp;</td>
                  <td width="154" ></td>
      <td width="160" align="left" ><a href="insercion_manual_asistencia.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></td>
    </tr>
        <tr> 
      <td width="186" align="left"></td>
      <td width="183" >Buscar Funcionario :</td>
            <td width="201"><input type="text" id="texto" onkeypress="BuscarFuncionarioCampamento();"  size="30"/></td>
                  <td width="154" ></td>
      <td width="160" align="left" >&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5" align="center">
    <h4>&nbsp;</h4></td>
  </tr>
   <tr>
    <td colspan=" 7">
<table id="buscador" style="border-collapse : separate;" align="center">
  </table>
 </td>
  </tr>
  
</table>
<?  include("footer.php"); ?>