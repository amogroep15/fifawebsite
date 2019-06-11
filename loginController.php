<?php
require 'config.php';
if(!isset($_POST['type'])){
    header('Location: index.php');
    exit;
}
function pwdCheckUpper($string) {
    if(preg_match("/[A-Z]/", $string)===0) {
        return false;
    }
    return true;
}


function pwdCheckSpecial($string) {
    if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $string)=== 0) {
        return false;
    }
    return true;
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
    if(isset($_SESSION['id'])){
        header('Location: header.php?error=nopermission');
        exit;
    }
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);
    $emailcheck = filter_var($email, FILTER_VALIDATE_EMAIL);
    if(empty($username)){
        header('location: ../register.php?error=emptyuser');
        exit;
    } else if(empty($password)){
        header('location: ../register.php?error=emptypass');
        exit;
    } else if(strlen($password) < 4){
        header('location: ../register.php?error=pwdlength');
        exit;
    } else if(strlen($username) >= 32 || strlen($username) < 2){
        header('location: ../register.php?error=userlength');
        exit;
    } else if (pwdCheckUpper($password) == false && pwdCheckSpecial($password) == false){
        header('location: ../register.php?error=charche+ck');
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
    if(isset($_SESSION['id'])){
        header('Location: index.php?error=noentry');
        exit();
    }
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
        $_SESSION['username'] = $result['username'];
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
    if(isset($_SESSION['id'])){

    }
    else {
        header('Location: teams.php?error=nologin');
        exit();
    }
    $creator = $_SESSION['id'];
    $name = trim($_POST['name']);

    if(empty($name) || empty($creator)){
        header('Location: create.php?error=noname');
        exit();
    }

    if(strlen($name) > 32){
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

    $sql = "INSERT INTO teams(name, creator) VALUES (:name, :creator)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':name' => $name,
        ':creator' => $creator,    
    ]);

    header('Location: index.php?success=create');
    exit();
}
if ($_POST['type'] === 'join'){
    if(isset($_SESSION['id'])){

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
    $playerid = $_SESSION['id'];

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
    $players = array();
    if(!empty($result['players'])){
        $players = explode(':', $result['players']);
    }
    if(in_array($_SESSION['id'], $players)){
        header('Location: teams.php?error=alreadyinteam');
        exit;
    }
    array_push($players, $_SESSION['id']);
    $players = implode(":" , $players);
    $sql = "UPDATE teams SET 
        players = :players
        WHERE id = :id   
        ";
   $prepare = $db->prepare($sql);
   $prepare->execute([
       ':players' => $players,
       ':id' => $id
   ]);
   header('Location: teams.php?success=join');
    exit();
}
if ($_POST['type'] === 'edit'){
    if(isset($_SESSION['id'])){

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
    if(isset($_SESSION['admin'])){

    }
    else if($result['creator'] != $creator )
    {
        header('Location: teams.php?error=nopermission');
        exit();
    }

    if(empty($name) || empty($creator)){
        header('Location: create.php?error=missingplayers');
        exit();
    }

    if(strlen($name) > 32){
        header('Location: create.php?error=charoverflow');
        exit();
    }

    $sql = "UPDATE teams SET 
        name = :name
        WHERE id = :id   
        ";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':name' => $name,
        ':id' => $id
    ]);
    if (isset($_POST['buttonsave'])) {
        header('Location: edit.php?id='.$id.'&success=edit');
        exit();
    }
    else{
        header('Location: teams.php?id='.$id.'&success=edit');
        exit();
    }


}

if ($_POST['type'] === 'deleteplayer'){
    if(isset($_SESSION['id'])){

    }
    else {
        header('Location: index.php?error=nologin');
        exit();
    }
    if(!isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['teamid']) || empty($_GET['teamid'])){
        header('location: index.php?error=noid');
        exit;
    }

    $id = $_GET['id'];
    $teamid = $_GET['teamid'];
    //pak selecteer eerst alle spelers van de team
    //explode het
    //verwijder de id van de persoon die weg moet
    //implode het
    //update in database
    $sql = "SELECT * FROM teams WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id'     => $teamid
    ]);
    $result = $prepare->fetch();
    
    if($result['creator'] !== $_SESSION['id']){
        if($_SESSION['admin']){

        }
        else{
            header('location: teams.php?error=nopermission');
            exit;
        }
    }
    $players = explode(":", $result['players']);
    $key = array_search($id, $players);
    if(isset($players[$key])){
        unset($players[$key]);
    }
    $players = implode(":", $players);
    $sql = "UPDATE teams SET 
        players = :players
        WHERE id = :id   
        ";
   $prepare = $db->prepare($sql);
   $prepare->execute([
       ':players' => $players,
       ':id' => $teamid
   ]);
   header('location: edit.php?id='.$teamid.'success=deleteplayer');
   exit;
}
if ($_POST['type'] === 'competitionstart'){
    if(isset($_SESSION['admin'])){
        if($_SESSION['admin'] == 1){

        }
        else {
            header('Location: index.php?error=noadmin');
            exit();
        }
        $time = $_POST['time'];
        $fields = $_POST['fields'];


    }
    $sql = "UPDATE competitions SET 
        started = :started,
        playtime = :time,
        fields = :fields
    ";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':started' => true,
        ':time' => $time,
        ':fields' => $fields

    ]);

    header('Location: matches.php?success=started');
    exit();
    
}
if ($_POST['type'] === 'competitionstop'){
    if(isset($_SESSION['admin'])){
        if($_SESSION['admin'] == 1){

        }
        else {
            header('Location: index.php?error=noadmin');
            exit();
        }

    }
    $sql = "UPDATE competitions SET 
    started = :1  
    ";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':1' => false

    ]);

    header('Location: matches.php?success=ended');
    exit();
    
}

if ($_POST['type'] === 'key'){
    if(isset($_SESSION['admin'])){

    }
    else{
        header('Location: index.php?error=nopermission');
        exit();
    }
    $random = md5(rand($min = 999999999, $max = 99999999));
    $sql = "INSERT INTO tokens(token) VALUES('$random')";
    $query = $db->query($sql);
    
    header('location: keys.php?create=success');
}
if ($_POST['type'] === 'deletekey'){
    echo 'test1';
    if(isset($_SESSION['admin'])){

    }
    else{
        header('Location: index.php?error=nopermission');
        exit();
    }
    $id = trim($_GET['id']);
    $sql = "DELETE from tokens WHERE id = :id";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        ':id' => $id
    ]);

    echo 'test2';
    
    header('location: keys.php?delete=success');
    exit;
}
if ($_POST['type'] === 'addplayer'){
    if(isset($_SESSION['id'])){

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
    if(isset($_GET['pid'])){
    $playerid = $_GET['pid'];
    }
    else{
    header('Location: teams.php?error=noid');
    exit();
    }

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
    $players = array();
    if(!empty($result['players'])){
        $players = explode(':', $result['players']);
    }
    if(in_array($playerid, $players)){
        header("Location: addplayer.php?id=$id&error=alreadyinteam");
        exit;
    }
    array_push($players, $playerid);
    $players = implode(":" , $players);
    $sql = "UPDATE teams SET 
        players = :players
        WHERE id = :id   
        ";
   $prepare = $db->prepare($sql);
   $prepare->execute([
       ':players' => $players,
       ':id' => $id
   ]);
   header('Location: teams.php?success=join');
    exit();
}