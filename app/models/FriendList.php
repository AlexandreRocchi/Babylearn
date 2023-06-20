<?php

namespace Babylearn\Models;

use Babylearn\Models\Database;
use PDO;

class FriendList {
	public string $user_one;
	public string $user_two;
	public array $friends;
	public Database $database;

	function __construct($database) {
		$this->database = $database;
	}

	function setUserOne($user_one): void {
		$this->user_one = $user_one;
	}
	function setUserTwo($user_two): void {
		$this->user_two = $user_two;
	}
	function getUserOne(): string {
		return $this->user_one;
	}
	function getUserTwo(): string {
		return $this->user_two;
	}

	function setFriendsFromDatabase(): void {
		$statement = $this->database->Connection()->prepare('SELECT * FROM friend_list WHERE user_one = :user_one1 OR user_two = :user_one2');
		$statement->bindParam(':user_one1', $this->user_one);
		$statement->bindParam(':user_one2', $this->user_one);
		$statement->execute();
		$this->friends = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	function isFriendshipExisting(): bool {
		$statement = $this->database->Connection()->prepare('SELECT * FROM friend_list WHERE (user_one = :user_one1 AND user_two = :user_two1) OR (user_one = :user_two2 AND user_two = :user_one2)');
		$statement->bindParam(':user_one1', $this->user_one);
		$statement->bindParam(':user_two1', $this->user_two);
		$statement->bindParam(':user_two2', $this->user_two);
		$statement->bindParam   (':user_one2', $this->user_one);
		$statement->execute();
		$result = $statement->fetch();
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	function addFriendshipToDatabase(): void {
		$statement = $this->database->Connection()->prepare('INSERT INTO friend_list (user_one, user_two) VALUES (:user_one, :user_two)');
		$statement->bindParam(':user_one', $this->user_one);
		$statement->bindParam(':user_two', $this->user_two);
		$statement->execute();
	}
}