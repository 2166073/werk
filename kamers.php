<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onze Kamers | Hotel Ter Duin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .kamer-card {
            margin: 20px;
        }
    </style>
</head>
<body>

    <header class="bg-dark text-white text-center p-4">
        <h1>Hotel Ter Duin - Onze Kamers</h1>
        <nav>
            <a class="btn btn-light m-2" href="index.php">Home</a>
            <a class="btn btn-light m-2" href="contact.php">Contact</a>
            <a class="btn btn-light m-2" href="klantreservering.php">Reserveren</a>
        </nav>
    </header>

    <main class="container mt-4">
        <div class="row">

   
            <div class="col-md-4 kamer-card">
                <div class="card">
                    <img src="image/image2.jpg" class="card-img-top" alt="Standaard Kamer">
                    <div class="card-body">
                        <h5 class="card-title">Standaard Kamer</h5>
                        <p class="card-text">Comfortabele kamer met een tweepersoonsbed, badkamer, gratis WiFi en TV.</p>
                        <a href="klantreservering.php" class="btn btn-primary">Reserveer</a>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4 kamer-card">
                <div class="card">
                    <img src="image/image1.jpg" class="card-img-top" alt="Luxe Kamer">
                    <div class="card-body">
                        <h5 class="card-title">Luxe Kamer</h5>
                        <p class="card-text">Ruimere kamer met extra luxe faciliteiten zoals een minibar, bad en balkon.</p>
                        <a href="klantreservering.php" class="btn btn-primary">Reserveer</a>
                    </div>
                </div>
            </div>

           
            <div class="col-md-4 kamer-card">
                <div class="card">
                    <img src="image/image3.jpg" class="card-img-top" alt="Suite">
                    <div class="card-body">
                        <h5 class="card-title">Suite</h5>
                        <p class="card-text">Onze meest exclusieve kamer met aparte woonkamer, kingsize bed en jacuzzi.</p>
                        <a href="klantreservering.php" class="btn btn-primary">Reserveer</a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="text-center p-4 bg-dark text-white">
        &copy; 2025 Hotel Ter Duin
    </footer>

</body>
</html>
