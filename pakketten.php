<?php
include 'db.php';
include 'navbar.php';

$db = new DB();

// Haal alle pakketten op uit de database
$pakketten = $db->execute("SELECT * FROM pakket ORDER BY prijs ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Onze Rijlespakketten</title>
  <link rel="stylesheet" href="css/style_pakketten.css"> 
</head>
<body>

<div class="container">
  <h1>Kies het pakket dat bij jou past</h1>
  
  <div class="pakket-row">
    <?php foreach ($pakketten as $pakket): ?>
      <div class="pakket">
        <h2><?= htmlspecialchars($pakket['naam']) ?></h2>
        <p class="prijs">€<?= htmlspecialchars(number_format($pakket['prijs'], 2, ',', '.')) ?></p>
        <ul>
          <li><?= htmlspecialchars($pakket['aantal_lessen']) ?> lesuren</li>
          <li>Incl. Tussentijdse Toets</li>
          <li>Incl. Examen CBR</li>
        </ul>
        <a href="login.php" class="cta-button">PAKKET AANVRAGEN </a>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="extra-style">
    <h3>Losse Lesprijzen</h3>
    <ul>
      <li>Losse les 60 minuten: <strong>€65,-</strong></li>
      <li>Losse les 90 minuten: <strong>€97.50,-</strong></li>
      <li>Tussentijdse Toets: <strong>€200,-</strong></li>
      <li>Praktijk Examen CBR: <strong>€275,-</strong></li>
      <li>Faalangst Examen CBR: <strong>€350,-</strong></li>
      <li>Praktijk Herexamen CBR: <strong>€275,-</strong></li>
      <li>BNOR Examen (staatsexamen): <strong>€300,-</strong></li>
    </ul>
  </div>
</div>

<?php include 'footer1.php'; ?>
</body>
</html>