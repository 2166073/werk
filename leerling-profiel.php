<?php
session_start();
require_once '../db.php';
require_once 'leerling.php';
require_once '../navbar.php';


if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: login.php");
    exit;
}

$gebruiker_id = $_SESSION['gebruiker_id'];
$leerlingObj = new Leerling($myDb);

$leerling = $leerlingObj->getLeerlingByGebruikerId($gebruiker_id);
if (!$leerling) {
    echo "Geen leerlinggegevens gevonden.";
    exit;
}

// Optionele melding na update
$melding = '';
if (isset($_GET['success'])) {
    $melding = "Je gegevens zijn succesvol opgeslagen.";
}
if (isset($_GET['error'])) {
    $melding = " Er ging iets mis. Probeer het opnieuw.";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Leerling Profiel Bewerken</title>
    <link rel="stylesheet" href="../css/leerling-profiel.css">
</head>
<body>

<div class="dashboard-container">
    <aside class="sidebar">
        <h2>DriveSmart</h2>
        <nav>
            <ul>
            <li><a href="leerling-dashboard.php">Home</a></li>
        <li><a href="leerlingview-les.php">Les rooster</a></li>
        <li><a href="leerling-lesinplannen.php">Les inplannen</a></li>
        <li><a href="leerling-profiel.php">Profiel</a></li>
        <li><a href="view_mededelingenleerling.php">Mededeling</a></li>
        <li><a href="logout.php">Afmelden</a></li>
            </ul>
        </nav>
    </aside>

    <div class="content p-4">
        <h1>Mijn Profiel</h1>

        <?php if ($melding): ?>
            <div class="alert alert-info"><?= $melding ?></div>
        <?php endif; ?>

        <form action="update-leerling.php" method="POST">
            <div class="mb-3">
            <label for="naam" class="form-label">Naam:</label>
                <input type="text" class="form-control" id="naam" name="naam" value="<?= htmlspecialchars($leerling['naam']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="achternaam" class="form-label">Achternaam:</label>
                <input type="text" class="form-control" id="achternaam" name="achternaam" value="<?= htmlspecialchars($leerling['achternaam']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="adres" class="form-label">Adres:</label>
                <input type="text" class="form-control" id="adres" name="adres" value="<?= htmlspecialchars($leerling['adres']) ?>" required>
            </div>

            <div class="mb-3">
                 <label for="geboortedatum" class="form-label">Geboortedatum:</label>
                 <input type="date" class="form-control" id="geboortedatum" name="geboortedatum" value="<?= htmlspecialchars($leerling['geboortedatum']) ?>" required>
           </div>

            <div class="mb-3">
                <label for="telefoon" class="form-label">Telefoonnummer:</label>
                <input type="text" class="form-control" id="telefoon" name="telefoon" value="<?= htmlspecialchars($leerling['telefoon'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-primary">Wijzigingen opslaan</button>
        </form>
    </div>
</div>

</body>
</html>