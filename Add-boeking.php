<?php

include 'Data/data.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try {
        $boek= new Boek($myDb);
        $boek->addBoeking($_POST['naam'], $_POST['achternaam'], $_POST['email'], $_POST['telefoonnummer'],$_POST['aankomst'], $_POST['vertrek']);
        header("Location: boeking.php");
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
 <!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservering Toevoegen</title>
    <link rel="stylesheet" href="styles/boek2.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        .print-btn, .melding {
            display: none; /* Verberg standaard de printknop en melding */
            margin-top: 15px;
            padding: 10px 20px;
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .print-btn:hover {
            background: #1e40af;
        }
        .melding {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .melding a {
            color: #721c24;
            font-weight: bold;
        }
    </style>
</head>
<body>

 <!-- Header -->
 <div class="banner">
        <div class="navbar">
            <img src="images/logo.jpg" class="logo">

        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="klantservice.php">KLANTENSERVICE</a></li>
            <li><a href="login.php">INLOGGEN</a></li>
        </ul>
    </div>

    <main class="content">
        <div class="reservation-container">
            <h2>Hotelkamer Reserveren</h2>
            <form id="reservering-form" action="" method="POST" onsubmit="toonMelding(event)">
                <label>Naam:</label>
                <input type="text" name="naam" id="naam" placeholder="Uw naam" required>

                <label>Achternaam:</label>
                <input type="text" name="achternaam" id="achternaam" placeholder="Uw achternaam" required>

                <label>Email:</label>
                <input type="email" name="email" id="email" placeholder="Uw email" required>

                <label>Telefoonnummer:</label>
                <input type="text" name="telefoonnummer" id="telefoonnummer" placeholder="Uw telefoonnummer" required>

                <label>Aankomstdatum:</label>
                <input type="date" name="aankomst" id="aankomst" required>

                <label>Vertrekdatum:</label>
                <input type="date" name="vertrek" id="vertrek" required>

                <button type="submit" class="submit-btn">Reserveer Nu</button>
                <a href="boeking.php">Terug</a>
            </form>

            <!-- Print knop en melding -->
            <button onclick="printReservering()" id="print-btn" class="print-btn">Print Reservering</button>
            <div id="melding" class="melding">
                Reservering geplaatst! Wilt u uw reservering annuleren of wijzigen? <br>
                <a href="login.php">Log in</a> om uw reservering te beheren.
            </div>
        </div>
    </main>

    <script>
        function printReservering() {
            let naam = document.getElementById("naam").value;
            let achternaam = document.getElementById("achternaam").value;
            let email = document.getElementById("email").value;
            let telefoonnummer = document.getElementById("telefoonnummer").value;
            let aankomst = document.getElementById("aankomst").value;
            let vertrek = document.getElementById("vertrek").value;

            let printWindow = window.open('', '', 'width=600,height=600');
            printWindow.document.write('<html><head><title>Reservering</title></head><body>');
            printWindow.document.write('<h2>Reserveringsgegevens</h2>');
            printWindow.document.write('<p><strong>Naam:</strong> ' + naam + ' ' + achternaam + '</p>');
            printWindow.document.write('<p><strong>Email:</strong> ' + email + '</p>');
            printWindow.document.write('<p><strong>Telefoonnummer:</strong> ' + telefoonnummer + '</p>');
            printWindow.document.write('<p><strong>Aankomst:</strong> ' + aankomst + '</p>');
            printWindow.document.write('<p><strong>Vertrek:</strong> ' + vertrek + '</p>');
            printWindow.document.write('<button onclick="window.print()">Print</button>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
        }

        function toonMelding(event) {
            event.preventDefault(); // Voorkomt dat het formulier meteen wordt verzonden
            document.getElementById("print-btn").style.display = "block"; // Toon printknop
            document.getElementById("melding").style.display = "block"; // Toon melding
        }
    </script>

</body>
</html>
