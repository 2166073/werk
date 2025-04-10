<?php
include 'db.php';
$db = new DB();

// Controleer of de gebruiker ingelogd is en een instructeur is
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'instructeur') {
    header('Location: login.php');
    exit;
}

// Haal de lijst met auto's op
$autos = $db->execute("SELECT auto_id, merk, model FROM auto")->fetchAll(PDO::FETCH_ASSOC);

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auto_id = $_POST['auto_id'];
    $beschrijving = $_POST['beschrijving'];
    $instructeur_id = $_SESSION['rol_id'];

    if ($auto_id && $beschrijving) {
        // Voeg het mankement toe aan de database
        $db->execute(
            "INSERT INTO mankementen (auto_id, instructeur_id, beschrijving) VALUES (?, ?, ?)",
            [$auto_id, $instructeur_id, $beschrijving]
        );

        // Redirect naar een bevestigingspagina of dashboard
        header('Location: instructeur-dashboard.php?melding=succes');
        exit;
    } else {
        $error = "Alle velden zijn verplicht.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mankement Melden</title>
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
            <h2>Mankement Melden</h2>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="auto_id">Auto:</label>
                    <select name="auto_id" id="auto_id" class="form-control" required>
                        <option value="">Selecteer een auto</option>
                        <?php foreach ($autos as $auto): ?>
                            <option value="<?= $auto['auto_id'] ?>">
                                <?= htmlspecialchars($auto['merk'] . ' ' . $auto['model']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="beschrijving">Beschrijving van het mankement:</label>
                    <textarea name="beschrijving" id="beschrijving" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Mankement Melden</button>
                <a href="instructeur-dashboard.php" class="btn btn-secondary mt-3">Annuleer</a>
            </form>
        </div>
    </main>
</div>

</body>
</html>