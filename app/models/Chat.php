<?php

namespace Babylearn\Models;

use PDO;

require_once 'app/models/Database.php';


class Chat {
	public string $current_user;
	public string $other_user;
	public string $content;
	public array $messages;
	public Database $database;

	function __construct($database) {
		$this->database = $database;
	}

	function setCurrentUser($current_user): void {
		$this->current_user = $current_user;
	}

	function getCurrentUser(): string {
		return $this->current_user;
	}

	function getOtherUser(): string {
		return $this->other_user;
	}
	function setOtherUser($other_user): void {
		$this->other_user = $other_user;
	}

	function setContent($content): void {
		$this->content = $content;
	}

	function addToDatabase(): void {
		$statement = $this->database->connection()->prepare('INSERT INTO chat (sender, receiver, content) VALUES (:current_user, :other_user, :content)');
		$statement->bindParam(':current_user', $this->current_user);
		$statement->bindParam(':other_user', $this->other_user);
		$statement->bindParam(':content', $this->content);
		$statement->execute();
	}


	function setMessagesFromDatabase(): void {
		$statement = $this->database->Connection()->prepare('SELECT * FROM chat WHERE (sender = :current_user1 AND receiver = :other_user1) OR (sender = :other_user2 AND receiver = :current_user2)');
		$statement->bindParam(':current_user1', $this->current_user);
		$statement->bindParam(':other_user1', $this->other_user);
		$statement->bindParam(':other_user2', $this->other_user);
		$statement->bindParam(':current_user2', $this->current_user);
		$statement->execute();
		$this->messages = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

}