  
    <?php
require_once("class/class.php");
$bus=new User();
 $datos=$bus->buscador_funcionario_campamento($_GET["q"]);

?>