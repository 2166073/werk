<?php
session_start();
session_destroy(); // Vernietigt de sessie
header("Location: login.php"); // Stuur de gebruiker terug naar de loginpagina
exit();
?>
