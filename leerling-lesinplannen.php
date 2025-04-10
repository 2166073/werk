<?php
session_start();
include_once '../db.php';
include '../navbar.php';

$db = new DB("drivesmart");

// Controleer of de gebruiker is ingelogd als leerling
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

// Haal beschikbare instructeurs op
$instructeurs = $db->execute(
    "SELECT i.instructeur_id, i.naam 
     FROM instructeur i
     JOIN gebruiker g ON i.gebruiker_id = g.gebruiker_id
     WHERE g.rol = 'instructeur'"
)->fetchAll(PDO::FETCH_ASSOC);

// Haal beschikbare auto's op (niet in onderhoud)
$autos = $db->execute(
    "SELECT auto_id, merk, model, kenteken 
     FROM auto 
     WHERE onderhoud = 0"
)->fetchAll(PDO::FETCH_ASSOC);

// Verwerk het formulier voor les inplannen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['plan_les'])) {
    $instructeur_id = $_POST['instructeur_id'];
    $auto_id = $_POST['auto_id'];
    $datum = $_POST['datum'];
    $starttijd = $_POST['starttijd'];
    $eindtijd = $_POST['eindtijd'];
    $ophaallocatie = $_POST['ophaallocatie'];
    $leerling_opmerking = $_POST['leerling_opmerking'];

    // Valideer invoer
    if (empty($instructeur_id) || empty($auto_id) || empty($datum) || 
        empty($starttijd) || empty($eindtijd) || empty($ophaallocatie)) {
        $error = "Vul alle velden in.";
    } else {
        $dag_van_week = date('N', strtotime($datum)); // 1 = maandag, 7 = zondag
        if ($dag_van_week > 5 || $starttijd < '09:00' || $eindtijd > '17:00') {
            $error = "Instructeur is niet beschikbaar op dit tijdstip (buiten werktijden of in het weekend).";
        } else {
            // Controleer of auto beschikbaar is
            $auto_beschikbaar = $db->execute(
                "SELECT * FROM les 
                 WHERE auto_id = ? 
                 AND DATE(datum) = ? 
                 AND (
                     (starttijd < ? AND eindtijd > ?) OR
                     (starttijd < ? AND eindtijd > ?) OR
                     (starttijd >= ? AND eindtijd <= ?)
                 )",
                [$auto_id, $datum, $eindtijd, $starttijd, $starttijd, $eindtijd, $starttijd, $eindtijd]
            )->fetch();

            if ($auto_beschikbaar) {
                $error = "Auto is al ingepland op dit tijdstip.";
            } else {
                // Haal gekoppeld pakket op
                $pakket = $db->execute(
                    "SELECT DISTINCT pakket_id FROM les WHERE leerling_id = ? AND pakket_id IS NOT NULL LIMIT 1",
                    [$leerling_id]
                )->fetch(PDO::FETCH_ASSOC);

                if (!$pakket) {
                    $error = "Je moet eerst een pakket kiezen via je dashboard voordat je een les kunt inplannen.";
                } else {
                    $pakket_id = $pakket['pakket_id'];

                    // Voeg les toe met pakket
                    try {
                        $db->execute(
                            "INSERT INTO les 
                             (leerling_id, instructeur_id, auto_id, datum, starttijd, eindtijd, ophaallocatie, leerling_opmerking, pakket_id) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
                            [$leerling_id, $instructeur_id, $auto_id, $datum, $starttijd, $eindtijd, $ophaallocatie, $leerling_opmerking, $pakket_id]
                        );
                        $success = "Les succesvol ingepland!";
                    } catch (PDOException $e) {
                        $error = "Fout bij inplannen: " . $e->getMessage();
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Inplannen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/leerling-dashboard.css">
    <style>
        .container { max-width: 800px; margin-top: 50px; }
        .form-group { margin-bottom: 20px; }
    </style>
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
        <div class="container">
            <h2>Les Inplannen</h2>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="instructeur_id">Instructeur:</label>
                    <select class="form-control" id="instructeur_id" name="instructeur_id" required>
                        <option value="">Selecteer instructeur</option>
                        <?php foreach ($instructeurs as $instructeur): ?>
                            <option value="<?= $instructeur['instructeur_id'] ?>">
                                <?= htmlspecialchars($instructeur['naam']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="auto_id">Auto:</label>
                    <select class="form-control" id="auto_id" name="auto_id" required>
                        <option value="">Selecteer auto</option>
                        <?php foreach ($autos as $auto): ?>
                            <option value="<?= $auto['auto_id'] ?>">
                                <?= htmlspecialchars($auto['merk']) ?> <?= htmlspecialchars($auto['model']) ?> - <?= htmlspecialchars($auto['kenteken']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="datum">Datum:</label>
                    <input type="date" class="form-control" id="datum" name="datum" required min="<?= date('Y-m-d'); ?>">
                </div>
                
                <div class="form-group">
                    <label for="starttijd">Starttijd:</label>
                    <input type="time" class="form-control" id="starttijd" name="starttijd" required>
                </div>
                
                <div class="form-group">
                    <label for="eindtijd">Eindtijd:</label>
                    <input type="time" class="form-control" id="eindtijd" name="eindtijd" required>
                </div>
                
                <div class="form-group">
                    <label for="ophaallocatie">Ophaallocatie:</label>
                    <input type="text" class="form-control" id="ophaallocatie" name="ophaallocatie" required>
                </div>
                
                <div class="form-group">
                    <label for="leerling_opmerking">Opmerking:</label>
                    <textarea class="form-control" id="leerling_opmerking" name="leerling_opmerking" rows="3"></textarea>
                </div>
                
                <button type="submit" name="plan_les" class="btn btn-primary">Les Inplannen</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
