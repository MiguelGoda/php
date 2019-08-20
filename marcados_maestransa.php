<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<?php include("menuadmin.php"); 
 $inicio =$_POST['inicio'];
	//print_r($_POST["vect"]);
	echo "<br>";
	$i=0;
	$link=Conectarse();
while ($i < count ($_POST["vect"]) ) {
	print $maquina=$_POST["id"][$i];
    print $stado=$_POST["vect"][$i];

	if($maquina == ""){
		}else{
		 $maq=("insert into maquinas values(NULL,'$maquina','$stado', '$inicio');");
      mysql_query($maq);
		}
  //  print '<br />';
    $i++;
}
	
	

?>
<?php 
$badera=$_POST['bandera'];
	echo $inicio =$_POST['inicio'];
	$observaciones ="A";
//si el formulario se envio
$k=0;
if (@$badera==1)
{
    ///verificamos que lo que se envio fue un array 
    if(is_array($_POST['checkbox']))
    {
        // realizamos el ciclo
        while(list($key,$value) = each($_POST['checkbox'])) 
        {
		echo $k++; echo 'esto es k';
		echo $value; echo 'esto es value';		
    $tra2=new User();
    $dato=$tra2->get_tabla_id("id_persona",$value,"persona");
    $nombre =$dato[0]["ap_paterno"]." ".$dato[0]["ap_materno"]." ".$dato[0]["nombres"];
	$nro = $dato[0]["id_persona"];
	$unid = $dato[0]["id_unidad"];
	$tr=new User();
    $dat=$tr->get_tabla_id("id_unidad",$unid,"unidad");
	$dpto = $dat[0]["nombre_u"];
	//echo "<br>";
	$link=Conectarse();

	//:::::::::::::::::INSERTA DATOS DE MARCADO::::::::::::::::::
	

   $sqlver=mysql_query("SELECT * FROM biometrico WHERE nro = '$nro' AND fecha = '$inicio'",$link);
   if (mysql_fetch_array($sqlver) == 0) {
	
		
        $fech = strtotime($inicio);
        $d = date("N", $fech);
		if($d==7){
		echo '';
			}
		else{	 
		echo $j;
	echo $a=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$inicio','08:00:00','$observaciones','');");
      mysql_query($a);  
	  echo $b=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$inicio','12:30:00','$observaciones','');");
      mysql_query($b); 
	  echo $c=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$inicio','15:00:00','$observaciones','');");
      mysql_query($c); 
	  echo $d=("insert into biometrico values(NULL,'$dpto','$nombre','$nro','$inicio','18:30:00','$observaciones','');");
      mysql_query($d);
		}
   }
	}
	//:::::::::::::::::CIERRA INSERCION DE DATOS:::::::::::::::::

            //echo $value.'<br>';
			
        }
    }
		 echo"<script type='text/javascript'>
			alert('Asistencia registrada de $inicio a $fin');
			window.location='add_asistencia_campamentos.php';
			</script>";


//si no se ha enviado el formulario
?>


<?  include("footer.php"); ?>