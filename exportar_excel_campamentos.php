<?php 
header("Content-type: application/vnd.ms-excel" ) ; 
header("Content-Disposition: attachment; filename=archivo.xls" ) ; 
echo '<td>CAMPAMENTO  ';
echo '</td>';
echo '<td>';
echo $_POST['campamento'].'</td>';
//en la sigte linea colocar entre comillas el nombre del servidor mysql (generalmente, localhost) 
$servidor="localhost"; 
//en la sigte linea colocar entre comillas el nombre de usuario 
$user="root"; 
//en la sigte linea colocar entre comillas la contraseña 
$pass="admin"; 
//en la sigte linea colocar entre comillas e nombre de la base de datos 
$db="db_asistencia"; 
//en la sigte linea colocar entre comillas e nombre de la tabla
$tabla="prestamosOcultar"; 
mysql_connect($servidor,$user,$pass) ; 
mysql_select_db($db) ; 
$fecha=$_POST["fecha"];
$cam=$_POST["id"];
$qry=mysql_query("
SELECT CONCAT( p.nombres, ' ', p.ap_paterno,' ', p.ap_materno) AS NOMBRES, c.cargo AS CARGO, p.cod_maquinas AS MAQUINAS, m.estado AS ESTADO,m.fecha_estado AS FECHA
 FROM
 persona p, maquinas m, contratacion as c
 where p.cod_maquinas = m.cod_maquinas 
 AND p.id_persona = c.id_persona
 AND   p.cod_maquinas != '0'
 AND p.id_campamento = $cam
 AND m.fecha_estado = '$fecha'
  GROUP BY p.cod_maquinas
ORDER BY p.id_persona DESC
" ) ; 
$campos = mysql_num_fields($qry) ; 
$i=0; 
echo "<table><tr>"; 
while($i<$campos){ 
echo "<td>". mysql_field_name ($qry, $i) ; 
echo "</td>"; 
$i++; 
} 
echo "</tr>"; 
while($row=mysql_fetch_array($qry)){ 
echo "<tr>"; 
for($j=0; $j<$campos; $j++) { 
echo "<td>".$row[$j]."</td>"; 
} 
echo "</tr>"; 
} 
echo "</table>"; 
?>