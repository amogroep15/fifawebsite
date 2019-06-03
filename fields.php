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


$sql = "SELECT * FROM fields";
$query = $db->query($sql); //verzoek naar de database, voer sql van hierboven uit
$fields = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="downloadpage">
    <div class="field">
        <?php
        echo '<ul  class="fieldsul">';
        foreach ($fields as $field){
            $fieldname = htmlentities($field['fieldname']);

            echo
            "<li class='fieldsli'><a class='fieldnames' href='fielddetail.php?id={$field ['id']}'>$fieldname</a> 

             </li>";
        }
        echo '</ul>';
        ?>


    <a class="add" href="addfield.php">Veld toevoegen</a>

    <form action="controller.php" method="post">
        <input type="hidden" name="type" value='reset_fields'>
        <button class='delete-button' type='submit'>Alle velden verwijderen</button>
    </form>
    </div>

</div>

<?php require 'footer.php'; ?>