<?php
// Zorg ervoor dat je de juiste bestand voor de databaseverbinding en klasse importeert.
include_once('les.php');
include_once('myDb.php'); // Je moet je eigen DB-verbinding bestand hebben.

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ID"])) {
    // Verkrijg de ID en de reden uit het formulier
    $ID = $_POST["ID"];
    $reden = $_POST["reden"];

    // Controleer of de reden niet leeg is
    if (empty($reden)) {
        echo "Je moet een reden opgeven voor het verwijderen van de les.";
    } else {
        // Maak een nieuw object van de Les klasse
        $les = new Les($myDb);

        // Verwijder de les met de opgegeven ID en reden
        $les->deleteLes($ID, $reden);
        
        // Redirect naar de pagina met de lijst van lessen (bijvoorbeeld view-les.php)
        header("Location:view-les.php");
        exit();
    }
} else {
    // Als geen ID is opgegeven, geef dan een foutmelding.
    echo "Geen les-ID opgegeven.";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Les Verwijderen</title>
</head>
<body>

    <h2>Les Verwijderen</h2>
    
    <!-- Zorg ervoor dat je de juiste ID naar het formulier doorgeeft -->
    <form action="les_verwijderen.php" method="post">
        <label for="ID">Les ID:</label>
        <input type="text" name="ID" id="ID" required>
        
        <label for="reden">Reden voor verwijderen:</label>
        <textarea name="reden" id="reden" rows="4" required></textarea>
        
        <button type="submit">Verwijderen</button>
    </form>

</body>
</html>


//ALTER TABLE verwijderde_lessen
ADD COLUMN reden TEXT NOT NULL;

