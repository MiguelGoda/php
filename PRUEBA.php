<?php include("menuadmin.php"); ?>

<html>
<head>
<title>SISTEMA BIOMETRICO</title>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<script type="text/javascript" src="js/funcione.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">


</head>
<body> 
<embed src=”manual.pdf” width=”500? height=”375?>
<form method="post" action="PRUEBA.php"> <table align="center">
<tr>
<td> Fecha:<input type="date" name="inicio" value="<?php echo $_POST['inicio']; ?>" placeholder="2015-01-01"><input type="date" name="fin"  value="<?php echo $_POST['fin']; ?>" placeholder="2015-01-31"></td>
<td><input type="submit" name="buscar" value="Buscar" ></td>
</tr> </table>    
 <table align="center"  border="1"></form>
<?php	  
$tra=new User();
$datos=$tra->get_biometrico_dist5();
if(sizeof($datos)==0)
{
    ?>
    <tr>
      <td colspan="8" align="center"><h4><strong>NO HAY REGISTROS ASOCIADOS A ESTA CATEGORIA</strong></h4></td></tr>
    <?php
}else
{
?>
 <?php
for($i=0;$i<sizeof($datos);$i++)
{
$prue=new User();
$d=20;
$dato_id=$prue->get_biometrico_id($datos[$i]["nombres"]);
$aux=$datos[$i]["fecha"];
$fech = strtotime($aux);
$d = date("d", $fech);$d2 = date("d", $fech);


if ($i%2==0){
echo '<tr bgcolor="#F4F7EB" >';
}else{
echo '<tr bgcolor="#7AE5E7" >';
}
 ?>

  <td  align="center" valign="top" style="text-align: justify" width="166"><font face="serif" size="-1"><?php if(i==0) echo "NOMBRES <BR>";
  echo $datos[$i]["nombres"]; ?></font></td> 
  <td  align="center" valign="top" style="text-align: justify" width="166"><font face="serif" size="-1"><?php if(i==0) echo "UNIDAD	 <BR>";
  echo $datos[$i]["dpto"]; ?></font></td> 
  
   <?php 
for($j=0;$j<sizeof($dato_id);$j++){
	//______________fecha________________________	
$fecha=$dato_id[$j]["fecha"];
$date = strtotime($fecha);
$dia = date("d", $date);

//_____________cierra fecha___________________
	   ?>

 <?php 
 if($dia==$d){
	echo '<td width="20">' ;
 if($i==0 and $dia==$d){
	 echo $dia; 
	 } $d=$d+1;
	
 }
	  			
$prue2=new User();
$dato_id2=$prue2->get_biometrico_id2($dato_id[$j]["nombres"],$dato_id[$j]["fecha"]);
if($dia==$d2){
	 $d2=$d2+1;
	 
for($k=0;$k<4;$k++){
?>
  <?php echo $dato_id2[$k]["observacion"];?>
   <?php }}

   ?>
  </td>
  <?php }?>
<td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php if(i==0) echo "DIAS<BR> A <BR>CUMPLIR <BR>";

 echo $datos[$i]["TOTALDIAS"];?></font></td>
 <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php if(i==0) echo "TRABAJO<BR> ACTUAL <BR><BR>";
 echo $datos[$i]["ASISTENCIAS"];?></font></td>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php if(i==0) echo "FALTAS <BR><BR><BR>";
  echo $datos[$i]["FALTAS"]; ?></font></td>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php if(i==0) echo "ATRASO<BR> 2 Hrs. <BR><BR>";
  echo $datos[$i]["ATRASO"]; ?></font></td>
  <td align="center" valign="top" style="text-align: justify"><font face="serif" size="-1"><?php if(i==0) echo "ATRASO<BR> 3 hRS. <BR><BR>";
  echo $datos[$i]["ATRASOS"]; ?></font></td>
 </tr>         
  <?php } ?></table>
<?  }include("footer.php"); ?>