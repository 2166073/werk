<?php
class Auth {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function login($email, $wachtwoord) {
        // Haal gebruiker op via e-mailadres
        $sql = "SELECT * FROM gebruiker WHERE email = ?";
        $stmt = $this->db->execute($sql, [$email]);
        $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($gebruiker && password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Algemene sessiegegevens
            $_SESSION['gebruiker_id'] = $gebruiker['gebruiker_id'];
            $_SESSION['email'] = $gebruiker['email'];
            $_SESSION['rol'] = $gebruiker['rol'];

            // Bepaal welke tabel en ID op basis van de rol
            switch ($gebruiker['rol']) {
                case 'leerling':
                    $sqlRol = "SELECT leerling_id, naam FROM leerling WHERE gebruiker_id = ?";
                    $idVeld = 'leerling_id';
                    break;
                case 'instructeur':
                    $sqlRol = "SELECT instructeur_id, naam FROM instructeur WHERE gebruiker_id = ?";
                    $idVeld = 'instructeur_id';
                    break;
                case 'eigenaar':
                    $sqlRol = "SELECT eigenaar_id, naam FROM eigenaar WHERE gebruiker_id = ?";
                    $idVeld = 'eigenaar_id';
                    break;
                default:
                    return false; // onbekende rol
            }

            // Haal rol-specifieke gegevens op
            $stmtRol = $this->db->execute($sqlRol, [$gebruiker['gebruiker_id']]);
            $rolData = $stmtRol->fetch(PDO::FETCH_ASSOC);

            if ($rolData && isset($rolData[$idVeld])) {
                $_SESSION['rol_id'] = $rolData[$idVeld];   // leerling_id / instructeur_id / eigenaar_id
                $_SESSION['naam'] = $rolData['naam'];      // naam uit rol-tabel
            } else {
                // Fallbacks & logging als rol-info niet gevonden wordt
                $_SESSION['rol_id'] = null;
                $_SESSION['naam'] = 'Onbekend';

                error_log("⚠️ Login: Geen match in '{$gebruiker['rol']}'-tabel voor gebruiker_id = {$gebruiker['gebruiker_id']}");
            }

            return $gebruiker['rol'];
        }

        return false; // inlog mislukt
    }
}
