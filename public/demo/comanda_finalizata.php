<?php
session_start();
require_once('includes/header.php');

echo '<div class="container mt-5">';
echo '<h2>Comanda ta a fost plasată cu succes!</h2>';
echo '<p>Îți mulțumim pentru achiziție! Detaliile comenzii tale au fost trimise la procesare.</p>';
echo '<a href="index.php" class="btn btn-custom">Înapoi la magazin</a>';
echo '</div>';

require_once('includes/footer.php');
?>

