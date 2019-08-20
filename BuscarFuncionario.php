  
    <?php
require_once("class/class.php");
$bus=new User();
 $datos=$bus->buscador_funcionario($_GET["q"]);

?>