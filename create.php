<?php
require 'header.php';
echo '<div class="create">'
?>
    <form action="loginController.php" method="POST">
        <input type="hidden" name="type" value="create">
        <p>Team naam</p><input type="text" name="name">
        <p>Speler 1</p><input type="text" name="name">
        <p>Speler 2</p><input type="text" name="name">
        <p>Speler 3</p><input type="text" name="name">
        <p>Speler 4</p><input type="text" name="name">
        <p>Speler 5</p><input type="text" name="name">
        <p>Speler 6</p><input type="text" name="name">
        <p>Speler 7</p><input type="text" name="name">
        <p>Speler 8</p><input type="text" name="name">
        <p>Speler 9</p><input type="text" name="name">
        <p>Speler 10</p><input type="text" name="name">
        <p>Speler 11</p><input type="text" name="name">
        <p>Speler 12</p><input type="text" name="name">
        <p>Speler 13</p><input type="text" name="name">
        <p>Speler 14</p><input type="text" name="name">
        <p>Speler 15</p><input type="text" name="name">
        <p>Speler 16</p><input type="text" name="name">
        <input type="submit">
    </form>
<?php
echo '</div>';
require 'footer.php';