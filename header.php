<?php
/**
 * Created by PhpStorm.
 * User: hfm
 * Date: 15-4-2019
 * Time: 11:07
 */

require 'config.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>FifaBet</title>
</head>
<header>
    <div class="logo">
        <h1><a class="homebutton" id="a1" href="index.php">FifaBet</a></h1>
        <img  class="rotate-diagonal-1" src="imgs/fbi.svg">
    </div>
    <ul>
        <li><a class="active" href="teams.php">Teams</a></li>
        <li>
            <?php
            if (isset($_SESSION['id'])){
                echo "";
            }
            else {
                echo "<a  class='nav-link' href='login.php'>Login</a>";
            }
            ?>
        </li>
        <li>
            <?php
            if (isset($_SESSION['id'])){
                echo "";
            }
            else {
                echo "<a class='nav-link' href='register.php'>Register</a>";
            }
            ?>
        </li>
        <li><a href="index.php">Home</a></li>
        <li><?php
        if(isset($_SESSION['id'])){
            echo "<form action='loginController.php' method='post'>
                <input type='hidden' name='type' value='logout'>
                <input class='nav-link' type='submit' value='Afmelden'>
                </form>";

        }
        ?>
        </li>
        <li>
            <?php
            if (isset($_SESSION['id'])){
                echo "<a class='nav-link' href='create.php'>Maak een Team</a>";
            }

            ?>
        </li>
        <li>
            <?php
            if(isset($_SESSION['admin'])){
                if($_SESSION['admin'] == 1){
                    echo '<a class="nav-link" href="matches.php">Competitie maken</a>';
                }
                else {
                    header('Location: index.php?error=noadmin');
                    exit();
                }

            }
            ?>
        </li>
        <li>
            <?php
            if (isset($_SESSION['id'])){
                echo "<a class='nav-link' href='download.php'>Download</a>";
            }

            ?>
        </li>
    </ul>
</header>
<body>
