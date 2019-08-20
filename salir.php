 <?php
echo  $id=$_GET["id"];
  echo"<script type='text/javascript'>
			alert('No tiene persmisos para acceder a este contenido');
			window.location='$id';
			</script>";
?>