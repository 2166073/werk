<?php
include '../db.php';
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

    header('Location: dag_rooster.php');
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
    <title>Les Bewerken - DriveSmart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/instructeur-dashboard.css">
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #04AA6D;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-primary {
            background-color: #04AA6D;
            border: none;
        }
        .btn-primary:hover {
            background-color: #039f65;
        }
    </style>
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
                <li><a href="lessen_bekijken.php">Lessen bekijken</a></li>
                <li><a href="view_mededeling.php">Mededeling</a></li>
                <li><a href="instructeur_ziekmelden.php">Ziekmelden</a></li>
                <li><a href="logout.php">Uitloggen</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="container">
            <h2>Les Bewerken</h2>

            <form action="les_bewerken.php" method="post">
                <input type="hidden" name="les_id" value="<?= $les['les_id'] ?>">

                <div class="mb-3">
                    <label for="datum">Datum:</label>
                    <input type="date" id="datum" name="datum" class="form-control" value="<?= htmlspecialchars($les['datum']) ?>" required min="<?= date('Y-m-d'); ?>">
                </div>

                <div class="mb-3">
                    <label for="ophaallocatie">Ophaallocatie:</label>
                    <input type="text" id="ophaallocatie" name="ophaallocatie" class="form-control" value="<?= htmlspecialchars($les['ophaallocatie']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="pakket">Pakket:</label>
                    <input type="text" id="pakket" name="pakket" class="form-control" value="<?= htmlspecialchars($les['pakket']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="instructeur_opmerking">Instructeur-opmerking:</label>
                    <textarea id="instructeur_opmerking" name="instructeur_opmerking" class="form-control" rows="3"><?= htmlspecialchars($les['instructeur_opmerking']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="leerling_id">Leerling:</label>
                    <select id="leerling_id" name="leerling_id" class="form-select" required>
                        <?php foreach ($leerlingen as $leerling): ?>
                            <option value="<?= $leerling['leerling_id'] ?>" <?= $les['leerling_id'] == $leerling['leerling_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($leerling['naam'] . ' ' . $leerling['achternaam']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Opslaan</button>
            </form>
        </div>
    </main>
</div>
</body>
</html>
