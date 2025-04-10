<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
include_once('leerling.php');
include_once 'db.php';



// if (isset($_GET["les_id"])) {
    // $les_id = $_GET["les_id"];
    
// }

if (!isset($_SESSION['gebruiker_id']) || $_SESSION['rol'] !== 'leerling') {
        header("Location: leerlingmededelingen.php");
        exit;
}

$mededelingen = $leerling->haalAlleMededelingenOp();
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