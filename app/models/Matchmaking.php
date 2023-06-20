<?php

namespace Babylearn\Models;

use Babylearn\Models\Database;
class Matchmaking {
	public string $user;
	public string $language;

	public Database $database;

	function __construct($database) {
		$this->database = $database;
	}

	function setUser($user): void {
		$this->user = $user;
	}

	function getUser(): string {
		return $this->user;
	}

	function setLanguage($language): void {
		$this->language = $language;
	}

	function getLanguage(): string {
		return $this->language;
	}


	function isUserInQueue(): bool {
		$statement = $this->database->Connection()->prepare('SELECT * FROM matchmaking WHERE user = :user');
		$statement->bindParam(':user', $this->user);
		$statement->execute();
		$result = $statement->fetch();
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	function addUserToDatabase(): void {
		$statement = $this->database->Connection()->prepare('INSERT INTO matchmaking (user, language) VALUES (:user, :language)');
		$statement->bindParam(':user', $this->user);
		$statement->bindParam(':language', $this->language);
		$statement->execute();
	}

	function deleteUserFromDatabase(): void {
		$statement = $this->database->Connection()->prepare('DELETE FROM matchmaking WHERE user = :username');
		$statement->bindParam(':user', $this->user);
		$statement->execute();
	}


	function makeMatch(): ?string {
		$statement = $this->database->Connection()->prepare('SELECT user FROM matchmaking WHERE language != :language AND user != :user ORDER BY RAND() LIMIT 1');
		$statement->bindParam(':language', $this->language);
		$statement->bindParam(':user', $this->user);
		$statement->execute();
		$result = $statement->fetch();
		if ($result) {
			return $result['user'];
		} else {
			return null;
		}
	}

}