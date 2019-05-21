<?php
require 'header.php';
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

if(isset($_SESSION['id'])){
    if(isset($_SESSION['admin'])){
        
    }
    else if($_SESSION['id'] == $team['creator']) {

    }
    else {
        header('Location: index.php?error=noadmin');
        exit();
    }

}
else {
    header('Location: index.php?error=nopermission');
    exit();
}


if($team == 0){
    header('Location: admin.php?error=noteam');
    exit();
}


?>
<div class="teamedit">
    <h2>Team Edit</h2>
    <div class="editpage">
    <div class="editteam">
        <form action="loginController.php?id=<?=$id?>" method="POST">
            <input type="hidden" name="type" value="edit">
            <div>
                <p class="bold">Team naam:</p><input type="text" name="name" value="<?=$team['name']?>">
            </div>
            <div>
                <input style="margin: 4px" class="buttonsb" type="button" value="wijzig team naam">
                <input style="margin: 4px" id="save" class="buttonsb" type="submit" value="wijzigingen opslaan">
            </div>
        </form>
    </div>
<div class="removeplayer">

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
            echo '<p class="bold">Players:</p>';
            echo '<p>'. ucfirst(htmlentities($playername['username'])). '</p>';
            echo '<input class="buttonsr"  type="submit" value="verwijder speler">';
            echo '</form>';
        }
    }
}
?>
</div>
</div>
</div>


<?php
require 'footer.php';