<?php

namespace Babylearn\Models;

use Exception;

class User {
	public string $email;
	public string $password;
	public string $language;
	public string $id;
	public Database $database;

	function __construct($database) {
		$this->database = $database;
	}

	function setEmail($email): void {
		$this->email = $email;
	}
	function setPassword($password): void {
		$this->password = $password;
	}
	function setLanguage($language): void {
		$this->language = $language;
	}
	function setId($id): void {
		$this->id = $id;
	}
	function getEmail(): string {
		return $this->email;
	}
	function getPassword(): string {
		return $this->password;
	}
	function getLanguage(): string {
		return $this->language;
	}
	function getId(): string {
		return $this->id;
	}

	public function addUserToDatabase():void {
		$statement = $this->database->Connection()->prepare('INSERT INTO users (email, password, language, id) VALUES (:email, :password, :language, :id)');
		$statement->bindParam(':email', $this->email);
		$statement->bindParam(':password', $this->password);
		$statement->bindParam(':language', $this->language);
		$statement->bindParam(':id', $this->id);
		$statement->execute();
	}



	public function createId(): string|Exception {
		try {
			return bin2hex(random_bytes(64));
		}
		catch (Exception $e) {
			return $e;
		}
	}
}