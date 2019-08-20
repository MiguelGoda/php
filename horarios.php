<? include("menuadmin.php"); ?>
<table width="750" border="0" align="center">
  <tbody>
   <tr>
      <td width="308"><a href="insercion_manual_asistencia.php"><img src="images/boton_volver.jpg" width="98" height="40" alt=""/></a></td>
    </tr>
   <?php

$tra=new User();
$datos=$tra->get_tabla("horarios");

if(sizeof($datos)==0)
{
    ?>
        <tr>
          <td colspan="6" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td>
        </tr>
        <?php
}else
{
?>
    <tr bgcolor="#71EC83"> 
      <td width="174">Horarios</td>
      <td width="141">Entrada Ma&ntilde;ana</td>
      <td width="139">Salidad Ma&ntilde;ana</td>
      <td width="140">Entrada Tarde</td>
      <td width="134">Salida Tarde</td>
       <td width="134">Ver Funcionarios</td>
    </tr>
           <?php

for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#BBF0EF" >';
}
?>
      <td><?php echo $datos[$i]["nom_horario"];?></td>
      <td><?php echo $datos[$i]["entrada1"];?></td>
      <td><?php echo $datos[$i]["salida1"];?></td>
      <td><?php echo $datos[$i]["entrada2"];?></td>
      <td><?php echo $datos[$i]["salida2"];?></td>
      <td align="center">
      <a href="ver_horarios.php?id=<?php echo $datos[$i]["id_horario"];?>" title="FUNCIONARIOS <?php echo $datos[$i]["nom_horario"];?>" > <img src="images/select.jpg" width="25" height="25" /></a>
      </td>
    </tr>
   
            <?php
}
}
?>    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
       <td>
        <a href="add_horario.php" title="Nuevo Horario">     
       <img src="images/add.png" width="28" height="25" alt=""/>AGREGAR </a></td>
    </tr>

  </tbody>
</table>



<?  include("footer.php"); ?>