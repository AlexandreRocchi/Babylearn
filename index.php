<?php


use Babylearn\Controllers\Error404;
use Babylearn\Controllers\HomePage;
use Babylearn\Controllers\Login;
use Babylearn\Controllers\Register;
use Babylearn\Controllers\Logout;
use Babylearn\Controllers\Message;
use Babylearn\Controllers\Matchmaker;

$uri = explode('/', $_SERVER['REQUEST_URI']);
$file = $uri[1];

try {
	switch ($file) {

		case 'register':
			require_once 'app/controllers/Register.php';
			(new Register())->execute();
			break;

		case 'login':
			require_once 'app/controllers/Login.php';
			(new Login())->execute();
			break;

		case 'logout':
			require_once 'app/controllers/Logout.php';
			(new Logout())->execute();
			break;

		case 'homepage':
			require_once 'app/controllers/HomePage.php';
			(new HomePage())->execute();
			break;

		case 'matchmaking':
			require_once 'app/controllers/Matchmaker.php';
			(new Matchmaker())->execute();
			break;

		case 'message':
			require_once 'app/controllers/Message.php';
			(new Message())->execute();
			break;

		default:
			require 'app/controllers/Error404.php';
			(new Error404())->execute();
	}
} catch (Exception $e) {
	$error_message = $e->getMessage();
}