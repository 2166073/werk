<?php
include 'db.php';
$db = new DB();

$mededeling_id = $_GET['id'];
$db->execute("DELETE FROM mededeling WHERE mededeling_id = ?", [$mededeling_id]);

header('Location: meldingen.php');
exit;
?>