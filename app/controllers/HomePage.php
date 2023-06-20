<?php

namespace Babylearn\Controllers;

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once 'app/models/Database.php';
require_once 'app/models/Account.php';
require_once 'app/models/FriendList.php';

use Babylearn\Models\Database;
use Babylearn\Models\Account;
use Babylearn\Models\FriendList;

class HomePage {
	public function execute(): void {
		if (isset($_SESSION['current_user'])) {

			if (isset($_POST['friend_name'])) {
				$_SESSION['other_user'] = $_POST['friend_name'];
				header('Location: message');
				return;
			}

			$database = new Database();
			$account = new Account($database);

			$account->setUsername($_SESSION['current_user']);
			$account->setEmailFromUsername();
			$account->setLanguageFromUsername();

			$friend_list = new FriendList($database);
			$friend_list->setUserOne($_SESSION['current_user']);
			$friend_list->setFriendsFromDatabase();

		}
		require 'app/views/HomePage.php';
	}
}