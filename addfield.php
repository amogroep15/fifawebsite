<?php require 'header.php';

if (!isset($_SESSION['id'])) {
    die("I'm sorry, this page is locked, admins only <a href='login.php'>Login</a> first.");
}
if (isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]=== true){
    $sql = "SELECT * FROM users WHERE id = :id ";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION["id"]
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);
//    echo "welkom: {$user['username']}";

}
?>

    <div class="container">

        <form class="addfield-form" action="controller.php" method="post">
            <input type="hidden" name="type" value="addfield">

            <input class="addfield-input" type="text" name="fieldname" id="fieldame" placeholder="Veld Naam">

            <button id="addfield-submit" type="submit"> Toevoegen </button>

        </form>

    </div>










<?php
require 'footer.php';
?>