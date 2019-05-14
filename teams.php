<?php
require 'header.php';
if(isset($_SESSION)){

}
else {
    header('Location: index.php?error=nologin');
    exit();
}
echo '<div class="teams">';
$sql = "SELECT * from teams";
$query = $db->query($sql);
$teams = $query->fetchAll(2);
echo '<h1>Teams overzicht</h1>';
foreach ($teams as $team){
    echo '<a href="detail.php?id='.$team['id'].'">Team: "'. htmlentities($team['name']). '"</a>';
    echo '</br>';
    if(isset($_SESSION['admin'])){
        echo '<form action="loginController.php?id='.$team['id'].'" method="POST">';
        echo '<input type="hidden" name="type" value="delete">';
        echo '<input type="submit" value="Verwijder team">';
        echo '</form>';
        echo '<a href="edit.php?id='.$team['id'].'">wijzig team</a>';
    }
    
}
if(isset( $_SESSION['id'])){
    $creator = $_SESSION['id'];
    $sql = "SELECT * from teams WHERE creator = '$creator'";
    $query = $db->query($sql);
    $teams = $query->fetchAll(2);
    echo '<h2>Mijn teams</h2>';
    foreach($teams as $team){
        echo '<a href="detail.php?id='.$team['id'].'">Team: "'. htmlentities($team['name']). '"</a>';
        if(isset($_SESSION['admin'])){
        echo '<form action="loginController.php?id='.$team['id'].'" method="POST">';
        echo '<input type="hidden" name="type" value="delete">';
        echo '<input type="submit" value="Verwijder team">';
        echo '</form>';
        }
        echo '<a href="edit.php?id='.$team['id'].'">wijzig team</a>';
        echo '</br>';
}
};


?>

<?php
echo '</div>';
require 'footer.php';