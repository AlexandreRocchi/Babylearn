<?php

namespace Babylearn\Controllers;

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
class Logout {
	public function execute(): void {
		session_unset();
		session_destroy();
		header('Location: login');
	}
}