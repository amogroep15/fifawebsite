<?php
require 'header.php';

if(!isset($_GET['id']) || empty($_GET['id'])){
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
    header('Location: teams.php?error=noteam');
    exit();
}

?>
<main>

<h2><?=$team['name']?></h2>

<h3>players:</h3>

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

</main>

<?

require 'footer.php';
