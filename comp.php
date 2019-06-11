<?php
/**
 * Created by PhpStorm.
 * User: hfm
 * Date: 27-5-2019
 * Time: 00:14
 */

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
            <?php
            foreach ($matches as $match){
                echo "<table class='matchtable'>

                                    <tr >
                                        <td><p>{$match['team1']}</p></td>
                                        <td><h3> <a href='matchdetail.php?id={$match ['id']}'>VS </a></h3></td>
                                        <td><p>{$match['team2']}</p></td>
                                        <td><p>Hoelaat:{$match['start_timestamp']}</p></td>
                                        <td><p>Wedstrijd duur: {$match['length_match']} min</p></td>
                                        <td><p>Tussenpauze: {$match['length_rest']} min</p></td>
                                        <td><p>Grote Pauze: {$match['length_break']} min</p></td>
                                        <td><p>{$match['field_id']}</p></td>

                                    </tr>

                                  </table>";
            }
            ?> 
        </div>



</main>


<?php require 'footer.php';
?>
