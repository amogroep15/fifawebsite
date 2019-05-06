<?php
require 'header.php';

?>
    <form action="loginController.php" method="POST">
        <input type="hidden" name="type" value="create">
        <p>Team naam</p><input type="text" name="name">
        <input type="submit">
    </form>
<?php

require 'footer.php';