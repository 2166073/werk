<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Der Duin | Medewerker Dashboard</title>
    <link rel="stylesheet" href="styles/home2.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
   
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="images/user3.jpg" alt="Profielfoto" class="profile-img">
        <h3>Welkom, Medewerker</h3>
        <ul>
            <li><a href="home2.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="view-boekingen.php"><i class="fas fa-calendar-alt"></i> Reserveringen</a></li>
            <li><a href="help.php"><i class="fas fa-question-circle"></i> Help</a></li>
        </ul>
        <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Uitloggen</button>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h1>Dashboard</h1>
        </div>

        <div class="dashboard-container">
            <!-- Werkrooster -->
            <div class="dashboard-card">
                <h2>Werkrooster</h2>
                <ul>
                    <li><strong>15-03-2025:</strong> 10:00 - 19:00</li>
                    <li><strong>20-03-2025:</strong> 08:00 - 18:00</li>
                    <li><strong>24-03-2025:</strong> 11:00 - 20:00</li>
                    <li><strong>25-03-2025:</strong> 11:00 - 20:00</li>
                    <li><strong>26-03-2025:</strong> 11:00 - 20:00</li>
                </ul>
            </div>

            <!-- Open Taken -->
            <div class="dashboard-card">
                <h2>Open Taken</h2>
                <ul>
                    <li>Reserveringen beheren (telefonisch, online of via e-mail)</li>
                    <li>Klachten en problemen van gasten oplossen</li>
                    <li>Controleren op schade of ontbrekende items in kamers</li>
                    <li>Airco, verwarming en elektriciteit controleren</li>
                    <li class="important">Marketingstrategieën bedenken om meer gasten aan te trekken</li>
                </ul>
            </div>

            <!-- Meldingen -->
            <div class="dashboard-card">
                <h2>Meldingen</h2>
                <p>Er zijn geen nieuwe meldingen voor vandaag.</p>
            </div>
        </div>
    </div>

</body>
</html>
