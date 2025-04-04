<?php
session_start();
// Veronderstel dat je de klant-ID opslaat in de sessie
$ID = $_SESSION['ID']; // Zorg ervoor dat de gebruiker ingelogd is

// Verbind met de database
include 'Data/data.php'; // Zorg ervoor dat je DB-verbinding goed is opgezet

// Haal de reserveringen van de klant op
$query = "SELECT * FROM boeking WHERE ID = ?";
$stmt = $myDb->prepare($query);
$stmt->bind_param('i', $ID);
$stmt->execute();
$result = $stmt->get_result();

// Als er geen boekingen zijn
if ($result->num_rows == 0) {
    $noBookings = true;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Dashboard - Hotel Der Duin</title>
    <link rel="stylesheet" href="styles/klant.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>



<!-- Navigatiebalk -->
<div class="navbar">
    <img src="images/logo.jpg" class="logo" alt="Hotel Der Duin">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="account.php">Mijn Account</a></li>
        <li><a href="logout.php">Uitloggen</a></li>
    </ul>
</div>

<main>
    <div class="dashboard-container">
        <h2>Welkom bij je account, <?php echo $_SESSION['username']; ?>!</h2>

        <?php if (isset($noBookings) && $noBookings): ?>
            <p class="no-bookings-message">Je hebt momenteel geen reserveringen.</p>
        <?php else: ?>
            <h3>Jouw reserveringen:</h3>
            <div class="bookings-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="booking-card">
                        <h4>Reservering: <?php echo $row['kamer']; ?></h4>
                        <p><strong>Aankomst:</strong> <?php echo $row['aankomst']; ?></p>
                        <p><strong>Vertrek:</strong> <?php echo $row['vertrek']; ?></p>
                        <p><strong>Status:</strong> <?php echo $row['status']; ?></p>

                        <div class="booking-actions">
                            <a href="edit-boeking.php?id=<?php echo $row['id']; ?>" class="edit-btn">Bewerken</a>
                            <a href="cancel-boeking.php?id=<?php echo $row['id']; ?>" class="cancel-btn">Annuleren</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
