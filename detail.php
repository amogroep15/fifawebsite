<?php
require 'header.php';

if(!isset($_GET['id']) || empty($_GET['id'])){
    echo "<script> alert('ID niet gevonden!')</script>";
    header('location: teams.php?error=noid');
    exit();
}
$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id'     => $_GET['id']
]);
$team = $prepare->fetch();

if(empty($team)){
    echo "<script> alert('Deze Team bestaat niet meer!')</script>";
    header('Location: teams.php?error=noteam');
    exit();
}

?>
<main class="index">

<h2><?=$team['name']?></h2>

<div class="teamplayerlist">
<h3>Spelers:</h3>

<?php
if(!empty($team['players'])){
    $players = explode(':',$team['players']);
    foreach($players as $player){
    $sql = "SELECT * FROM users WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id'     => $player
    ]);
    $playername = $prepare->fetch();
        if(isset($playername['username'])){
            echo '<p>'. htmlentities($playername['username']). '</p>';
        }
    }
}
?>
</div>
</main>

<?php

require 'footer.php';
