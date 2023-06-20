<?php

namespace Babylearn\Controllers;

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once 'app/models/Account.php';
require_once 'app/models/Database.php';


use Babylearn\Models\Account;
use Babylearn\Models\Database;
use Exception;

class Register {
	public function execute(): void {
		try {
			if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['language'])) {

				$database = new Database();

				$account = new Account($database);

				$account->setUsername($_POST['username']);

				if ($account->isUsernameExisting()) {
					throw new Exception('This username is already taken.');
				}

				$account->setEmail($_POST['email']);

				if ($account->isEmailExisting()) {
					throw new Exception('This email is already taken.');
				}

				$account->setPassword($_POST['password']);
				$account->hashPassword();

				$account->setLanguage($_POST['language']);
				$account->addAccountToDatabase();

				$_SESSION['current_user'] = $account->getUsername();
				header('Location: homepage');
			}

		}
		catch (Exception $e) {
			$error = $e->getMessage();
		}
		require 'app/views/RegisterPage.php';
	}
}