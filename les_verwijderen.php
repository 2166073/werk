<?php
include '../db.php';
$db = new DB();

$les_id = $_GET['les_id'];
$db->execute("DELETE FROM les WHERE les_id = ?", [$les_id]);

header('Location: dag_rooster.php');
exit;
?>