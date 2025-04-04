<?php
include 'Data/data.php';
 
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    $boek  = new Boek($myDb);
    $boek->deleteBoeking($ID);
}
 
header("Location:view-boekingen.php");
exit();
?>