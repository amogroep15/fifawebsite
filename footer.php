<?php
/**
 * Created by PhpStorm.
 * User: hfm
 * Date: 15-4-2019
 * Time: 11:07
 */
?>
<footer>
    &copy; copyright Kas Rasenberg, Daniel Vahabi, Rick van Zelst en Hassan Hassan, AMO Groep 15 <?php echo date('d-m-y');?>
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

        var audio = new Audio('audio/konami.mp3');
        audio.play();

        alert("cheats activated");
    }


</script>
</html>