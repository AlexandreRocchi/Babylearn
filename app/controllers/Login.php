<?php

namespace Babylearn\Controllers;

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once 'app/models/Database.php';
require_once 'app/models/Account.php';

use Babylearn\Models\Database;
use Babylearn\Models\Account;
use Exception;
class Login {
	public function execute(): void {
		try {

			if (isset($_POST['username']) && isset($_POST['password'])) {
				$database = new Database();

				$current_account = new Account($database);
				$current_account->setUsername($_POST['username']);

				if (!$current_account->isUsernameExisting()) {
					throw new Exception('This username is not registered.');
				}

				$database_account = new Account($database);
				$database_account->setUsername($_POST['username']);
				$database_account->setDatabaseAccountFromUsername();


				$current_account->setPassword($_POST['password']);
				$current_account->hashPassword();

				if (!hash_equals($database_account->getPassword(), $current_account->getPassword())) {
					throw new Exception('Password does not match.');
				}

				$_SESSION['current_user'] = $database_account->getUsername();
				header('Location: homepage');
			}

		}
		catch (Exception $e) {
			$error = $e->getMessage();
		}
		require 'app/views/LoginPage.php';
	}

}