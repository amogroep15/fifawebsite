<?php
require 'header.php';
echo '<div class="create">';
if(isset($_SESSION['id'])){

}
else {
    header('Location: index.php?error=nologin');
    exit();
}
?>
    <form class="teammaker" action="loginController.php" method="POST">
        <input type="hidden" name="type" value="create">
        <div>
            <p>Team naam*</p><input type="text" name="name">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
<?php
echo '</div>';
require 'footer.php';