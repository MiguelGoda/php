    <?php
require("class/class.php");
$bus=new User();
echo $_GET["id"];
$datos=$bus->delete_var($_GET["id"],"id_unidad","unidad");
exit;
?>