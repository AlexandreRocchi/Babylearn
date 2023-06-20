<?php

namespace Babylearn\Models;

use PDO;

class Database {

	public ?PDO $database = null;

	function connection(): PDO {
		if ($this->database === null) {
			$this->database = new PDO('mysql:host=localhost;dbname=babylearn', 'root', '');
			$this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}
		return $this->database;
	}
}