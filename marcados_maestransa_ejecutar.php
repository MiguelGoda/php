<?php
function Conectarse(){
$host = "localhost";
$base = "db_asistencia";
$link=mysql_connect($host,"root","admin") or die("Error de conexion al servidor");
$db=mysql_select_db($base, $link) or die("Error de conexion a la BD");
return $link;
}
?>
<? include("menuadmin.php"); ?>
<?php @$badera=$_POST['bandera'];
//si el formulario se envio
if ($badera==1)
{
		$link=Conectarse();
		$campamento=$_POST["id_campamento"];
    ///verificamos que lo que se envio fue un array 
    if(is_array($_POST['checkbox']))
    {
        // realizamos el ciclo
        while(list($key,$value) = each($_POST['checkbox'])) 
        {
 $a=("update persona set id_campamento = '$campamento' where id_persona= $value");
      mysql_query($a);
            echo $a.'<br>';
			
        }
    }
	echo"<script type='text/javascript'>
			alert('Grupo Insetado Correctamente');
			window.location='insercion_manual_asistencia.php';
			</script>";
	
}
//si no se ha enviado el formulario
?>


<?  include("footer.php"); ?>