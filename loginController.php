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
    //kas heeft dit gemaakt
    header('location: ../index.php?success=register');
    exit;
}

if ($_POST['type'] === 'login'){
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
    if(password_verify($password, $result['password'])){
        $_SESSION['id'] = $result['id'];
        if(isset($result['admin'])){
        $_SESSION['admin'] = $result['admin'];
        }
    }

    else{
       header('location: login.php?error=incorrectpassword');
       exit();
    }

       header('location: index.php?succes=login');
       exit();
}
if ($_POST['type'] === 'delete'){
    if(isset($_SESSION['admin'])){
        if($_SESSION['admin'] == 1){
    
        }
        else {
            header('Location: index.php?error=noadmin');
            exit();
        }
    
    }
    else {
        header('Location: index.php?error=noadmin');
        exit();
    }
    
    $id = $_GET['id'];
    if(empty($id)){
        header('Location: teams.php?error=noid');
        exit();
    }
    $sql = "DELETE from teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $_GET['id']
    ]);
    header('Location: teams.php?success=delete');
    exit();
}
if ($_POST['type'] === 'logout'){
    session_destroy();
    header('Location: index.php?success=logout');
}

if ($_POST['type'] === 'create'){
    if(isset($_SESSION)){

    }
    else {
        header('Location: teams.php?error=nologin');
        exit();
    }
    $creator = $_SESSION['id'];
    $name = trim($_POST['name']);
    $p1 = trim($_POST['p1']);
    $p2 = trim($_POST['p2']);
    $p3 = trim($_POST['p3']);
    $p4 = trim($_POST['p4']);
    $p5 = trim($_POST['p5']);
    $p6 = trim($_POST['p6']);
    $p7 = trim($_POST['p7']);
    $p8 = trim($_POST['p8']);
    $p9 = trim($_POST['p9']);
    $p10 = trim($_POST['p10']);
    $p11 = trim($_POST['p11']);
    $p12 = trim($_POST['p12']);
    $p13 = trim($_POST['p13']);
    $p14 = trim($_POST['p14']);
    $p15 = trim($_POST['p15']);
    $p16 = trim($_POST['p16']);


    if(empty($name) || empty($creator) || empty($p1) || empty($p2) || empty($p3)){
        header('Location: create.php?error=missingplayers');
        exit();
    }

    if(strlen($name) > 32 || strlen($p1) > 32 || strlen($p2) > 32 || strlen($p3) > 32 || strlen($p4) > 32 || strlen($p5) > 32 || strlen($p6) > 32 || strlen($p7) > 32 || strlen($p8) > 32 || strlen($p9) > 32 || strlen($p10) > 32 || strlen($p11) > 32 || strlen($p12) > 32 || strlen($p13) > 32 || strlen($p14) > 32 || strlen($p15) > 32 || strlen($p16) > 32){
        header('Location: create.php?error=charoverflow');
        exit();
    }



    $sql = "SELECT * from teams WHERE name = :name";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':name' => $name,
    ]);
    $result = $prepare->fetch();

    if($result != 0){
        header('Location: create.php?error=teamexists');
        exit();
    }

    $sql = "INSERT INTO teams(name, creator,player1, player2, player3, player4, player5, player6, player7, player8, player9, player10, player11, player12, player13, player14, player15, player16) VALUES (:name, :creator, :p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10, :p11, :p12, :p13, :p14, :p15, :p16)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':name' => $name,
        ':creator' => $creator,
        ':p1' => $p1,
        ':p2' => $p2,
        ':p3' => $p3,
        ':p4' => $p4,
        ':p5' => $p5,
        ':p6' => $p6,
        ':p7' => $p7,
        ':p8' => $p8,
        ':p9' => $p9,
        ':p10' => $p10,
        ':p11' => $p11,
        ':p12' => $p12,
        ':p13' => $p13,
        ':p14' => $p14,
        ':p15' => $p15,
        ':p16' => $p16
    ]);

    header('Location: index.php?success=create');
    exit();
}
if ($_POST['type'] === 'edit'){
    if(isset($_SESSION)){

    }
    else {
        header('Location: index.php?error=nologin');
        exit();
    }
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }
    else{
        header('Location: teams.php?error=noid');
        exit();
    }
    $creator = $_SESSION['id'];
    $name = trim($_POST['name']);
    $p1 = trim($_POST['p1']);
    $p2 = trim($_POST['p2']);
    $p3 = trim($_POST['p3']);
    $p4 = trim($_POST['p4']);
    $p5 = trim($_POST['p5']);
    $p6 = trim($_POST['p6']);
    $p7 = trim($_POST['p7']);
    $p8 = trim($_POST['p8']);
    $p9 = trim($_POST['p9']);
    $p10 = trim($_POST['p10']);
    $p11 = trim($_POST['p11']);
    $p12 = trim($_POST['p12']);
    $p13 = trim($_POST['p13']);
    $p14 = trim($_POST['p14']);
    $p15 = trim($_POST['p15']);
    $p16 = trim($_POST['p16']);
    
    $sql = "SELECT * FROM teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id'     => $id
    ]);
    $result = $prepare->fetch();
    
    if($result == 0){
        header('Location: teams.php?error=teamnotexist');
        exit();
    }
    if($result['creator'] != $creator)
    {
        header('Location: teams.php?error=nopermission');
        exit();
    }

    if(empty($name) || empty($creator) || empty($p1) || empty($p2) || empty($p3)){
        header('Location: create.php?error=missingplayers');
        exit();
    }

    if(strlen($name) > 32 || strlen($p1) > 32 || strlen($p2) > 32 || strlen($p3) > 32 || strlen($p4) > 32 || strlen($p5) > 32 || strlen($p6) > 32 || strlen($p7) > 32 || strlen($p8) > 32 || strlen($p9) > 32 || strlen($p10) > 32 || strlen($p11) > 32 || strlen($p12) > 32 || strlen($p13) > 32 || strlen($p14) > 32 || strlen($p15) > 32 || strlen($p16) > 32){
        header('Location: create.php?error=charoverflow');
        exit();
    }

    $sql = "UPDATE teams SET 
        name = :name,
        player1 = :p1,
        player2 = :p2,
        player3 = :p3,
        player4 = :p4,
        player5 = :p5,
        player6 = :p6,
        player7 = :p7,
        player8 = :p8,
        player9 = :p9,
        player10 = :p10,
        player11 = :p11,
        player12 = :p12,
        player13 = :p13,
        player14 = :p14,
        player15 = :p15,
        player16 = :p16
        WHERE id = :id   
        ";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':name' => $name,
        ':p1' => $p1,
        ':p2' => $p2,
        ':p3' => $p3,
        ':p4' => $p4,
        ':p5' => $p5,
        ':p6' => $p6,
        ':p7' => $p7,
        ':p8' => $p8,
        ':p9' => $p9,
        ':p10' => $p10,
        ':p11' => $p11,
        ':p12' => $p12,
        ':p13' => $p13,
        ':p14' => $p14,
        ':p15' => $p15,
        ':p16' => $p16,
        ':id' => $id
    ]);
    header('Location: teams.php?success=edit');
    exit();
}
