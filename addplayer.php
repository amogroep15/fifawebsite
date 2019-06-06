<?php
require 'header.php';
if(isset($_SESSION['id'])){

}
else {
    echo "<script> alert('U bent niet ingelogt!')</script>";
    header('Location: index.php?error=nologin');
    exit();
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
} 
else{
    header('Location: teams.php');
    exit;
}
$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id'     => $id
]);
$team = $prepare->fetch();
if(!$team){
    header('Location: teams.php');
    exit;
}

echo '<h1> Team: ' . $team['name'] .'</h1>';

$sql = "SELECT * from users";
$query = $db->query($sql);
$users = $query->fetchAll(2);

foreach($users as $user){
    echo '<form action="loginController.php?id='.$team['id'].'&pid='.$user['id'].'" method="POST">';
    echo '<p>'.$user['username']. '</p>';
    echo '<input type="hidden" name="type" value="addplayer">';
    echo '<input class="buttons" type="submit" value="Voeg toe">';;

}
