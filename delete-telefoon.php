<?php
include_once('telefoon.php');
 
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    $telefoon  = new Telefoon($myDb);
    $telefoon->deleteTelefoon($ID);
}
 
header("Location:view-telefoon.php");
exit();
?>