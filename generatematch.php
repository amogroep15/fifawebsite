<?php require 'header.php';

?>
<div class="downloadpage">
<form  class="genmatch" action="controller.php" method="post">
    <input type='hidden' name='type' value='create-competition'>
<!---->
<!--    <label for="match_timestamp">Begin tijd van de wedstrijden</label>-->
<!--    <input type="time" name="match_timestamp" id="match_timestamp">-->
<!---->
<!--    <input type="number" name="field_id" id="field_id">-->

    <button type="submit">Competitie Maken</button>
</form>
</div>

<?php require 'footer.php';
?>
