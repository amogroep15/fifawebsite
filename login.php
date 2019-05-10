<?php require 'header.php'; ?>
<div class="login">
    <div class="form">
        <form action="loginController.php" method="post">
            <input type="hidden" name="type" value="login">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <input class="loginbutton" type="submit" value="">
        </form>
    </div>
</div>
</body>
<?php require 'footer.php'; ?>


