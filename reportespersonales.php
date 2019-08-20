<?php include("menuadmin.php"); ?>
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
if($nom[0]["nombres"]==$admin){
?>
       <table width="666" align="center" >
          <td colspan="5" align="center"><h4>Buscar Unidad de Tramite:
       <input type="text" id="texto" onkeypress="Buscarpersonal();"  size="30"/>
</tr>
</table>
   <table width="800" align="center" id="buscador">
   </table>
      <?php
}else{
?>	
	<table width="666" align="center" >
          <td colspan="5" align="center"><h4>Buscar Unidad de Tramite:
       <input type="text" id="texto" onkeypress="BuscarpersonalUser();"  size="30"/>
</tr>
</table>
   <table width="800" align="center" id="buscador">
   </table>
<?php
	}
?>    
      
   
        <table width="800" align="center" class="altrowstable" id="alternatecolor" >
        
          <?php
$tra=new User();
$link=Conectarse();	
$RegistrosAMostrar = 12;
if(isset($_GET['page'])) {
    $RegistrosEmpezar=($_GET['page']-1)*$RegistrosAMostrar;
    $PaginaActual=$_GET['page'];
} else {
    $RegistrosEmpezar=0;
    $PaginaActual=1;
} 
if($nom[0]["nombres"]==$admin){
$datos=$tra->get_biometrico_dist($RegistrosEmpezar,$RegistrosAMostrar);
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad group by b.nro",$link));
}else{
	$datos=$tra->get_biometrico_dist_user($nom[0]["id_unidad"],$RegistrosEmpezar,$RegistrosAMostrar);
$u=$nom[0]["id_unidad"];
$NumeroRegistros=mysql_num_rows(mysql_query("SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and p.id_unidad='$u' group by b.nro ",$link));
}

// AQUI HACEMOS LA PAGINACION
$PaginaAnteior=$PaginaActual-1;
$SiguientePagina=$PaginaActual+1;
$UltimaPagina=$NumeroRegistros/$RegistrosAMostrar;
$Respuesta=$NumeroRegistros%$RegistrosAMostrar;
    ?>  
    
    <tr valign="top" bgcolor="#75C2F3">     
   <td colspan="7" align="center"><strong>Listado de Funcionarios</strong></td> </tr>

          <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Departamento </strong></td>
            <td align="center" valign="top" ><strong>Nombre</strong></td>
            <td align="center" valign="top" ><strong>Nro</strong></td>
               <td align="center" valign="top" ><strong>Fecha</strong></td>
            <td align="center" valign="top" ><strong>Hora</strong></td>
            <td align="center" valign="top" ><strong>Selec</strong></td>
             <td align="center" valign="top" ><strong>Sancion</strong></td>
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
            <td valign="top" align="center"><a href="reportes_id.php?id=<?php echo $datos[$i]["NRO"];?>" title="Selec <?php echo $datos[$i]["NOMBRE"];?>" ><img src="images/click2.jpg" width="35" height="30" /></a></td>
            <td valign="top" align="center"><a href="sancionar.php?id=<?php echo $datos[$i]["NRO"];?>" title="Selec <?php echo $datos[$i]["NOMBRE"];?>" ><img src="images/TIPORETEN.png" width="35" height="30" /></a></td>
            </tr>
            
          <?php
}
?>
<tr valign="top"><td colspan="6" align="center"><h4><strong> <?php if($Respuesta>0) $UltimaPagina=floor($UltimaPagina)+1;
echo "<a href=\"reportespersonales.php\">Inicio</a> |";
if($PaginaActual>1) echo "<a href=\"reportespersonales.php?page=".$PaginaAnteior."\">Anterior</a> |";echo "<b>(".$PaginaActual." / ".$UltimaPagina.")</b> |";
if($PaginaActual<$UltimaPagina)  echo " <a href=\"reportespersonales.php?page=".$SiguientePagina."\">Siguiente</a> |";
echo "<a href=\"reportespersonales.php?page=".$UltimaPagina."\">Ultima</a>";?> </strong></h4></td></tr>
        </table>
<?  include("footer.php"); ?>