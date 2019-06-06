<?php
require 'header.php';
if(isset($_SESSION['admin'])){

}
else{
    header('Location: index.php?error=nopermission');
    exit();
}

$sql = "SELECT * FROM tokens";
$prepare = $db->prepare($sql);
$prepare->execute([]);
$tokens = $prepare->fetchAll(2);
foreach($tokens as $token){
    echo $token['token'];
    echo '<form action="loginController.php?id='.trim($token['id']).'" method="POST">';
    echo '<input type="hidden" name="type" value="deletekey">';
    echo '<div>';
    echo '<input class="buttons1" value="Verwijder key" type="submit">';
    echo '</div>';
    echo '</form>';
}



?>

<form action="loginController.php" method="POST">
    <input type="hidden" name="type" value="key">
    <div>
        <input class="buttons1" value="Nieuwe key" type="submit">
    </div>
</form>


    
