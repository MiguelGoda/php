  
    <?php
require_once("class/class.php");
$bus=new User();
 $datos=$bus->buscador_funcionario2($_GET["q"]);

?>