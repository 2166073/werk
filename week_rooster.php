<?php

include '../db.php';

$db = new DB();
 
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'leerling') {

    header('Location: login.php');

    exit;

}
 
$gebruiker_id = $_SESSION['gebruiker_id'] ?? null;
 
$leerling = $db->execute(

    "SELECT leerling_id FROM leerling WHERE gebruiker_id = ?",

    [$gebruiker_id]

)->fetch(PDO::FETCH_ASSOC);
 
if (!$leerling) {

    die("Leerling niet gevonden.");

}
 
$leerling_id = $leerling['leerling_id'];

$vandaag = date("Y-m-d");
 
// DEBUG: Toon alles voor controle

// $debugData = $db->execute("SELECT * FROM les WHERE leerling_id = ?", [$leerling_id])->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>"; print_r($debugData); echo "</pre>";
 
$lessen = $db->execute("

    SELECT l.les_id, l.datum, l.starttijd, l.eindtijd, l.ophaallocatie,

           l.leerling_opmerking, l.instructeur_opmerking, l.pakket_id,

           CONCAT(a.merk, ' ', a.model, ' - ', a.kenteken) AS auto,

           i.naam AS instructeur_naam

    FROM les l

    JOIN instructeur i ON l.instructeur_id = i.instructeur_id

    JOIN auto a ON l.auto_id = a.auto_id

    WHERE DATE(l.datum) = ? AND l.leerling_id = ?

    ORDER BY l.starttijd ASC

", [$vandaag, $leerling_id])->fetchAll(PDO::FETCH_ASSOC);

?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Lesrooster Vandaag</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
<h2>Mijn lessen van vandaag (<?= date("d-m-Y") ?>)</h2>
 
            <?php if (!empty($lessen)): ?>
<table class="table table-bordered">
<thead class="table-dark">
<tr>
<th>Tijd</th>
<th>Ophaallocatie</th>
<th>Auto</th>
<th>Instructeur</th>
<th>Pakket ID</th>
<th>Mijn Opmerking</th>
<th>Opmerking Instructeur</th>
<th>Actie</th>
</tr>
</thead>
<tbody>
<?php foreach ($lessen as $les): ?>
<tr>
<td><?= htmlspecialchars($les['starttijd']) ?> - <?= htmlspecialchars($les['eindtijd']) ?></td>
<td><?= htmlspecialchars($les['ophaallocatie']) ?></td>
<td><?= htmlspecialchars($les['auto']) ?></td>
<td><?= htmlspecialchars($les['instructeur_naam']) ?></td>
<td><?= htmlspecialchars($les['pakket_id']) ?></td>
<td><?= !empty($les['leerling_opmerking']) ? nl2br(htmlspecialchars($les['leerling_opmerking'])) : '<i>Geen</i>' ?></td>
<td><?= !empty($les['instructeur_opmerking']) ? nl2br(htmlspecialchars($les['instructeur_opmerking'])) : '<i>Geen</i>' ?></td>
<td>
<a href="leerling-opmerking.php?les_id=<?= $les['les_id'] ?>" class="btn btn-sm btn-warning mb-1">Bewerken</a>
<a href="verwijder_les.php?les_id=<?= $les['les_id'] ?>" class="btn btn-sm btn-danger">Verwijderen</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
 
                <button class="btn btn-primary" onclick="window.print()">Print Dagrooster</button>
<?php else: ?>
<div class="alert alert-info">Je hebt vandaag geen lessen ingepland.</div>
<?php endif; ?>
</div>
</main>
</div>
 
</body>
</html>

 