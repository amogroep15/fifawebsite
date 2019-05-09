<?php
require 'header.php';
echo '<div class="create">'
?>
    <form action="loginController.php" method="POST">
        <input type="hidden" name="type" value="create">
        <p>Team naam</p><input type="text" name="name">
        <input type="submit">
    </form>
<?php
echo '</div>';
require 'footer.php';