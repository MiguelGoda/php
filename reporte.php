<?php  include("menuadmin.php"); ?>

<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">

<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
      <!--LISTA DE ACTIVOS-->
        <table width="750" align="center" class="altrowstable" id="alternatecolor" >
        
          <?php
$tra=new User();
$link=Conectarse();	
$RegistrosAMostrar = 20;
if(isset($_GET['page'])) {
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    $PaginaActual=$_GET['page'];
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
} 

if($nom[0]["nombres"]==$admin){
$datos=$tra->get_biometrico($RegistrosEmpezar,$RegistrosAMostrar);
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
 FROM biometrico b, persona p, unidad u
 where b.nro = p.id_persona and p.id_unidad =  u.id_unidad",$link));
}else{
$datos=$tra->get_biometrico_user($nom[0]["id_unidad"],$RegistrosEmpezar,$RegistrosAMostrar);
$u=$nom[0]["id_unidad"];
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
 FROM biometrico b, persona p, unidad u
 where b.nro = p.id_persona and p.id_unidad =  u.id_unidad and p.id_unidad='$u'",$link));
}
// AQUI HACEMOS LA PAGINACION

$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;
    ?>  <tr valign="top" bgcolor="#75C2F3">     
   <td colspan="6" align="center"><strong>Listado de Funcionarios</strong></td> </tr>
    <tr valign="top" bgcolor="#75C2F3"> 

 <td colspan="6" align="right">
   Exportar por fecha:
  
   
 
<?php
if($nom[0]["nombres"]==$admin){
?>
<form method="post" action="exportar_excel.php" >
 <input type="date" name="fecha" id="fecha" value="<? echo $fin    = date('Y-m-d'); ?>"> 
   <input type=image src="images/Excel.png" width="45" height="30">
<?php
}else{
?><form method="post" action="exportar_excel_user.php" >

  <input type="date" name="fecha" id="fecha" value="<? echo $fin    = date('Y-m-d'); ?>"> 
   <input type="hidden" name="u" value="<?php echo $nom[0]["id_unidad"];?>">
   <input type=image src="images/Excel.png" width="45" height="30">
<?php
	}
?>   

  </td></form>
          </tr>
          <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Departamento </strong></td>
            <td align="center" valign="top" ><strong>Nombre</strong></td>
            <td align="center" valign="top" ><strong>Nro</strong></td>
               <td align="center" valign="top" ><strong>Fecha</strong></td>
            <td align="center" valign="top" ><strong>Hora</strong></td>
            <td align="center" valign="top" ><strong>Observacion</strong></td>
          </tr>
          <?php
for($i=0;$i<sizeof($datos);$i++)
{
if ($i%2==0){
	?>
    <tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#F4F7EB';" >
    <?php
}else{
	?>
   <tr onMouseOver="this.style.backgroundColor='#ffff66';" onMouseOut="this.style.backgroundColor='#F5E68E';">
   <?php
}
?>
            <td valign="top" align="left"><font face="serif" size="-1"><?php echo $datos[$i]["UNIDAD"];?></font></td>
            <td valign="top" align="left"><font face="serif" size="-1"><?php echo $datos[$i]["NOMBRE"].' '.$datos[$i]["PATERNO"].' '.$datos[$i]["MATERNO"];?></font></td>
             <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["NRO"];?></font></td>
             <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["FECHA"];?></font></td>
             <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["HORA"];?></font></td>
            <td valign="top" align="center"><font face="serif" size="-1"><?php echo $datos[$i]["OBSERVACION"];?></font></td>
            </tr>
            
          <?php
}
?>
<tr valign="top"><td colspan="6" align="center"><h4><strong> <?php if($Respuesta>0) $UltimaPagina=floor($UltimaPagina)+1;
echo "<a href=\"reporte.php\">Inicio</a> |";
if($PaginaActual>1) echo "<a href=\"reporte.php?page=".$PaginaAnteior."\">Anterior</a> |";echo "<b>(".$PaginaActual." / ".$UltimaPagina.")</b> |";
if($PaginaActual<$UltimaPagina)  echo " <a href=\"reporte.php?page=".$SiguientePagina."\">Siguiente</a> |";
echo "<a href=\"reporte.php?page=".$UltimaPagina."\">Ultima</a>";?> </strong></h4></td></tr>
        </table>
<?  include("footer.php"); ?>