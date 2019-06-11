<?php
require 'header.php';
$sql = "SELECT * FROM teams"; //gewoon een opslag van een string die je later gaat gebruiken
$query = $db->query($sql); //verzoek naar de database, voer sql van hierboven uit
$teams = $query->fetchAll(PDO::FETCH_ASSOC); //multie demensionale array //alles binnenhalen

$sql = "SELECT * FROM matches";
$query = $db->query($sql); //verzoek naar de database, voer sql van hierboven uit
$matches = $query->fetchAll(PDO::FETCH_ASSOC);



if(!isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
}

if (!isset($_SESSION['id'])) {
    die("I'm sorry, this page is locked, admins only <a href='login.php'>Login</a> first.");
}

?>
<main>
        <div class="container">
            <table class='matchestable'>
            <tr>
                <th>Wie</th>
                <th>Wedstrijd duur</th>
                <th>Tussenpauze</th>
                <th>Pauze</th>
                <th>Veld</th>
            </tr>
            <?php
            foreach ($matches as $match){
                echo "
                                    <tr>
                                        <td>{$match['team1']} <a href='matchdetail.php?id={$match ['id']}'>VS </a>{$match['team2']}</td>
                                        <td>{$match['length_match']} min</td>
                                        <td>{$match['length_rest']} min</td>
                                        <td{$match['length_break']} min</td>
                                        <td>{$match['field_id']}</td>
                                    </tr>";
            }
            ?>
            </table>
        </div>



</main>


<?php require 'footer.php';
?>


