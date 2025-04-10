<?php
include 'db.php';
session_start();

// Beveiliging: alleen ingelogde instructeurs mogen hier komen
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'instructeur') {
    header('Location: login.php');
    exit;
}



// Instructeurgegevens uit sessie
$instructeur_naam = $_SESSION['naam'] ?? 'Instructeur';
$instructeur_id = $_SESSION['rol_id'] ?? null;'
s'
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>DriveSmart | Instructeur Dashboard</title>
  <link rel="stylesheet" href="instructeur-dashboard.css">
</head>
<body>

<div class="dashboard-container">
  <aside class="sidebar">
    <h2>DriveSmart</h2>
    <nav>
      <ul>
        <li><a href="instructeur-dashboard.php">Home</a></li>
        <li><a href="week_rooster.php">Week rooster</a></li>
        <li><a href="dag_rooster.php">Dag rooster</a></li>
        <li><a href="les_aanmaken.php">Les aanmaken</a></li>
        <li><a href="mankement_melden.php">Mankement melden</a></li>
        <li><a href="kilometerstand_invoeren.php">Kilometerstand invoeren</a></li>
        <li><a href="view_mededeling.php">Mededeling</a></li>
        <li><a href="instructeur_ziekmelden.php">Ziekmelden</a></li>
        <li><a href="logout.php">Uitloggen</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <h1>Welkom, <?= htmlspecialchars($instructeur_naam) ?>!</h1>
    <p>Je ID is: <?= htmlspecialchars($instructeur_id) ?></p>
    <p>Kies een optie uit het menu om aan de slag te gaan.</p>
    <section>
        <h2>Mededelingen</h2>
        <?php
        // Haal mededelingen op
        $mededelingen = $myDb->execute("
            SELECT inhoud, datum 
            FROM mededeling 
            WHERE gebruiker_id IS NULL OR gebruiker_id = ?
            ORDER BY datum DESC
        ", [$instructeur_id])->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php if (!empty($mededelingen)): ?>
            <ul>
                <?php foreach ($mededelingen as $mededeling): ?>
                    <li>
                        <?= htmlspecialchars($mededeling['inhoud']) ?> 
                        <em>(<?= htmlspecialchars($mededeling['datum']) ?>)</em>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Er zijn momenteel geen mededelingen.</p>
        <?php endif; ?>
    </section>
  </main>
</div>

</body>
</html>

