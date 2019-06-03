<?php
/**
 * Created by PhpStorm.
 * User: hfm
 * Date: 27-5-2019
 * Time: 00:02
 */
require 'config.php';



if ($_POST['type'] == 'create-competition') {

    $querydel = $db->query("TRUNCATE TABLE matches"); // reset database matches
    $querydel = $db->query("TRUNCATE TABLE match_requirements");
    

    $start_time =  $_POST['start_time'];
    $match_length = trim($_POST['match_length']);
    $rest = trim($_POST['rest']);
    $break = trim($_POST['break']);

    $sql = "INSERT INTO match_requirements (start_time, match_length, rest, break) VALUES (:start_time, :match_length, :rest, :break)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        'start_time'     => $start_time,
        'match_length'   => $match_length,
        'rest'           => $rest,
        'break'          => $break
    ]);




    //

    $teamsql = "SELECT * FROM teams";
    $query = $db->query($teamsql); //verzoek naar de database, voer sql van hierboven uit
    $teams = $query->fetchAll(PDO::FETCH_ASSOC); //multie demensionale array //alles binnenhalen


    $fieldssql = "SELECT * FROM fields";
    $query = $db->query($fieldssql);
    $fields = $query->fetchall(PDO::FETCH_ASSOC);

    $timesql = "SELECT *FROM match_requirements";
    $query = $db->query($timesql);
    $match_requirements = $query->fetchall(PDO::FETCH_ASSOC);


    foreach ($match_requirements as $match_requirement) {

        $yourdatetime = $match_requirement['start_time'];       /*Pakt de tijd uit de data base in een 'time' format*/
        $minutes = $match_requirement['match_length'] + $match_requirement['rest'] + $match_requirement['break'];   /*Hier bereken ik de aantal minuten
        tot de andere wedstrijd (aantal minuten van de wedstrijd tussenpauze en pauze*/
        $length_match = $match_requirement['match_length'];
        $length_rest  = $match_requirement['rest'];
        $length_break = $match_requirement['break'];
//      

        $timestamp = $yourdatetime + $minutes * 60;

    }
    $fieldcount = count($fields);

    for ($i = 0; $i < $fieldcount; $i++){
        $allfields[$i] = $fields[$i]['fieldname'];
    }

    $teamsArray = array();

    $match_number = 0;

    $field_counter = 0;



    foreach ($teams as $team) {
        array_push($teamsArray, $team['name']);
    }

    $arrLength = count($teamsArray);

    for ($i = 0; $i < $arrLength; $i++) {
        for ($x = ($i + 1), $r = -1; $x < $arrLength; $x++) {
            if ($teamsArray[$i] === $teamsArray[$x]) {

            } else {
                if ($fieldcount -1 <= $r){
                    $r = 0;
                }
                else{
                    $r ++;
                }
                $currentfield = $allfields[$r];
                

                $sql = "INSERT INTO matches (team1, team2, start_timestamp, length_match, length_rest, length_break ,field_id)
                        values(:team1, :team2, :start_timestamp, :length_match, :length_rest, :length_break ,:field_id)";
                $prepare = $db->prepare($sql);
                $prepare->execute([
                    ':team1' => $teamsArray[$i],
                    ':team2' => $teamsArray[$x],
                    ':start_timestamp' => date('H:i:s', $start_time),
                    ':length_match' => $length_match,
                    ':length_rest' => $length_rest,
                    ':length_break' => $length_break,
                    ':field_id' => $currentfield
                ]);

                $start_time = strtotime("+$minutes minutes", strtotime($yourdatetime));
                
            }
        }
    }

    header("Location: matches.php");
    exit;
}

/*DELETE FIELD FUNCTION*/
if ($_POST['type'] === 'delete_field'){
    $id = $_GET['id'];

    $sql = " DELETE from fields WHERE id = :id";
    $prepare =  $db->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);


    $message = "Veld is succesvol verwijderd";
    header("location: fields.php");
    exit;
}



/*RESET FIELDS DATABASE ID AI TO 1*/

if ( $_POST['type'] === 'reset_fields'){


    $sql = "TRUNCATE TABLE fields";
    $prepare =  $db->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);

    header("location: fields.php");
    exit;
}
if ($_POST['type'] === 'addfield'){

    $fieldname = htmlentities(trim($_POST['fieldname']));


    
    $sql = "INSERT INTO fields (fieldname) VALUES (:fieldname)";

    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':fieldname'     => $fieldname

    ]);


    header("location: fields.php?success=fields");
    exit;
}
if ($_POST['type'] === 'scores') {

    $id = $_GET['id'];

    $team1_score = $_POST['team1_score'];
    $team2_score = $_POST['team2_score'];


    $sql = "UPDATE matches SET team1_score= :team1_score, team2_score= :team2_score WHERE id= :id";

    $prepare = $db->prepare($sql);
    $prepare->execute([

        'team1_score' => $team1_score,
        'team2_score' => $team2_score,

        ':id' => $id

    ]);

    header("location: matches.php");
    exit;

}
if ($_POST['type']== 'set_time'){

    $sqlreset = "TRUNCATE TABLE match_requirements";
    $querydel = $db->query($sqlreset); //verzoek naar de database, voer sql van hierboven uit


    $start_time =  $_POST['start_time'];

    $match_length = htmlentities(trim($_POST['match_length']));
    $rest = htmlentities(trim($_POST['rest']));
    $break = htmlentities(trim($_POST['break']));



    $sql = "INSERT INTO match_requirements (start_time, match_length, rest, break) VALUES (:start_time, :match_length, :rest, :break)";

    $prepare = $db->prepare($sql);
    $prepare->execute([
        'start_time'     => $start_time,
        'match_length'   => $match_length,
        'rest'           => $rest,
        'break'          => $break

    ]);


    header("location: generatematch.php");
    exit;
}
?>