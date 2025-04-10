<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
session_start();
include_once('instructeur.php');
include_once 'db.php';



// if (isset($_GET["les_id"])) {
    // $les_id = $_GET["les_id"];
    
// }

if (!isset($_SESSION['gebruiker_id']) || $_SESSION['rol'] !== 'instructeur') {
        header("Location: intructeurmededelingen.php");
        exit;
}


$instructeur = new $Instructeur($dbh);
$mededelingen = $instructeur->haalAlleMededelingenOp();
?>
<h2> mededelingen van andere leerlingen</2>
<?php
foreach ($mededelingen as $mededeling): ?>
<div style="border:1px solid #ccc; padding:10px; mrgin-bottom:10px;">
    <strong><?= htmlspeacialchars($mededeling['naam'])?></strong> schreef op <?= $mededeling['datum']?>
</div>
<?php endforeach?>

</body>
</html>