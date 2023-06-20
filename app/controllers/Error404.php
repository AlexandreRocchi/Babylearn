<?php

namespace Babylearn\Controllers;

class Error404 {
	public function execute(): void {
		require 'app/views/Error404.php';
	}
}