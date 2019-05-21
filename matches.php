<?php
/**
 * Created by PhpStorm.
 * User: hfm
 * Date: 20-5-2019
 * Time: 09:45
 */
require 'header.php';
if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == 1){

    }
    else {
        header('Location: index.php?error=noadmin');
        exit();
    }

}

$sql = "SELECT * from teams";
$query = $db->query($sql);
$teams = $query->fetchAll(2);
shuffle($teams);

echo '<div class="matchespage">';

echo '<form action="loginController.php?id=<?=$id?>" method="POST">
       <input type="hidden" name="type" value="competition">
       <input type="submit" class="mbutton" value="klik hier om een halve competitie te maken">
       </form>';

echo '<div class="marginm" >';

$teamsArray = array();
//$compititionArry = array();

foreach ($teams as $team) {
    array_push($teamsArray, $team['name']);
}

$arrLength = count($teamsArray);
$count = 1;

echo '<table class="matches">';
echo '<tr>
<th>wedstrijd nummer</th>
<th>Thuis Team</th>
<th></th>
<th>Uit Team</th>
<th>Speeltijd</th>
</tr>';
for ($i = 0; $i < $arrLength; $i++) {
    for ($j = 0; $j < count($teamsArray); $j++) {
        if ($teamsArray[0] !== $teamsArray[$j]) {
            echo "<tr>
                <th>$count</th>
                <td class='td1'>$teamsArray[0]</td>
                <th>VS</th>
                <td class='td2'>$teamsArray[$j]</td>
                </tr>";
            $count++;
        }
    }
    array_shift($teamsArray);
}

//if(isset ($_GET['success'])) {
//    if($_GET['success'] == 'started') {
//        echo "<script> alert('Competitie succesvol aangemaakt!')</script>";
//    }
//}

echo '</table>';
echo '</div>';
echo '</div>';

?>




<?php
require 'footer.php';
?>
