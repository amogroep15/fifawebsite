<?php
require 'header.php';
if(isset($_SESSION['id'])){

}
else {
    echo "<script> alert('U bent niet ingelogt!')</script>";
    header('Location: index.php?error=nologin');
    exit();
}
if(isset ($_GET['success'])) {
    if($_GET['success'] == 'delete') {
        echo "<script> alert('succesvol team verwijderd!')</script>";
    }
}
echo '<div class="teams">';
echo '<h2>Teams overzicht</h2>';
echo '<div class="teamslist">';
$sql = "SELECT * from teams";
$query = $db->query($sql);
$teams = $query->fetchAll(2);


foreach ($teams as $team){
    echo '<a class="teamname" href="detail.php?id='.$team['id'].'">'. htmlentities($team['name']). '</a>';
    echo '<form action="loginController.php?id='.$team['id'].'" method="POST">';
    echo '<input type="hidden" name="type" value="join">';
    echo '<input class="buttons" type="submit" value="Join team">';
    echo '</form>';
    if(isset($_SESSION['admin'])){
        echo '<form action="loginController.php?id='.$team['id'].'" method="POST">';
        echo '<input type="hidden" name="type" value="delete">';
        echo '<input class="buttonsr" type="submit" value="Verwijder team">';
        echo '</form>';
        
        echo '<a  class="buttonsb" href="edit.php?id='.$team['id'].'">wijzig team</a>';
    }

}

echo '</div>';
echo '<h2>Mijn teams</h2>';
echo '<div class="myteams">';
if(isset( $_SESSION['id'])){
    $creator = $_SESSION['id'];
    $sql = "SELECT * from teams WHERE creator = '$creator'";
    $query = $db->query($sql);
    $teams = $query->fetchAll(2);


    foreach($teams as $team){
        echo '<a class="teamname" href="detail.php?id='.$team['id'].'">'. htmlentities($team['name']). '</a>';
        if(isset($_SESSION['admin'])){
        echo '<form action="loginController.php?id='.$team['id'].'" method="POST">';
        echo '<input type="hidden" name="type" value="delete">';
        echo '<input class="buttonsr" type="submit" value="Verwijder team">';
        echo '</form>';
        }
        echo '<a class="buttonsb" href="edit.php?id='.$team['id'].'">wijzig team</a>';
}
};

echo '</div>';
echo '</div>';
require 'footer.php';
?>

<?php
