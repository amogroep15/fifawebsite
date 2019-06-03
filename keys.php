<?php
require 'header.php';
if(isset($_SESSION['admin'])){

}
else{
    header('Location: index.php?error=nopermission');
    exit();
}
?>


<form action="loginController.php" method="POST">
        <input type="hidden" name="type" value="key">
        <div>
            <input class="buttons1" value="Nieuwe key" type="submit">
        </div>
    </form>
