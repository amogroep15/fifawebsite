<?php
require 'header.php';
if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == 1){

    }
    else {
        header('Location: index.php?error=noadmin');
        exit();
    }

}
else {
    header('Location: index.php?error=noadmin');
    exit();
}

$sql = "SELECT * from teams";
$query = $db->query($sql);
$teams = $query->fetchAll(2);
foreach ($teams as $team){
    echo '<p>Team: "'. htmlentities($team['name']). '"</p>';
    echo '<form action="loginController.php?id='.$team['id'].'" method="POST">';
    echo '<input type="hidden" name="type" value="delete">';
    echo '<input type="submit" value="Verwijder team">';
    echo '</form>';
    echo ' <a href="edit.php?id='.$team['id'].'">wijzig team</a>';
}

?>
<style>
body {
    background: none;
}
</style>


<?php
require 'footer.php';