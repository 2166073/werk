<?php
include 'db.php';
$db = new DB();

// Controleer of de gebruiker ingelogd is en een instructeur is
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'instructeur') {
    header('Location: login.php');
    exit;
}

// Haal de huidige datum op in het juiste formaat (YYYY-MM-DD)
$huidige_datum = date("Y-m-d");

// Haal de lessen van de instructeur op voor de huidige dag
$lessen = $db->execute("
    SELECT l.les_id, l.datum, l.ophaallocatie, l.pakket,
           l.leerling_opmerking, l.instructeur_opmerking,
           CONCAT(le.naam, ' ', le.achternaam) AS leerling_naam
    FROM les l
    JOIN leerling le ON l.leerling_id = le.leerling_id
    WHERE DATE(l.datum) = ? AND l.instructeur_id = ?
    ORDER BY l.datum ASC
", [$huidige_datum, $_SESSION['rol_id']])->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dag Rooster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container mt-5">
        <h2>Rooster voor vandaag (<?= date("d-m-Y") ?>)</h2>
        <?php if (count($lessen) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Ophaallocatie</th>
                        <th>Pakket</th>
                        <th>Leerling</th>
                        <th>Leerling Opmerking</th>
                        <th>Instructeur Opmerking</th>
                        <th>Acties</th> <!-- Nieuwe kolom voor acties -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lessen as $les): ?>
                        <tr>
                            <td><?= htmlspecialchars($les['datum']) ?></td>
                            <td><?= htmlspecialchars($les['ophaallocatie']) ?></td>
                            <td><?= htmlspecialchars($les['pakket']) ?></td>
                            <td><?= htmlspecialchars($les['leerling_naam']) ?></td>
                            <td><?= htmlspecialchars($les['leerling_opmerking']) ?></td>
                            <td><?= htmlspecialchars($les['instructeur_opmerking']) ?></td>
                            <td>
                                <a href="les_bewerken.php?les_id=<?= $les['les_id'] ?>" class="btn btn-warning btn-sm">Bewerken</a>
                                <a href="les_verwijderen.php?les_id=<?= $les['les_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze les wilt verwijderen?')">Verwijderen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Er zijn geen lessen voor vandaag.</p>
        <?php endif; ?>

        <a href="instructeur-dashboard.php" class="btn btn-secondary mt-4">Terug naar Dashboard</a>
    </div>
</main>
</div>

</body>
</html>