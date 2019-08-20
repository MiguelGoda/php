<?php

include("//.php");
include("Class/class.php");

function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<?php
$q=$_POST[q];
$link=Conectarse();

$sql="select p.id_persona,p.nombres, p.ap_paterno, p.ap_materno, u.nombre_u, c.nombre from persona p, unidad u, campamento c WHERE p.id_campamento=c.id_campamento AND p.id_unidad=u.id_unidad AND p.nombres LIKE '%$q%' OR p.ap_paterno LIKE '%$q%' OR p.ap_materno LIKE '%$q%' group by p.nombres";
$res=mysql_query($sql,$link);
if(mysql_num_rows($res)==0){
	echo 'No hay nombres asociados a esas letras';
}else{
echo '<b>Sugerencias:</b><br />';
    print ' 
		<tr bgcolor="#75C2F3">	
<td align="center" valign="top" ><strong>Nombre</strong></td>
<td width="90" align="center" valign="top" ><strong>Ap Paterno</strong></td>
<td width="90" align="center" valign="top" ><strong>Ap Materno</strong></td>
<td width="250" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="120" align="center" valign="top" ><strong>Campamento</strong></td>
<td width="120" align="center" valign="top" ><strong>Cambiar</strong></td>
<td width="90" align="center" valign="top" ><strong>Seleccionar</strong></td>
</tr>';
while($row=mysql_fetch_array($res)){
	$i++; 
					   if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}					  
	print '			
<form name="frmPrueba" action="cambiar_campamento_id.php"><td valign="top" align="center">'.$row['nombres'].'</td>
<td valign="top" align="center"><font face="serif" size="-1">'.$row['ap_paterno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['ap_materno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['nombre_u'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['nombre'].'</font></td>
<td align="center">
<select name="id_campamento" required>';
   	$nr=new User();
   	$sup=$nr->get_tabla("campamento"); 
     for($j=0;$j<sizeof($sup);$j++){
 print '<option value="'.$sup[$j]["id_campamento"].'" selected="selected" title="'.$sup[$j]["nombre"].'"> '.$sup[$j]["nombre"].'</option>';
        }
    print '</select></td>	
<td align="center" valign="top"><font face="serif" size="-1">
<input type="button" value="selec" onclick=document.frmPrueba.submit()></td>
</tr></form>
	';
}
}
?>