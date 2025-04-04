
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/boek.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap"rel="stylesheet"><link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
   <!-- Header -->
   <div class="banner">
        <div class="navbar">
            <img src="images/logo.jpg" class="logo">

        <ul>
            <li><a href="homepage.php">HOME</a></li>
            <li><a href="klantenservice.php">KLANTENSERVICE</a></li>
            <li><a href="login.php">INLOGGEN</a></li>
        </ul>
    </div>


<div class="hotel-container">
    <!-- Deluxe Suite -->
    <div class="hotel-card" data-room="Deluxe Suite">
        <div class="image-slider">
            <img src="images/kamer1.jpg" class="active" alt="Deluxe Suite">
            <img src="images/badkamer3.jpg" alt="Deluxe Suite">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Deluxe Suite</h3>
        <p>🛏️ 2 Bedden | 🚿 Badkamer | 📶 Gratis WiFi | ❄️ Airco | 📺 TV</p>
        <p>🍽️ Ontbijt inbegrepen</p>
        <p class="price">💰 €120 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
        </div>

    <!-- Standaard Kamer -->
    <div class="hotel-card".data-room="Standaard Kamer">
        <div class="image-slider">
            <img src="images/kamer7.jpg" class="active" alt="Standaard Kamer">
            <img src="images/badkamer4.jpg" alt="Standaard Kamer">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Standaard Kamer</h3>
        <p>🛏️ 1 Bed | 🚿 Badkamer | 📶 Gratis WiFi | 🔥 Verwarming | 📺 TV</p>
        <p>❌ Geen ontbijt inbegrepen</p>
        <p class="price">💰 €80 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
        </div>

    <!-- Familiekamer -->
    <div class="hotel-card" data-room="Familiekamer">
        <div class="image-slider">
            <img src="images/kamer3.jpg" class="active" alt="Familiekamer">
            <img src="images/kamer5.jpg" alt="Familiekamer">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Familiekamer</h3>
        <p>🛏️ 3 Bedden | 🚿 Badkamer | 📶 Gratis WiFi | ❄️ Airco | 📺 TV</p>
        <p>🍽️ Ontbijt inbegrepen</p>
        <p class="price">💰 €150 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
        </div>

    <!-- Budget Kamer -->
    <div class="hotel-card" data-room="Budget Kamer">
        <div class="image-slider">
            <img src="images/kamer4.jpg" class="active" alt="Budget Kamer">
            <img src="images/kamer7.jpg" alt="Budget Kamer">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Budget Kamer</h3>
        <p>🛏️ 1 Bed | 🚿 Badkamer | 📶 Gratis WiFi | ❄️ Airco | 📺 TV</p>
        <p>❌ Geen ontbijt inbegrepen</p>
        <p class="price">💰 €60 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
        </div>

    <!-- Premium Suite -->
     <div class="hotel-card" data-room="Premium Suite">
    
        <div class="image-slider">
            <img src="images/kamer8.jpg" class="active" alt="Premium Suite">
            <img src="images/badkamer2.jpg" alt="Premium Suite">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Premium Suite</h3>
        <p>🛏️ 1 Groot Bed | 🚿 Luxe Badkamer | 📶 Gratis WiFi | ❄️ Airco | 📺 TV</p>
        <p>🍽️ Luxe Ontbijt inbegrepen</p>
        <p class="price">💰 €180 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
    </div>

    <!-- Penthouse -->
    <div class="hotel-card" data-room="Penthouse">
        <div class="image-slider">
            <img src="images/kamer2.jpg" class="active" alt="Penthouse">
            <img src="images/badkamer4.jpg" alt="Penthouse">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Penthouse</h3>
        <p>🛏️ King-size Bed | 🚿 Jacuzzi | 📶 Gratis WiFi | ❄️ Airco | 📺 TV</p>
        <p>🍽️ Luxe Ontbijt & Diner inbegrepen</p>
        <p class="price">💰 €300 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
    </div>

    <!-- Romantische Suite -->
    <div class="hotel-card" data-room="Romantische Suite">
        <div class="image-slider">
            <img src="images/hotel7.jpg" class="active" alt="Romantische Suite">
            <img src="images/hotel10.jpg" alt="Romantische Suite">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Romantische Suite</h3>
        <p>🛏️ Groot Bed | 🚿 Luxe Badkamer | 📶 Gratis WiFi | 💖 Romantische Decoratie</p>
        <p>🍽️ Champagne & Ontbijt inbegrepen</p>
        <p class="price">💰 €170 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
    </div>

    <!-- Comfort Kamer -->
    <div class="hotel-card" data-room="Comfort Kamer">
        <div class="image-slider">
            <img src="images/hotel6.jpg" class="active" alt="Comfort Kamer">
            <img src="images/badkamer7.jpg" alt="Comfort Kamer">
            <button class="prev">←</button>
            <button class="next">→</button>
        </div>
        <h3>Comfort Kamer</h3>
        <p>🛏️ 2 Comfortabele Bedden | 🚿 Badkamer | 📶 Gratis WiFi | ❄️ Airco | 📺 TV</p>
        <p>🍽️ Ontbijt inbegrepen</p>
        <p class="price">💰 €90 per nacht</p>
        <div class="reservation-message hidden">✅ Deze kamer is gereserveerd!</div>
        <a href="Add-boeking.php" class="reserve-btn">Reserveer Nu</a>
    </div>
</div>

    

<script>document.addEventListener("DOMContentLoaded", function () {
    // Selecteer alle reserveer-knoppen en voeg event listener toe
    document.querySelectorAll(".reserve-btn").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Voorkomt dat de link direct volgt

            let roomCard = button.closest(".hotel-card");
            if (!roomCard) {
                console.error("Kan de hotelkamer niet vinden!");
                return;
            }

            let roomName = roomCard.getAttribute("data-room");
            if (!roomName) {
                console.error("RoomName ontbreekt in data-room attribuut!");
                return;
            }

            console.log("Reservering toegevoegd voor kamer:", roomName);
            localStorage.setItem(roomName, 'reserved');

            // Redirect naar de reserveringspagina
            window.location.href = "Add-boeking.php";
        });
    });

    // Controleer gereserveerde kamers bij laden van de pagina
    document.querySelectorAll('.hotel-card').forEach(card => {
        let roomName = card.getAttribute('data-room');
        
        if (roomName && localStorage.getItem(roomName) === 'reserved') {
            console.log(`Kamer ${roomName} is al gereserveerd.`);
            
            let reserveBtn = card.querySelector('.reserve-btn');
            let reservationMessage = card.querySelector('.reservation-message');

            if (reservationMessage) {
                reservationMessage.classList.remove('hidden');
            }
            if (reserveBtn) {
                reserveBtn.textContent = "IS AL GERESERVEERD";
                reserveBtn.disabled = true;
            }
        }
    });
});



document.addEventListener("DOMContentLoaded", function () {
    function checkAvailableRooms() {
        let totalRooms = document.querySelectorAll(".hotel-card").length;
        let reservedRooms = 0;

        document.querySelectorAll(".hotel-card").forEach(card => {
            let roomName = card.getAttribute("data-room");
            if (localStorage.getItem(roomName) === "reserved") {
                reservedRooms++;
            }
        });

        let availableRooms = totalRooms - reservedRooms;
        console.log(`Beschikbare kamers: ${availableRooms}`);

        if (availableRooms === 2) {
            showWarningMessage("⚠️ Nog maar 6 hotelkamers beschikbaar! Boek snel!");
        }
    }

    function showWarningMessage(message) {
        let warningDiv = document.createElement("div");
        warningDiv.classList.add("warning-message");
        warningDiv.innerHTML = message;
        document.body.prepend(warningDiv);
    }

    checkAvailableRooms();
});
</script>

</script>



</body>
</html>