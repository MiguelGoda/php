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
	$inicio = $_POST["inicio"];
	$fin    = $_POST["fin"];
$qry=mysql_query("SELECT nombres AS NOMBRES, sum(observacion='FALTA') AS ATRASO4HORAS,
sum(observacion='ATRASO') AS ATRASO2HORAS,
sum(observacion='ATRASOS') AS ATRASO3HORAS,
(((sum(observacion='ATRASO'))*2)+((sum(observacion='ATRASOS'))*3)+((sum(observacion='FALTA'))*4)) AS TotalHorasAtraso,
format(sum(observacion='A')/4,2) AS ASISTENCIASREGULARES,
FORMAT (count(observacion)/4,2) AS TOTALDIAS
FROM biometrico 
where fecha >= '$inicio' and fecha <= '$fin' GROUP BY nro;" ) ; 
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