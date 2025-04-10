<?php
session_start();
require_once 'db.php';

// Check of gebruiker is ingelogd en de juiste rol heeft
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'leerling' || !isset($_SESSION['rol_id'])) {
    header('Location: login.php');
    exit;
}

// Maak verbinding via getConnection()
$db = new DB();
$pdo = $db->getConnection();

// Haal de laatste mededeling op voor instructeurs
$stmt = $pdo->prepare("
    SELECT inhoud, datum 
    FROM mededeling 
    WHERE gebruiker_id IS NULL OR gebruiker_id IN (
        SELECT gebruiker_id FROM gebruiker WHERE rol = 'leerling'
    )
    ORDER BY mededeling_id DESC 
    
");
$stmt->execute();

$mededelingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Laatste Mededeling voor leerlingen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Laatste Mededeling voor leerlingen</h2>

    <?php if ($mededelingen): ?>
     <div class="list-group">
     <?php foreach ($mededelingen as $mededeling): ?>
            <div class="list-group-item mb-3 shadow-sm">
                <h5 class="mb-1">Mededeling</h5>
                <p class="mb-2"><?= htmlspecialchars($mededeling['inhoud']) ?></p>
                <p class="text-muted mb-0">
                    <small>Gepubliceerd op: <?= htmlspecialchars($mededeling['datum']) ?></small>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">Er zijn momenteel geen mededelingen voor leerlingen.</div>
    <?php endif; ?>

    <a href="leerling-dashboard.php" class="btn btn-secondary mt-4">Terug naar dashboard</a>
</div>

</body>
</html>
