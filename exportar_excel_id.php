<?php 
header("Content-type: application/vnd.ms-excel" ) ; 
header("Content-Disposition: attachment; filename=archivo.xls" ) ; 
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
$id=$_GET["id"];
$inicio=$_GET["inicio"];
$fin=$_GET["fin"];
$qry=mysql_query("SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
			 fecha >= '$inicio' AND fecha <= '$fin' AND
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and p.id_persona = $id;" ) ; 
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