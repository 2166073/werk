<?php
// Zorg ervoor dat je de juiste bestand voor de databaseverbinding en klasse importeert.
include_once('les.php');
include_once('db.php'); // Je moet je eigen DB-verbinding bestand hebben.

if (isset($_GET["les_id"])) {
    // Verkrijg de ID en de reden uit het formulier
    $les_id = $_GET["les_id"];
    $reden = $_POST["reden"];


    // Controleer of de reden niet leeg is
    if (empty($reden)) {
        echo "Je moet een reden opgeven voor het verwijderen van de les.";
    } else {
        // Maak een nieuw object van de Les klasse
        $les = new Les($myDb);

        $les_data = $les->getLesbyID($les_id);

        if ($les_data){

            $stmt = $myDb->prepare("INSERT INTO verwijderde_les (les_id, reden) VALUES(?,?) ");
            $stmt->execute([$les_id, $reden]);
        }

        // Verwijder de les met de opgegeven ID en reden
        $Les->deleteLes($les_id);
        
        // Redirect naar de pagina met de lijst van lessen (bijvoorbeeld view-les.php)
        header("Location:view_les.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 800px; margin-top: 50px; }
        .form-group { margin-bottom: 20px; }
    </style>
</head>
<body>

    <h2>Les Verwijderen</h2>
    
    <!-- Zorg ervoor dat je de juiste ID naar het formulier doorgeeft -->
    <form action="verwijder_les.php?les_id=<?php echo $_GET['les_id']; ?>" method="post">
        
        <label for="reden">Reden voor verwijderen:</label>
        <textarea name="reden" id="reden" rows="4" required></textarea>
        
        <button type="submit">Verwijderen</button>
    </form>

</body>
</html>
