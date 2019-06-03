<?php require 'header.php';

$id = $_GET['id'];

$sql = "SELECT * FROM fields WHERE id = :id";
$prepare = $db->prepare($sql);
$prepare->execute([
    ':id' => $id
]);
$field = $prepare->fetch(PDO::FETCH_ASSOC);


if (isset($_SESSION["id"])){
    $sql = "SELECT * FROM users WHERE id = :id ";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION["id"]
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);


}
else{
    header("location: index.php");
}

if (isset($_SESSION["id"])){
    $sql = "SELECT * FROM users WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $_SESSION['id']
    ]);
    $user = $prepare->fetch(PDO::FETCH_ASSOC);

}


$fieldname = htmlentities($field['fieldname']);
?>


    <div class="downloadpage">
        <div class="field">
        <h3>&nbsp;<?=$fieldname?></h3>

        <?php if ($user ['admin'] == 1 ){
    echo "<form action='controller.php?id=$id' method='post'>";
    echo "<input type='hidden' name='type'  value='delete_field'>";
    echo "<button class='delete-button' type='submit' value='delete_field'> Verwijderen </button>
    </form>";
        }?>
        </div>
    </div>
<?php require 'footer.php'; ?>