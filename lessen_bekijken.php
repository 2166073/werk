<?php
include 'db.php';
$db = new DB();

// Haal alle lessen op uit de database
$lessen = $db->execute("
    SELECT l.les_id, l.datum, l.ophaallocatie, l.pakket, 
           l.leerling_opmerking, l.instructeur_opmerking,
           CONCAT(le.naam, ' ', le.achternaam) AS leerling_naam
    FROM les l
    JOIN leerling le ON l.leerling_id = le.leerling_id
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="instructeur-dashboard.css">
    <link rel="stylesheet" href="lessen_bekijken.css">
    <title>Lessen Bekijken</title>
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
        <li><a href="lessen_bekijken.php">Les bewerken</a></li>
        <li><a href="mankement_melden.php">Mankement melden</a></li>
        <li><a href="kilometerstand_invoeren.php">Kilometerstand invoeren</a></li>
        <li><a href="view_mededeling.php">Mededeling</a></li>
        <li><a href="instructeur_ziekmelden.php">Ziekmelden</a></li>
        <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <h2>Aangemaakte Lessen</h2>
        <table>
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Ophaallocatie</th>
                    <th>Pakket</th>
                    <th>Leerling</th>
                    <th>leerling_opmerking</th>
                    <th>instructeur_opmerking</th>
                    <th>Acties</th>
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
                            <a href="les_bewerken.php?les_id=<?= $les['les_id'] ?>">Bewerken</a> |
                            <a href="les_verwijderen.php?les_id=<?= $les['les_id'] ?>" onclick="return confirm('Weet je zeker dat je deze les wilt verwijderen?')">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
</body>
</html>