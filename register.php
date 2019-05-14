<?php

require 'header.php';

if(isset ($_GET['error'])){

    if($_GET['error'] == 'charcheck') {
        echo "<script> alert('Je moet minimaal 1 hoofdletter en minimaal 1 speciale letter in je wachtwoord hebben!')</script>";
    }
    if($_GET['error'] == 'pwdlength') {
        echo "<script> alert('Wachtwoord moet minimaal 7 tekens hebben!')</script>";
    }
    if($_GET['error'] == 'pwdmatch') {
        echo "<script> alert('Wachtwoord is niet hetzelfde!')</script>";
    }
    if($_GET['error'] == 'invalidemail') {
        echo "<script> alert('Onjuist emailadres!')</script>";
    }
    if($_GET['error'] == 'emailexists') {
        echo "<script> alert('Er bestaat al een account op dat emailadres!')</script>";
    }
    if($_GET['error'] == 'tos') {
        echo "<script> alert('Je moet akkoord gaan met de algemene voorwaarden!')</script>";
    }
    echo '</p>';
}
//kas heeft dit gemaakt
?>
<div class="container">
<div class="register">
            <form action="loginController.php" method="post" >
                <input type="hidden" name="type" value="register">
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

                <div class="form-group">
                    <label for="password_confirm">Please confirm your password</label>
                    <input type="password" name="password_confirm" id="password_confirm">
                </div>

                <input type="submit" value="Register" name="register-submit">
    </form>
     </div>
    </div>
</div>

<?php require 'footer.php'; ?>
