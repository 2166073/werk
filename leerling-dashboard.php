<?php
session_start();
require_once '../db.php';
require_once 'leerling.php';
include '../navbar.php';

// Controleer of een leerling is ingelogd
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'leerling' || !isset($_SESSION['rol_id'])) {
    header('Location: login.php');
    exit;
}

$db = new DB("drivesmart");
$leerling_id = $_SESSION['rol_id'];
$leerling_naam = $_SESSION['naam'] ?? 'Leerling';

$leerling = new Leerling($db);

// Koppelen aan pakket en instructeur via les
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pakket_id'], $_POST['instructeur_id'])) {
    try {
        $leerling->planEersteLesMetPakket($leerling_id, $_POST['pakket_id'], $_POST['instructeur_id']);
        header("Location: leerling-dashboard.php?success=1");
        exit;
    } catch (Exception $e) {
        $error = "Fout bij koppelen: " . $e->getMessage();
    }
}

// Controleer of leerling al gekoppeld is
$koppeling = $leerling->checkPakketStatus($leerling_id);
$resterend = $koppeling ? $leerling->getResterendeLessen($leerling_id) : null;

// Mededelingen ophalen
$mededelingen = $db->execute("
    SELECT inhoud, datum 
    FROM mededeling 
    WHERE gebruiker_id IS NULL OR gebruiker_id = ?
    ORDER BY datum DESC
", [$leerling_id])->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>DriveSmart | Leerling Dashboard</title>
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
        <li><a href="../logout.php">Afmelden</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <h1>Welkom, <?= htmlspecialchars($leerling_naam) ?>!</h1>
    <p>Je leerlingnummer is: <strong><?= htmlspecialchars($leerling_id) ?></strong></p>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color: green;">Je bent succesvol gekoppeld aan een pakket!</p>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- Pakketstatus -->
    <section class="pakket-box">
        <?php if ($koppeling): ?>
            <p>Je bent gekoppeld aan een pakket.</p>
            <p>Je hebt nog <strong><?= $resterend ?></strong> lessen te gaan.</p>
        <?php else: ?>
            <h3>Kies een pakket en instructeur</h3>
            <form method="POST">
                <label>Pakket:</label><br>
                <select name="pakket_id" required>
                    <?php foreach ($leerling->getBeschikbarePakketten() as $pakket): ?>
                        <option value="<?= $pakket['pakket_id'] ?>">
                            <?= htmlspecialchars($pakket['naam']) ?> (<?= $pakket['aantal_lessen'] ?> lessen)
                        </option>
                    <?php endforeach; ?>
                </select><br><br>

                <label>Instructeur:</label><br>
                <select name="instructeur_id" required>
                    <?php foreach ($leerling->getInstructeurs() as $inst): ?>
                        <option value="<?= $inst['instructeur_id'] ?>">
                            <?= htmlspecialchars($inst['naam']) ?>
                        </option>
                    <?php endforeach; ?>
                </select><br><br>

                <button type="submit">Koppel pakket</button>
            </form>
        <?php endif; ?>
    </section>

    <!-- Mededelingen -->
    <section>
        <h2>Mededelingen</h2>
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
