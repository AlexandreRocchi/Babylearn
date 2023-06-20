<?php

namespace Babylearn\Controllers;

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

class SignedIn {
	public function execute(): void {
		require 'app/views/SignedIn.php';
	}
}