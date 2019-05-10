<?php
require 'header.php';

echo '<div class="index"';
$sql = "SELECT * from teams";
$query = $db->query($sql);
$teams = $query->fetchAll(2);
echo '<h2>Teams overzicht</h2>';
foreach ($teams as $team){
    echo '<a href="detail.php?id='.$team['id'].'">Team: "'. htmlentities($team['name']). '"</a>';
    echo '</br>';
}


?>

<?php
echo '</div>';
require 'footer.php';