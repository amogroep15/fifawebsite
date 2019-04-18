<?php
require 'header.php';
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

?>

<h1>Dit is een Admin pagina.</h1>
<p>Jij bent admin</p>

<?php
require 'footer.php';