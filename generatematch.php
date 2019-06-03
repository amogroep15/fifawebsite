<?php require 'header.php';

$sql = "SELECT * FROM matches";
    $prepare = $db->prepare($sql);
    $prepare->execute([]);
    $result = $prepare->fetch();
    if($result != false){
        header('Location: matches.php');
        exit();
    }


?>

<form action="controller.php" method="post">
    <input type='hidden' name='type' value='create-competition'>
    <label for="start_time">Begin tijd van de wedstrijden</label>
    <input type="time" name="start_time" id="start_time">
    <label for="match_length">Wedstrijdsduur (minuten)</label>
    <input type="text" name="match_length" id="match_length">
    <label for="rest">Tussenpauze minuten</label>
    <input type="text" name="rest" id="rest">
    <label for="break">Pauze</label>
    <input type="text" name="break" id="break">
    <button type="submit">Wedstrijdschema Maken</button>
</form>


<?php require 'footer.php';?>
