<?php
include 'db.php'; 
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveSmart | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="hero">
        <div class="hero-content">
            <h1>DriveSmart Rijschool</h1>
            <p>De slimste keuze voor jouw rijopleiding!</p>
            <a href="login.php" class="cta-button">Log hier in </a>
        </div>
    </div>

    <div class="container">
        <section class="promo-section">
            <div class="promo-box">
                <h2>Je Rijbewijs Snel En Voordelig Halen In Pure Luxe 🚘</h2>
                <p class="luxury-text">In stijl, pure luxe en comfort lessen in een gloednieuwe Mercedes en in één keer je rijbewijs halen.</p>
                <div class="benefits">
                    <p>✅ GÉÉN wachttijden, start direct.</p>
                    <p>✅ Hoog slagingspercentage van 78%.</p>
                    <p>✅ Betaalgemak. Mogelijk om in termijnen te betalen.</p>
                </div>
                <a href="pakketten.php" class="cta-button">Pakketten Zien </a>
            </div>
        </section>

        <section class="features">
            <div class="row">
                <div class="col-md-4 feature-box">
                    <div class="feature-icon">🎯</div>
                    <h3>Expert Instructeurs</h3>
                    <p>Onze ervaren instructeurs begeleiden je naar succes met persoonlijke aandacht.</p>
                </div>
                <div class="col-md-4 feature-box">
                    <div class="feature-icon">🚗</div>
                    <h3>Luxe Autos</h3>
                    <p>Rij in stijl en comfort in onze nieuwe Mercedes lesauto's.</p>
                </div>
                <div class="col-md-4 feature-box">
                    <div class="feature-icon">📅</div>
                    <h3>Flexibele Planning</h3>
                    <p>Plan je lessen wanneer het jou uitkomt, ook in het weekend.</p>
                </div>
            </div>
        </section>

        <section class="why-us">
            <h2>Waarom DriveSmart?</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-box">
                        <h3>Hoog Slagingspercentage</h3>
                        <p>Met ons slagingspercentage van 78% ligt je slagingskans ver boven het landelijk gemiddelde.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box">
                        <h3>Betaalbare Pakketten</h3>
                        <p>Kies uit verschillende pakketten die passen bij jouw budget en leertempo.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include 'footer1.php'; ?>
</body>
</html>