<?php
// mededeling.php
class Mededeling {
    // Functie om mededelingen op te halen
    public function get_mededelingen($gebruiker_id) {
        // Hardcoded mededelingen (id, inhoud, tekst, gebruiker_id)
        $alle_mededelingen = [
            ['id' => 1, 'inhoud' => 'Welkom!', 'tekst' => 'Welkom op het leerplatform.', 'gebruiker_id' => 1],
            ['id' => 2, 'inhoud' => 'Opdracht inleveren', 'tekst' => 'Vergeet je opdracht voor vrijdag niet in te leveren.', 'gebruiker_id' => 2],
            ['id' => 3, 'inhoud' => 'Lesplanning', 'tekst' => 'Vergeet je lesplanning voor deze week in te vullen.', 'gebruiker_id' => 3],
            ['id' => 4, 'inhoud' => 'Systeemonderhoud', 'tekst' => 'Het systeem wordt zondag geüpdatet.', 'gebruiker_id' => 4],
            ['id' => 5, 'inhoud' => 'Algemene mededeling', 'tekst' => 'Algemene informatie voor iedereen.', 'gebruiker_id' => 5],
        ];

        return $alle_mededelingen; // Retourneer alle mededelingen
    }
}
?>
