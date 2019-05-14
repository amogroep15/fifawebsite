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
            <p>Speler 1*</p><input type="text" name="p1">
            <p>Speler 2*</p><input type="text" name="p2">
            <p>Speler 3*</p><input type="text" name="p3">
            <p>Speler 4</p><input type="text" name="p4">
        </div>
        <div>
            <p>Speler 5</p><input type="text" name="p5">
            <p>Speler 6</p><input type="text" name="p6">
            <p>Speler 7</p><input type="text" name="p7">
            <p>Speler 8</p><input type="text" name="p8">
        </div>
        <div>
            <p>Speler 9</p><input type="text" name="p9">
            <p>Speler 10</p><input type="text" name="p10">
            <p>Speler 11</p><input type="text" name="p11">
            <p>Speler 12</p><input type="text" name="p12">
        </div>
        <div>
            <p>Speler 13</p><input type="text" name="p13">
            <p>Speler 14</p><input type="text" name="p14">
            <p>Speler 15</p><input type="text" name="p15">
            <p>Speler 16</p><input type="text" name="p16">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
<?php
echo '</div>';
require 'footer.php';