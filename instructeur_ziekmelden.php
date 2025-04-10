<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziekmelden</title>
    <link rel="stylesheet" href="instructeur-dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="container mt-5">
            <h2>Ziekmelden</h2>

            <p>Vul hieronder de reden in waarom je je ziek wilt melden.</p>

            <form method="POST">
                <div class="form-group">
                    <label for="reden">Reden voor ziekmelding:</label>
                    <textarea name="reden" id="reden" class="form-control" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-danger mt-3">Ziekmelden</button>
                <a href="instructeur-dashboard.php" class="btn btn-secondary mt-3">Annuleer</a>
            </form>
        </div>
    </main>
</div>

</body>
</html>