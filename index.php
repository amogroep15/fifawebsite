<?php
require 'header.php';

if(isset ($_GET['success'])) {
    if($_GET['success'] == 'register') {
        echo "<p class='message' style='color: green;'>Succesvol geregistreerd!</p>";
    }
    if($_GET['success'] == 'login') {
        echo "<p class='message' style='color: green;'>Succesvol ingelogd!</p>";
    }
    if($_GET['success'] == 'logout') {
        echo "<p class='message' style='color: green;'>Succesvol uitgelogd! </p>";
    }
}
?>

<h1>Dit is een index</h1>

<?php
require 'footer.php';
?>
