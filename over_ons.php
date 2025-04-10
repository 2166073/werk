<?php
include 'db.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over Ons | DriveSmart</title>
    <link rel="stylesheet" href="css/over_ons.css">
</head>
<body>
    <div class="container">
      
        
        <section class="bedrijf">
            <h1>Bedrijfsinformatie</h1>
            <p><strong>Bedrijfsnaam:</strong> DriveSmart Rijschool</p>
            <p>DriveSmart is een rijschool die zich richt op het bieden van hoogwaardige rijopleidingen met ervaren instructeurs en moderne voertuigen. Ons doel is om leerlingen, inclusief mensen met fysieke beperkingen, veilig en zelfverzekerd de weg op te laten gaan.</p>
        </section>
        <br>
        <section class="eigenaar">
    <h2>Eigenaar</h2><br>
    <div class="eigenaar-container">
        <div class="foto-item eigenaar">
            <img src="eigenaar.jpg" alt="Cristiano Ronaldo">
            <p><strong>Cristiano Ronaldo</strong>  Eigenaar</p>
        </div>
        <div class="eigenaar-tekst">
            <p>Cristiano Ronaldo is de trotse eigenaar van DriveSmart. Met meer dan 20 jaar ervaring in de rijschoolbranche heeft hij een passie voor het opleiden van veilige en verantwoordelijke bestuurders.</p>
        </div>
    </div>
</section>
<br>
        <section class="fotos">
            <h2>instructeurs</h2>
            <br>
            <div class="foto-container">
                
                
                <div class="foto-item">
                    <img src="freddy.jpg" alt="freddy">
                    <p><strong>Freddy</strong>  Rijinstructeur</p>
                </div>
                <div class="foto-item">
                    <img src="guti.jpg" alt="Guti">
                    <p><strong>Guti</strong>  Rijinstructeur</p>
                </div>
                <div class="foto-item">
                    <img src="nadia.jpg" alt="nadia">
                    <p><strong>Nadia</strong>  Rijinstructeur</p>
                </div>
            </div>
        </section>
        
        <section class="doelstellingen">
            <h2>Onze Doelstellingen</h2>
            <p>Bij DriveSmart streven we ernaar om:</p>
            <ul>
                <li>Een hoog slagingspercentage te behalen.</li>
                <li>Leerlingen op een veilige en efficiënte manier op te leiden.</li>
                <li>Flexibele en betaalbare rijopleidingen aan te bieden.</li>
            </ul>
        </section>
    </div>
    <?php include 'footer1.php'; ?>
</body>
</html>