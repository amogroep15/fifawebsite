<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){  
    if(empty($_GET['request'])){
        
    }
    else if($_GET['request'] == 'matches'){        
        if(isset($_GET['key'])){
            $key = $_GET['key'];
            if($key == 'A7PD1NSIIWls9WAD14'){
                require 'config.php';
                header('Content-Type: application/json');           
                    $sql = "SELECT * FROM teams";
                    $prepare = $db->prepare($sql);
                    $prepare->execute([]);
                    $teams = $prepare->fetchAll(2);
                    echo json_encode($teams);
                    exit;
            }        
        }         
    } 
}
require 'header.php';

echo "<div class='index'>";
echo "<div class='indextext'>";

if(isset ($_GET['success'])) {
    if($_GET['success'] == 'register') {
        echo "<script> alert('succesvol geregisteerd!')</script>";
    }
    if($_GET['success'] == 'login') {
        echo "<script> alert('succesvol ingelogt!')</script>";
    }
    if($_GET['success'] == 'logout') {
        echo "<script> alert('succesvol uitgelogt!')</script>";
    }
}
if(isset ($_GET['error'])) {
    if ($_GET['error'] == 'noentry') {
        echo "<script> alert('Geen Toegang')</script>";
    }
}
if (isset($_SESSION['id'])){
    echo "<p class='username'>Welkom ".ucfirst(htmlentities($_SESSION['username']))."</p>";
}
?>

<h2 id="welkom" class="welkom">Welkom bij Fifabet</h2>
<p class="hometext">wat is Fifabet? Fifabet is een gemakkelijke site waar je je eigen teams en spelers kan samenstellen en daarmee aan een halve competitie mee kan doen en vervolgens met onze eigen applicatie op wedstrijden kan gokken en goud geld verdienen! (Letop! je speelt met fictief geld en alle winsten worden dus niet uitbetaald)</p>
<?php


echo '</div>';
echo '</div>';
require 'footer.php';
?>
