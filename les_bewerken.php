<?php
include 'db.php';
$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update de les in de database
    $db->execute("
        UPDATE les 
        SET datum = ?, ophaallocatie = ?, pakket = ?, 
            instructeur_opmerking = ?,  
            leerling_id = ?
        WHERE les_id = ?
    ", [
        $_POST['datum'],
        $_POST['ophaallocatie'],
        $_POST['pakket'],
        $_POST['instructeur_opmerking'],
        $_POST['leerling_id'],
        $_POST['les_id']
    ]);

    header('Location: lessen_bekijken.php');
    exit;
}

// Haal de lesgegevens op
$les_id = $_GET['les_id'];
$les = $db->execute("SELECT * FROM les WHERE les_id = ?", [$les_id])->fetch(PDO::FETCH_ASSOC);
$leerlingen = $db->execute("SELECT leerling_id, naam, achternaam FROM leerling")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="instructeur-dashboard.css">
    <link rel="stylesheet" href="les_bewerken.css">
    <title>Les Bewerken</title>
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <h2>DriveSmart</h2>
        <nav>
            <ul>
            <li><a href="instructeur-dashboard.php">Home</a></li>
                <li><a href="#">Week rooster</a></li>
                <li><a href="dag_rooster.php">Dag rooster</a></li>
                <li><a href="les_aanmaken.php">Les aanmaken</a></li>
                <li><a href="lessen_bekijken.php">Les bewerken</a></li>
                <li><a href="view_mededeling.php">Mededeling</a></li>
                <li><a href="instructeur_ziekmelden.php">Ziekmelden</a></li>
                <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <h2>Les Bewerken</h2>

        <form action="les_bewerken.php" method="post">
            <input type="hidden" name="les_id" value="<?= $les['les_id'] ?>">

            <label>Datum:</label><br>
            <input type="date" name="datum" value="<?= htmlspecialchars($les['datum']) ?>" required><br><br>

            <label>Ophaallocatie:</label><br>
            <input type="text" name="ophaallocatie" value="<?= htmlspecialchars($les['ophaallocatie']) ?>" required><br><br>

            <label>Pakket:</label><br>
            <input type="text" name="pakket" value="<?= htmlspecialchars($les['pakket']) ?>" required><br><br>

            <label>Instructeur-opmerking:</label><br>
            <input type="text" name="instructeur_opmerking" value="<?= htmlspecialchars($les['instructeur_opmerking']) ?>"><br><br>



            <label>Leerling:</label><br>
            <select name="leerling_id" required>
                <?php foreach ($leerlingen as $leerling): ?>
                    <option value="<?= $leerling['leerling_id'] ?>" <?= $les['leerling_id'] == $leerling['leerling_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($leerling['naam'] . ' ' . $leerling['achternaam']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <input type="submit" value="Opslaan" class="btn btn-primary">
        </form>
    </main>
</div>
</body>
</html>
