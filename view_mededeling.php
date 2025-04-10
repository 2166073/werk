<?php
session_start();
require_once 'db.php';

// Check of gebruiker is ingelogd en de juiste rol heeft
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'instructeur' || !isset($_SESSION['rol_id'])) {
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
        SELECT gebruiker_id FROM gebruiker WHERE rol = 'instructeur'
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
    <title>Laatste Mededeling voor Instructeurs</title>
    <link rel="stylesheet" href="instructeur-dashboard.css">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <h2>DriveSmart</h2>
        <nav>
            <ul>
            <li><a href="instructeur-dashboard.php">Home</a></li>
        <li><a href="#">Week rooster</a></li>
        <li><a href="dag_rooster.php">Dag rooster</a></li>
        <li><a href="les_aanmaken.php">Les aanmaken</a></li>
        <li><a href="lessen_bekijken.php">Les bewerken</a></li>
        <li><a href="view_mededeling.php">Mededeling</a></li>
        <li><a href="instructeur_ziekmelden.php">Ziekmelden</a></li>
        <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <h2 class="mb-4">Laatste Mededeling voor Instructeurs</h2>

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
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">Er zijn momenteel geen mededelingen voor instructeurs.</div>
        <?php endif; ?>

        <a href="instructeur-dashboard.php" class="btn btn-secondary mt-4">Terug naar dashboard</a>
    </main>
</div>

</body>
</html>