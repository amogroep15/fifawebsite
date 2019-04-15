<?php

$dbHost = "localhost";
$dbName = "fifabet";
$dbUser = "root";
$dbPass = "";

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div class='note' style='background: #fedde9; padding: 10px; margin: 10px; font-family: courier'>
            <h4>oof</h4>
            Verbinding met database mislukt
         </div>";
    die($e->getMessage());
}

session_start();
