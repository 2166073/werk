<?php
session_start();
include '../db.php';
include '../navbar.php';

$db = new DB("drivesmart");

// Controleer of de gebruiker ingelogd is
if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: login.php");
    exit();
}

// Haal leerling_id op
$leerling = $db->execute(
    "SELECT leerling_id FROM leerling WHERE gebruiker_id = ?",
    [$_SESSION['gebruiker_id']]
)->fetch(PDO::FETCH_ASSOC);

if (!$leerling) {
    die("Leerling niet gevonden.");
}
$leerling_id = $leerling['leerling_id'];

// Haal geplande lessen op
$lessen = $db->execute("
    SELECT l.*, 
           i.naam AS instructeur_naam, 
           a.merk, a.model, a.kenteken
    FROM les l
    JOIN instructeur i ON l.instructeur_id = i.instructeur_id
    JOIN auto a ON l.auto_id = a.auto_id
    WHERE l.leerling_id = ?
    ORDER BY l.datum DESC, l.starttijd ASC
", [$leerling_id])->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Mijn Geplande Lessen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/leerling-dashboard.css">
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <h2>DriveSmart</h2>
        <nav>
            <ul>
                <li><a href="leerling-dashboard.php">Home</a></li>
                <li><a href="leerling_viewles.php">Les rooster</a></li>
                <li><a href="leerling-lesinplannen.php">Les inplannen</a></li>
                <li><a href="leerling-profiel.php">Profiel</a></li>
                <li><a href="view_mededelingenleerling.php">Mededeling</a></li>
                <li><a href="logout.php">Afmelden</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="container mt-5">
            <h2>Mijn Geplande Lessen</h2>
            <?php if (count($lessen) > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Tijd</th>
                            <th>Instructeur</th>
                            <th>Auto</th>
                            <th>Ophaallocatie</th>
                            <th>Pakket</th>
                            <th>Opmerking (jij)</th>
                            <th>Opmerking (instructeur)</th>
                            <th>Actie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lessen as $les): ?>
                            <tr>
                                <td><?= date('d-m-Y', strtotime($les['datum'])) ?></td>
                                <td><?= htmlspecialchars($les['starttijd']) ?> - <?= htmlspecialchars($les['eindtijd']) ?></td>
                                <td><?= htmlspecialchars($les['instructeur_naam']) ?></td>
                                <td><?= htmlspecialchars($les['merk'] . ' ' . $les['model']) ?> (<?= htmlspecialchars($les['kenteken']) ?>)</td>
                                <td><?= htmlspecialchars($les['ophaallocatie']) ?></td>
                                <td><?= htmlspecialchars($les['pakket']) ?></td>
                                <td><?= htmlspecialchars($les['leerling_opmerking']) ?></td>
                                <td><?= htmlspecialchars($les['instructeur_opmerking']) ?></td>
                                <td>
<a href="leerling-opmerking.php?les_id=<?= $les['les_id'] ?>" class="btn btn-sm btn-warning mb-1">Bewerken</a>
<a href="verwijder_les.php?les_id=<?= $les['les_id'] ?>" class="btn btn-sm btn-danger">Verwijderen</a>
</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Je hebt nog geen lessen ingepland.</p>
            <?php endif; ?>
        </div>
    </main>
</div>
</body>
</html>
