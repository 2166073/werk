<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructeur Overzicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
include 'instructeur.php';
include_once 'db.php';

$instructeur = new Instructeur($myDb);
$resultaat = $instructeur->selectAllInstructeurs();

echo "<h1>Instructeur Overzicht</h1>";
echo "<table>";
echo "<tr>
        <th>Instructeur ID</th>
        <th>Gebruiker ID</th>
        <th>Naam</th>
        <th>Telefoonnummer</th>
        <th>Beschikbaarheid</th>
        <th>Opmerking</th>

        <th>Acties</th>
      </tr>";

foreach ($resultaat as $row) {
    echo "<tr>";
    echo "<td>" . $row['instructeur_id'] . "</td>";
    echo "<td>" . $row['gebruiker_id'] . "</td>";
    echo "<td>" . $row['naam'] . "</td>";
    echo "<td>" . $row['telefoonnummer'] . "</td>";
    echo "<td>" . $row['beschikbaarheid'] . "</td>";
    echo "<td>" . $row['opmerking'] . "</td>";

    echo "<td>
            <a href='edit_instructeur.php?instructeur_id=" . $row['instructeur_id'] . "'>edit</a> | 
            <a href='delete-instructeur.php?instructeur_id=" . $row['instructeur_id'] . "'>delete</a>
          </td>";
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>
