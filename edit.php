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

<form action="loginController.php?id=<?=$id?>" method="POST">
        <input type="hidden" name="type" value="edit">
        <p>Team naam*</p><input type="text" name="name" value="<?=$team['name']?>">
        <p>Speler 1*</p><input type="text" name="p1" value="<?=$team['player1']?>">
        <p>Speler 2*</p><input type="text" name="p2" value="<?=$team['player2']?>">
        <p>Speler 3*</p><input type="text" name="p3" value="<?=$team['player3']?>">
        <p>Speler 4</p><input type="text" name="p4" value="<?php if(isset($team['player4'])){echo$team['player4'];}?>">
        <p>Speler 5</p><input type="text" name="p5" value="<?php if(isset($team['player5'])){echo$team['player5'];}?>">
        <p>Speler 6</p><input type="text" name="p6" value="<?php if(isset($team['player6'])){echo$team['player6'];}?>">
        <p>Speler 7</p><input type="text" name="p7" value="<?php if(isset($team['player7'])){echo$team['player7'];}?>">
        <p>Speler 8</p><input type="text" name="p8" value="<?php if(isset($team['player8'])){echo$team['player8'];}?>">
        <p>Speler 9</p><input type="text" name="p9" value="<?php if(isset($team['player9'])){echo$team['player9'];}?>">
        <p>Speler 10</p><input type="text" name="p10" value="<?php if(isset($team['player10'])){echo$team['player10'];}?>">
        <p>Speler 11</p><input type="text" name="p11" value="<?php if(isset($team['player11'])){echo$team['player11'];}?>">
        <p>Speler 12</p><input type="text" name="p12" value="<?php if(isset($team['player12'])){echo$team['player12'];}?>">
        <p>Speler 13</p><input type="text" name="p13" value="<?php if(isset($team['player13'])){echo$team['player13'];}?>">
        <p>Speler 14</p><input type="text" name="p14" value="<?php if(isset($team['player14'])){echo$team['player14'];}?>">
        <p>Speler 15</p><input type="text" name="p15" value="<?php if(isset($team['player15'])){echo$team['player15'];}?>">
        <p>Speler 16</p><input type="text" name="p16" value="<?php if(isset($team['player16'])){echo$team['player16'];}?>">
        <input type="submit">
    </form>

<?php
require 'footer.php';