<?php require 'header.php';

$id = $_GET['id'];

$sql = "SELECT * FROM matches WHERE id = :id";
$prepare = $pdo->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$match = $prepare->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]=== true){
    $sql = "SELECT * FROM users WHERE id = :id ";
    $prepare = $pdo->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION["id"]
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);


}
else{
    header("location: index.php");
}

if (isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]=== true){
    $sql = "SELECT * FROM users WHERE id = :id";
    $prepare = $pdo->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION['id']
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);
    echo "welkom: {$user['username']}";
}


$team1 = htmlentities($match['team1']);
$team2 = htmlentities($match['team2']);
$team1_score = htmlentities($match['team1_score']);
$team2_score = htmlentities($match['team2_score']);
?>


<div class="container">

    <p>Team 1:&nbsp;<?=$team1?></p>
    <p>Team 2:&nbsp;<?=$team2?></p>

    <p>scores: <?=$team1_score?> - <?=$team2_score?></p>

    <?php if ($user ['admin'] == 1 ){


        echo "<a class='edit-link' href='scores.php?id=$id'>Scores invullen.</a>";
    }?>

</div>