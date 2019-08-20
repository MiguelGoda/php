  
    <?php
require_once("class/class.php");
$bus=new User();
 $datos=$bus->buscador_personal_user($_GET["q"]);

?>