<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){  
    if(empty($_GET['request'])){
        
    }
    else if($_GET['request'] == 'matches'){        
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
if(isset($_SESSION['id'])){
    echo "<form action='loginController.php' method='post'>
    <input type='hidden' name='type' value='logout'>
    <input class='afmeldbutton' type='submit' value='afmelden'>";

}
else{
    echo "<p class='loginenregister'>Je bent momenteel niet ingelogd <a class='buttons' href='login.php'>Login</a> of <a class='buttons' href='register.php'>Register</a></p>";
}
if (isset($_SESSION['id'])){
    echo "<p>Welkom ".ucfirst(htmlentities($_SESSION['username']))."</p>";
}
?>

<h2 id="welkom" class="welkom">Welkom bij Fifabet</h2>
<p class="hometext">wat is fifabet? Fifabet is een gemakkelijke site waar je je eigen teams en spelers kan samenstellen en daarmee aan een halve competitie mee kan doen en vervolgens met onze eigen applicatie op wedstrijden kan gokken en goud geld verdienen! (Letop! je speelt met fictief geld en alle winsten worden dus niet uitbetaald)</p>
<p>Alle teams <a class='buttons' href='teams.php'>bekijken</a><p>
<?php
if (isset($_SESSION['id'])){
    echo "je kan <a class='buttons' href='create.php'>hier</a> een team aanmaken";
}

if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == 1){
        echo '<p><a class="buttons" href="matches.php">klik</a> hier voor de competitie pagina</p>';
    }
    else {
        header('Location: index.php?error=noadmin');
        exit();
    }

}
echo '</div>';
echo '</div>';
require 'footer.php';
?>
