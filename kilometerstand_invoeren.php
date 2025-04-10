<?php
include 'db.php';
$db = new DB();

// Controleer of de gebruiker ingelogd is en een instructeur is
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'instructeur') {
    header('Location: login.php');
    exit;
}

// Haal de auto's op die aan de instructeur zijn gekoppeld
$autos = $db->execute("
    SELECT a.auto_id, a.merk, a.model, a.km_stand_einde_dag
    FROM auto a
    JOIN instructeur i ON a.instructeur_id = i.instructeur_id
    WHERE i.instructeur_id = ?
", [$_SESSION['rol_id']])->fetchAll(PDO::FETCH_ASSOC);

// Verwerk het formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['auto_id'], $_POST['km_stand_einde_dag'])) {
    $auto_id = $_POST['auto_id'];
    $km_stand_einde_dag = $_POST['km_stand_einde_dag'];

    try {
        // Update de kilometerstand in de database
        $db->execute("
            UPDATE auto
            SET km_stand_einde_dag = ?
            WHERE auto_id = ?
        ", [$km_stand_einde_dag, $auto_id]);

        $success = "De kilometerstand is succesvol bijgewerkt.";
    } catch (PDOException $e) {
        $error = "Fout bij het bijwerken van de kilometerstand: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kilometerstand Invoeren</title>
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
                <li><a href="lessen_bekijken.php">Les bewerken</a></li>
                <li><a href="mankement_melden.php">Mankement melden</a></li>
                <li><a href="kilometerstand_invoeren.php">Kilometerstand invoeren</a></li>
                <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="container mt-5">
            <h2>Kilometerstand Invoeren</h2>

            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="auto_id">Selecteer een auto:</label>
                    <select name="auto_id" id="auto_id" class="form-control" required>
                        <option value="">-- Kies een auto --</option>
                        <?php foreach ($autos as $auto): ?>
                            <option value="<?= $auto['auto_id'] ?>">
                                <?= htmlspecialchars($auto['merk'] . ' ' . $auto['model'] . ' (Huidige km-stand: ' . $auto['km_stand_einde_dag'] . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="km_stand_einde_dag">Nieuwe kilometerstand:</label>
                    <input type="number" name="km_stand_einde_dag" id="km_stand_einde_dag" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Bijwerken</button>
            </form>
        </div>
    </main>
</div>

</body>
</html>