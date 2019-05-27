<?php require 'header.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else{
    header('Location: index.php?error=nopermission');
    exit();
}


$sql = "SELECT * FROM matches WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$match = $prepare->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}
if (isset($_SESSION["id"])){
    echo "welkom: {$_SESSION['username']}";

}


$team1 = htmlentities($match['team1']);
$team2 = htmlentities($match['team2']);
$team1_score = htmlentities($match['team1_score']);
$team2_score = htmlentities($match['team2_score']);
?>

<div class="container">

    <form action="controller.php?id=<?=$match ['id']?>" method="post">
        <input type="hidden" name="type" value="scores">


        <input type="text" name="team1_score" id="team1_score">

        <input type="text" name="team2_score" id="team2_score">


        <button type="submit"> update </button>

    </form>

</div>
<?php require 'footer.php'; ?>