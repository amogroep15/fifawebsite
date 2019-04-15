<?php

if ($_POST['type'] === 'register') {
    $username = $_POST['']
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $emailcheck = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (pwdCheckUpper($password) == true && pwdCheckSpecial($password) == false){
        header('location: ../register.php?error=charcheck');
        exit;
    } else if (strlen($password) < 7)
    {
        header('location: ../register.php?error=pwdlength');
        exit;
    } else if ($password_confirm != $password){
        header('location: ../register.php?error=pwdmatch');

        exit;
    } else if($emailcheck == false){
        header('location: ../register.php?error=invalidmail');
        exit;
    } else if (emailcheck($db, $email)) {
        header('location: ../register.php?error=emailexists');
        exit;
    }
    if(!$_POST['accept_TOS']) {
        header('location: ../register.php?error=tos');
        exit;
    }

    $cleanpwd = trim($password);
    $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(username, email, password) VALUES(:username, :email, :password)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':email'     => $email,
        ':password'  => $hashedpwd
    ]);


    header('location: ../index.php?success=register');
    exit;
}