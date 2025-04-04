
<?php
include 'Data/data.php'; 
$boek = new Boek($myDb);

$data = $boek->selectAllBoeking();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Ter Duin</title>
    <link rel="stylesheet" href="styles/view-boek.css">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap"rel="stylesheet"><link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head> 
<body>
    <!-- Header -->
    <div class="banner">
        <div class="navbar">
            <img src="images/logo.jpg" class="logo">

        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="klantservice.php">KLANTENSERVICE</a></li>
            <li><a href="onzeservice.php">ONZE SERVICE</a></li>
            <li><a href="login.php">INLOGGEN</a></li>
        </ul>
    </div>


    <div class="container">
        <h1>boeking overzicht</h1>
        <?php if (isset($deleteMessage)): ?>
            <p><?php echo $deleteMessage; ?></p>
        <?php endif; ?>
        <table>
            <tr>
                <th>ID</th>
                <th>naam</th>
                <th>achternaam</th>
                <th>email</th>
                <th>telefoonnummer</th>
                <th>aankomst</th>
                <th>vertrek</th>
                <th>Actie</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo $row['naam']; ?></td>
                            <td><?php echo $row['achternaam']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['telefoonnummer']; ?></td>
                            <td><?php echo $row['aankomst']; ?></td>
                            <td><?php echo $row['vertrek']; ?></td>
                            <td class="action-links">
                        <a href="edit-boeking.php?id=<?php echo $row['ID']; ?>">Edit</a>
                        <form method="POST">
                        <a href="delete-boeking.php?id=<?php echo $row['ID']; ?>">Delete</a>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="add-boeking.php">Nieuwe boeking toevoegen</a>
    </div>
</body>
</html>