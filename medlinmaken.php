<?php

require_once 'db.php';
 
$pdo = $myDb->getConnection();
 
$stmt = $pdo->prepare("

    SELECT reden, datum

    FROM mededeling  

    ORDER BY mededeling_id DESC

");

$stmt->execute();
 
$mededelingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Alle Mededelingen voor Instructeurs</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
<div class="container mt-5">
<h2 class="mb-4">Mededelingen voor Instructeurs</h2>
 
    <?php if (!empty($mededelingen)): ?>
<div class="list-group">
<?php foreach ($mededelingen as $mededeling): ?>
<div class="list-group-item mb-3 shadow-sm">
<h5 class="mb-1">Mededeling</h5>
<p class="mb-2"><?= htmlspecialchars($mededeling['reden']) ?></p>
<p class="text-muted mb-0">
<small>Gepubliceerd op: <?= htmlspecialchars($mededeling['datum']) ?></small>
</p>
</div>
<?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert alert-info">Er zijn momenteel geen mededelingen voor instructeurs.</div>
<?php endif; ?>
 
    <a href="medlinmaken.php" class="btn btn-secondary mt-4">Terug naar dashboard</a>
</div>
 
</body>
</html>

 