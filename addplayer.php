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
echo '<div class="teams">';
echo '<h2> Team: ' . $team['name'] .'</h2>';

$sql = "SELECT * from users";
$query = $db->query($sql);
$users = $query->fetchAll(2);
echo '<div class="">';
foreach($users as $user){
    echo '<form action="loginController.php?id='.$team['id'].'&pid='.$user['id'].'" method="POST">';
    echo '<table class="playersadd">';
    echo '
        <tr>
            <th>'.$user['username']. '</th>
            <th><input type="hidden" name="type" value="addplayer"></th>
            <th><input class="buttonsb" type="submit" value="Voeg toe"></th>
        </tr>';
    echo '</table>';
}
echo '</div>';
echo '</div>';

require 'footer.php';

?>


