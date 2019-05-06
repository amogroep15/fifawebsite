<?php
require 'header.php';
echo '<div class="adminpage">';
if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == 1){

    }
    else {
        header('Location: index.php?error=noadmin');
        exit();
    }

}
else {
    header('Location: index.php?error=noadmin');
    exit();
}

?>
<div class="admin">
    <h1>Dit is een Admin pagina.</h1>
    <p>Jij bent admin</p>
</div>
<?php
echo '</div>';
require 'footer.php';