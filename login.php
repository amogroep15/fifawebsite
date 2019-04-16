<?php require 'header.php'; ?>

<div class="form">
    <div class="form1">
<form action="loginController.php" method="post">
    <input type="hidden" name="type" value="login">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <input type="submit" value="login">
</form>
    </div>
</div>
<?php require 'footer.php'; ?>

<?php

