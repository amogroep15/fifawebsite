<?php require 'header.php';

?>
<div class="downloadpage">
<form  class="time" action="controller.php" method="post">
    <input type='hidden' name='type' value='set_time'>

    <label for="start_time">Begin tijd van de wedstrijden</label>
    <input type="time" name="start_time" id="start_time">

    <label for="match_length">Wedstrijdsduur (minuten)</label>
    <input type="text" name="match_length" id="match_length">

    <label for="rest">Tussenpauze minuten</label>
    <input type="text" name="rest" id="rest">

    <label for="break">Pauze</label>
    <input type="text" name="break" id="break">

    <button type="submit">Registreer de tijd</button>
</form>

</div>

<?php require 'footer.php';?>


