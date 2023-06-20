<?php

namespace Babylearn\Models;

use Exception;

class Account {
	public string $username;
	public string $email;
	public string $password;
	public string $language;
	public Database $database;

	function __construct($database) {
		$this->database = $database;
	}

	function setUsername($username):void {
		$this->username = $username;
	}
	function getUsername(): string {
		return $this->username;
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

	function getEmail(): string {
		return $this->email;
	}

	function getPassword(): string {
		return $this->password;
	}

	function getLanguage(): string {
		return $this->language;
	}

	function addAccountToDatabase():void {
		$statement = $this->database->Connection()->prepare('INSERT INTO account (username, email, password, language) VALUES (:username, :email, :password, :language)');
		$statement->bindParam(':username', $this->username);
		$statement->bindParam(':email', $this->email);
		$statement->bindParam(':password', $this->password);
		$statement->bindParam(':language', $this->language);
		$statement->execute();
	}

	function hashPassword(): void {
		$password_to_hash = $this->password;
		$this->password = hash('sha512', $password_to_hash);
	}

	function isEmailExisting(): bool {
		$statement = $this->database->Connection()->prepare('SELECT * FROM account WHERE email = :email');
		$statement->bindParam(':email', $this->email);
		$statement->execute();
		$result = $statement->fetch();
		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	function isUsernameExisting(): bool {
		$statement = $this->database->Connection()->prepare('SELECT * FROM account WHERE username = :username');
		$statement->bindParam(':username', $this->username);
		$statement->execute();
		$result = $statement->fetch();
		if ($result) {
			return true;
		} else {
			return false;
		}

	}

	function setDatabaseAccountFromUsername(): void {
	$statement = $this->database->Connection()->prepare('SELECT email, password, language FROM account WHERE username = :username');
	$statement->bindParam(':username', $this->username);
	$statement->execute();
	$result = $statement->fetch();
	$this->email = $result['email'];
	$this->password = $result['password'];
	$this->language = $result['language'];
	}

	function setEmailFromUsername(): void {
		$statement = $this->database->Connection()->prepare('SELECT email FROM account WHERE username = :username');
		$statement->bindParam(':username', $this->username);
		$statement->execute();
		$result = $statement->fetch();
		$this->email = $result['email'];
	}

	function setLanguageFromUsername(): void {
		$statement = $this->database->Connection()->prepare('SELECT language FROM account WHERE username = :username');
		$statement->bindParam(':username', $this->username);
		$statement->execute();
		$result = $statement->fetch();
		$this->language = $result['language'];
	}
}