  
  $db->execute("
        UPDATE les 
        SET datum = ?, ophaallocatie = ?, pakket = ?, leerling_id = ?
        SET datum = ?, ophaallocatie = ?, pakket = ?, 
            instructeur_opmerking = ?,  
            leerling_id = ?
        WHERE les_id = ?
    ", [$_POST['datum'], $_POST['ophaallocatie'], $_POST['pakket'], $_POST['leerling_id'], $_POST['les_id']]);
    ", [
        $_POST['datum'],
        $_POST['ophaallocatie'],
        $_POST['pakket'],
        $_POST['instructeur_opmerking'],
        $_POST['leerling_id'],
        $_POST['les_id']
    ]);

    header('Location: lessen_bekijken.php');
    exit;

@@ -21,7 +30,7 @@ $leerlingen = $db->execute("SELECT leerling_id, naam, achternaam FROM leerling")
?>

<!DOCTYPE html>
<html lang="en">
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


@@ -49,24 +58,36 @@ $leerlingen = $db->execute("SELECT leerling_id, naam, achternaam FROM leerling")

    <main class="main-content">
        <h2>Les Bewerken</h2>

        <form action="les_bewerken.php" method="post">
            <input type="hidden" name="les_id" value="<?= $les['les_id'] ?>">
            Datum: <input type="date" name="datum" value="<?= htmlspecialchars($les['datum']) ?>" required><br>
            Ophaallocatie: <input type="text" name="ophaallocatie" value="<?= htmlspecialchars($les['ophaallocatie']) ?>" required><br>
            Pakket: <input type="text" name="pakket" value="<?= htmlspecialchars($les['pakket']) ?>" required><br>

            Leerling:
            <label>Datum:</label><br>
            <input type="date" name="datum" value="<?= htmlspecialchars($les['datum']) ?>" required><br><br>

            <label>Ophaallocatie:</label><br>
            <input type="text" name="ophaallocatie" value="<?= htmlspecialchars($les['ophaallocatie']) ?>" required><br><br>

            <label>Pakket:</label><br>
            <input type="text" name="pakket" value="<?= htmlspecialchars($les['pakket']) ?>" required><br><br>

            <label>Instructeur-opmerking:</label><br>
            <input type="text" name="instructeur_opmerking" value="<?= htmlspecialchars($les['instructeur_opmerking']) ?>"><br><br>



            <label>Leerling:</label><br>
            <select name="leerling_id" required>
                <?php foreach ($leerlingen as $leerling): ?>
                    <option value="<?= $leerling['leerling_id'] ?>" <?= $les['leerling_id'] == $leerling['leerling_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($leerling['naam'] . ' ' . $leerling['achternaam']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            </select><br><br>

            <input type="submit" value="Opslaan">
            <input type="submit" value="Opslaan" class="btn btn-primary">
        </form>
    </main>
</div>
</body>
</html>
</html>