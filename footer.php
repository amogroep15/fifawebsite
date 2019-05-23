<?php
/**
 * Created by PhpStorm.
 * User: hfm
 * Date: 15-4-2019
 * Time: 11:07
 */
?>
<footer class="footer-distributed">

    <div class="footer-left">

        <h3><a class="homebutton" id="a1" href="index.php">FifaBet</a>   <i class="fas fa-futbol"></i></h3>

        <p class="footer-links">
            <a href="index.php">Home</a>
            ·
            <a href="teams.php">Teams</a>
            ·
            <?php
            if (isset($_SESSION['id'])){
                echo "";
            }
            else {
                echo "<a  class='nav-link' href='login.php'>Login</a>";
            }
            ?>
            ·
            <?php
            if (isset($_SESSION['id'])){
                echo "";
            }
            else {
                echo "<a class='nav-link' href='register.php'>Register</a>";
            }
            ?>
        </p>

        <p class="footer-company-name">Fifabet <i class="fas fa-futbol"></i> © 2019</p>
    </div>

    <div class="footer-center">

        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>terheijdenseweg 350</span> Breda, Nederland</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>06 - 86131114</p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:h.fm@live.com">h.fm@live.com</a></p>
        </div>

    </div>

    <div class="footer-right">

        <p class="footer-company-about">
            <span>Over ons</span>
            Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
        </p>

        <div class="footer-icons">

            <a href="https://www.facebook.com"><img src="imgs/fb.png"></a>
            <a href="https://twitter.com/?lang=en"><img src="imgs/t.png"></a>
            <a href="https://www.linkedin.com/"><img src="imgs/in.png"></a>
            <a href="https://github.com/amogroep15/fifawebsite/graphs/contributors"><img src="imgs/git.png"></a>

        </div>

    </div>
    <div class="copy">
        &copy; copyright Kas Rasenberg, Daniel Vahabi, Rick van Zelst en Hassan Hassan, AMO Groep 15 <?php echo date('d-m-y');?>
    </div>
</footer>


</body>
<script>
    // lijst van knoppen die goedgekeurd worden
    var allowedKeys = {
        37: 'left',
        38: 'up',
        39: 'right',
        40: 'down',
        65: 'a',
        66: 'b'
    };

    // officele konami cheat code
    var konamiCode = ['up', 'up', 'down', 'down', 'left', 'right', 'left', 'right', 'b', 'a'];

    // een var die de positie onthoudt van waar de gebruiker was gekomen
    var konamiCodePosition = 0;

    // add keydown event listener
    document.addEventListener('keydown', function(e) {
        // get the value of the key code from the key map
        var key = allowedKeys[e.keyCode];
        // get the value of the required key from the konami code
        var requiredKey = konamiCode[konamiCodePosition];

        // compare the key with the required key
        if (key == requiredKey) {

            // move to the next key in the konami code sequence
            konamiCodePosition++;

            // if the last key is reached, activate cheats
            if (konamiCodePosition == konamiCode.length) {
                activateCheats();
                konamiCodePosition = 0;
            }
        } else {
            konamiCodePosition = 0;
        }
    });

    function activateCheats() {
        document.getElementById('welkom').innerHTML = "Welkom To Konami!";
        document.getElementById('a1').innerHTML = "Konami";
        document.getElementById('a1').href = "https://www.konami.com/en/";

        var audio = new Audio('audio/pling.mp3');
        audio.play();

        alert("cheats activated");
    }


</script>
</html>