<?php
require 'index.php';
header('Content-Type: application/json');
$matchjson = json_encode($matchapi);


if (isset($_GET['key']) && $_GET['key'] == "Gr03n3Cactus") {
	echo $matchjson;
}
else {
	echo 'error';
}
?>