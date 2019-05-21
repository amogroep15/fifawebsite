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
if(empty($_GET['id'])){
    header('Location: index.php?error=wrongpage');
}
$id = $_GET['id'];

$sql = "SELECT * FROM teams WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id'  => $id
]);
$team = $prepare->fetch();


if($team == 0){
    header('Location: admin.php?error=noteam');
    exit();
}


?>
<form class="teamedit" action="loginController.php?id=<?=$id?>" method="POST">
        <input type="hidden" name="type" value="edit">
        <div>
            <p>Team naam*</p><input type="text" name="name" value="<?=$team['name']?>">
        </div>

        <div>
            <input type="submit">
        </div>
</form>
<div>

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
            echo '<form action="loginController.php?id='.$player.'&teamid='.$team['id'].'" method="POST">';
            echo '<input type="hidden" name="type" value="deleteplayer">';
            echo '<p>'. htmlentities($playername['username']). '</p>';
            echo '<input type="submit" value"verwijder speler">';
            echo '</form>';
        }
    }
}
?>
</div>


<?php
require 'footer.php';