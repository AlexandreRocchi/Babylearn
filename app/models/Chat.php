<?php

namespace Babylearn\Models;

use PDO;

require_once 'app/models/Database.php';


class Message {
	public string $id_a;
	public string $id_b;
	public string $content;
	public array $messages;
	public Database $database;

	function __construct($database) {
		$this->database = $database;
	}

	function setMessagesFromDatabase(): void {
		$statement = $this->database->Connection()->prepare('SELECT * FROM message WHERE id_a = :id_a AND id_b = :id_b OR id_a = :id_b AND id_b = :id_a');
		$statement->bindParam(':id_a', $this->id_a);
		$statement->bindParam(':id_b', $this->id_b);
		$result = $statement->execute();
		$this->messages = $result->fetchAll(PDO::FETCH_ASSOC);
	}

}