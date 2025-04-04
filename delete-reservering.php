<?php
include 'reservering.php';
 
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $reservering  = new Reservering($myDb);
    $reservering->deleteReservering($id);
}
 
header("Location:view_reservering.php");
exit();
?>