<?php

namespace Babylearn\Controllers;

require_once 'app/models/Database.php';
require_once 'app/models/Matchmaking.php';

use Babylearn\Models\Database;
use Babylearn\Models\Matchmaking;

class Matchmaking {
	public function execute(): void {

		if (isset($_SESSION['current_id'])) {
			$database = new Database();

			$matchmaking = new Matchmaking($database);
		}

		require 'app/views/Matchmaking.php';
	}

}