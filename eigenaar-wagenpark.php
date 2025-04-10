<?php
session_start();
include 'db.php';
include 'navbar.php';

// Controleer of de gebruiker is ingelogd als eigenaar
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'eigenaar') {
    header('Location: login.php');
    exit;
}

$db = new DB();

// Haal alle auto's op
$autos = $db->execute("
    SELECT a.*, i.naam as instructeur_naam 
    FROM auto a 
    LEFT JOIN instructeur i ON a.instructeur_id = i.instructeur_id
    ORDER BY a.merk, a.model
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wagenpark - DriveSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Wagenpark Overzicht</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Beheer alle voertuigen</h4>
            <a href="eigenaar-auto-toevoegen.php" class="btn btn-primary">Nieuwe Auto Toevoegen</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kenteken</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Instructeur</th>
                        <th>Status</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($autos as $auto): ?>
                        <tr>
                            <td><?= htmlspecialchars($auto['kenteken']) ?></td>
                            <td><?= htmlspecialchars($auto['merk']) ?></td>
                            <td><?= htmlspecialchars($auto['model']) ?></td>
                            <td><?= htmlspecialchars($auto['instructeur_naam'] ?? 'Niet toegewezen') ?></td>
                            <td>
                                <?php if ($auto['onderhoud']): ?>
                                    <span class="badge bg-warning">In onderhoud</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Beschikbaar</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($auto['onderhoud']): ?>
                                    <a href="eigenaar-auto-onderhoud-klaar.php?auto_id=<?= $auto['auto_id'] ?>" 
                                       class="btn btn-sm btn-success">Onderhoud Klaar</a>
                                <?php else: ?>
                                    <a href="eigenaar-auto-onderhoud.php?auto_id=<?= $auto['auto_id'] ?>" 
                                       class="btn btn-sm btn-warning">In Onderhoud</a>
                                <?php endif; ?>
                                <a href="eigenaar-auto-verwijderen.php?auto_id=<?= $auto['auto_id'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Weet je zeker dat je deze auto wilt verwijderen?')">Verwijderen</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>