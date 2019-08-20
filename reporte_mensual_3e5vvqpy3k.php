<?php include("menuadmin.php"); ?>


<?php 
function mostrarDatos ($resultados) {
if ($resultados !=NULL) {
echo $i." ".$resultados['nombre']." ".$resultados['ap_paterno']." ".$resultados['ap_materno']."<br/> ";

echo "**********************************<br/>";}
else {echo "<br/>No hay más datos!!! <br/>";}
}
function mostrarDatosFecha ($resultados) {
if ($resultados !=NULL) {
$aux=$resultados['fecha'];
$fech = strtotime($aux);
$d = date("N", $fech);
$nro = date("d", $fech);
   if($d==1){echo '<td   width="40" ><strong>'; $d='L';}
   if($d==2) {echo '<td   width="40" ><strong>';$d='M';}
   if($d==3) {echo '<td   width="40" ><strong>';$d='M';}
   if($d==4) {echo '<td   width="40" ><strong>';$d='J';}
   if($d==5) {echo '<td   width="40" ><strong>';$d='V';}
   if($d==6){echo '<td   width="40" style="padding: 5px; font-size: 12px; background-color: #83aec0; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #FFFFFF; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #558FA6; border-bottom-color: #558FA6; font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;" ><strong>'; $d='S';}
   if($d==7){echo '<td   width="40" style="padding: 5px; font-size: 12px; background-color: #83aec0; background-image:url(imagenes/fondo.png)
background-repeat: repeat-x;
color: #FFFFFF; border-right-width: 1px; border-bottom-width: 1px; border-right-style: solid; border-bottom-style: solid; border-right-color: #558FA6; border-bottom-color: #558FA6; font-family: ?Trebuchet MS?, Arial;
text-transform: uppercase;" ><strong>'; $d='D';}
 echo $d.'<BR>'.$nro;

echo "**********************************<br/>";}
else {echo "<br/>No hay más datos!!! <br/>";}
}
$inicio='2015-05-26';
$fin='2015-06-26';
$link = mysqli_connect("localhost", "root", "admin");
mysqli_select_db($link, "db_asistencia");
$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
$result = mysqli_query($link, "
SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno, p.sexo, p.ci AS CI, p.dias_pago AS DIAS_PAGO,p.tipo_descuento AS TIPO_DESCUENTO, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
sum(b.observacion='BM') AS BAJAMEDICA,
sum(b.observacion='C') AS COMISION,
sum(b.observacion='V') AS VACIONES,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona= b.nro AND
 c.id_persona = p.id_persona
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC");
while ($fila = mysqli_fetch_array($result)){
	echo $i=$i+1;
mostrarDatos($fila);
$result1 = mysqli_query($link,"select fecha from biometrico where fecha >= '$inicio' AND fecha <= '$fin' group by fecha");
while ($fila1 = mysqli_fetch_array($result1)){
mostrarDatosFecha($fila1);

}
}
mysqli_free_result($result);
mysqli_close($link);
?>
<?php
echo "<mm:dwdrfml documentRoot=" . __FILE__ .">";$included_files = get_included_files();foreach ($included_files as $filename) { echo "<mm:IncludeFile path=" . $filename . " />"; } echo "</mm:dwdrfml>";
?>