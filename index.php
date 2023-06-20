<?php


$uri = explode('/', $_SERVER['REQUEST_URI']);
$file = $uri[1];

try {
	if ($file === 'test') {
	require 'app/views/Test.php';
	}
	else {
		require 'app/views/Error404.php';
	}

} catch (Exception $e) {
	$error_message = $e->getMessage();
}