<? include("menuadmin.php"); ?>
<html>
<body>
<link href="css/styles.css" rel="stylesheet" type="text/css">

<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
          <?php
$tra=new User();
$link=Conectarse();	
$RegistrosAMostrar = 8;
if(isset($_GET['page'])) {
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    $PaginaActual=$_GET['page'];
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
} 
$datos=$tra->get_biometrico_dist($RegistrosEmpezar,$RegistrosAMostrar);
// AQUI HACEMOS LA PAGINACION
$NumeroRegistros=mysql_num_rows(mysql_query("select * from persona",$link));
$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;
    ?> 
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="113" height="30">&nbsp;</td>
   <td colspan="3" align="center"><h4><strong>Listado De Funcionarios</strong></h4></td>
    <td colspan="3" ></td>
  </tr>
  <?php

$tra=new User();
$datos=$tra->get_tabla_lim("persona",$RegistrosEmpezar,$RegistrosAMostrar);

if(sizeof($datos)==0)
{
    ?>
    <tr>
      <td colspan="8" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else
{
?>
<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Nombre</strong></td>
<td width="122" align="center" valign="top" ><strong>Apellido Paterno</strong></td>
<td width="128" align="center" valign="top" ><strong>Apellido Materno</strong></td>
<td width="230" align="center" valign="top" ><strong>Unidad</strong></td>

<td width="51" align="center" valign="top" ><strong>Ficha Personal</strong></td>
</tr>
<?php

for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}
?>
  <td valign="top" align="center"><a href="ver_funcionario.php?id=<?php echo $datos[$i]["id_persona"];?>" title="<?php echo $datos[$i]["nombres"];?>"><?php echo $datos[$i]["nombres"];?></a></td>
<td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["ap_paterno"];?></font></td>
<td align="center" valign="top"><font face="serif" size="-1"><?php echo $datos[$i]["ap_materno"];?></font></td>
<td align="center" valign="top"><font face="serif" size="-2"><?php
   $tra2=new User();
$dato=$tra2->get_tabla_id("id_unidad",$datos[$i]["id_unidad"],"unidad");
echo $dato[0]["nombre_u"];
 ;?></font></td>
<td valign="top" align="center"><a href="ver_funcionario.php?id=<?php echo $datos[$i]["id_persona"];?>" title="Llamar Atencion <?php echo $datos[$i]["nombres"];?>" ><img src="images/select.jpg" width="25" height="25" /></a></td>

<?php
}
?>

<tr valign="top"><td colspan="6" align="center"><h4><strong> <?php if($Respuesta>0) $UltimaPagina=floor($UltimaPagina)+1;
echo "<a href=\"permisos.php\">Inicio</a> |";
if($PaginaActual>1) echo "<a href=\"permisos.php?page=".$PaginaAnteior."\">Anterior</a> |";echo "<b>(".$PaginaActual." / ".$UltimaPagina.")</b> |";
if($PaginaActual<$UltimaPagina)  echo " <a href=\"permisos.php?page=".$SiguientePagina."\">Siguiente</a> |";
echo "<a href=\"permisos.php?page=".$UltimaPagina."\">Ultima</a>";?> </strong></h4></td></tr>
</tr>
<?php
}
?>
   
</table>

<?  include("footer.php"); ?>
