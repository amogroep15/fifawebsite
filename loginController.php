<?php
require 'config.php';
function pwdCheckUpper($string) {
    if(preg_match("/[A-Z]/", $string)===0) {
        return true;
    }
    return false;
}


function pwdCheckSpecial($string) {
    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string)=== 0) {
        return true;
    }
    return false;
}

function emailcheck($db, $email) {
    $sql = "SELECT * FROM users WHERE email=:email";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':email'     => $email
    ]);
    return  (bool)$prepare->fetchColumn();
}

if ($_POST['type'] === 'register') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $emailcheck = filter_var($email, FILTER_VALIDATE_EMAIL);
    if(empty($username)){
        header('location: ../register.php?error=emptyuser');
        exit;
    } else if(strlen($username) >= 32){
        header('location: ../register.php?error=userlength');
        exit;
    } else if (pwdCheckUpper($password) == true && pwdCheckSpecial($password) == false){
        header('location: ../register.php?error=charcheck');
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
    $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(username, email, password) VALUES(:username, :email, :password)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':username'  => $username,
        ':email'     => $email,
        ':password'  => $hashedpwd
    ]);
    header('location: ../index.php?success=register');
    exit;
}

if ($_POST['type'] === 'login'){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':email'     => $email
    ]);
    $result = $prepare->fetch();

    if(!isset($result)){
        header('location: login.php?error=unknownemail');
        exit();
    }
    if($username !== $result['username']){
        header('Location: login.php?error=incorrectusername');
        exit();
    }
    if(password_verify($password, $result['password'])){
        $_SESSION['id'] = $result['id'];
        if(isset($result['admin'])){
        $_SESSION['admin'] = $result['admin'];
        }
    }
    else{
       header('location: index.php?error=incorrectpassword');
       exit();
    }

       header('location: index.php?succes=login');
       exit();
}

if ($_POST['type'] === 'logout'){
session_destroy();
header('Location: index.php?success=logout');
}