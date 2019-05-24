<?php
	require 'index.php';
	header('Content-Type: application/json');
	$json = json_encode($api);

	if (isset($_GET['key']) && $_GET['key'] == "Gr03n3Cactus") {
		echo $json;
	}
	else {
		echo 'error';
	}
		

?>

