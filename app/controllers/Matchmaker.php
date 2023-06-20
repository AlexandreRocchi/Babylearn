<?php

namespace Babylearn\Controllers;

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once 'app/models/Database.php';
require_once 'app/models/Account.php';
require_once 'app/models/Matchmaking.php';
require_once 'app/models/FriendList.php';

use Babylearn\Models\Database;
use Babylearn\Models\Account;
use Babylearn\Models\Matchmaking;
use Babylearn\Models\FriendList;
use Exception;

class Matchmaker {
	public function execute(): void {
		try {
			if (!isset($_SESSION['current_user'])) {

				throw new Exception('You are not logged in.');
			}

			$database = new Database();

			$matchmaking = new Matchmaking($database);

			$current_account = new Account($database);

			$current_account->setUsername($_SESSION['current_user']);
			$current_account->setLanguageFromUsername();

			$matchmaking->setUser($current_account->getUsername());
			$matchmaking->setLanguage($current_account->getLanguage());

			if ($user_match = $matchmaking->makeMatch()) {

				$matchmaking_to_delete = new Matchmaking($database);
				$matchmaking_to_delete->setUser($user_match);
				$matchmaking_to_delete->deleteUserFromDatabase();

				$friend_list = new FriendList($database);

				$friend_list->setUserOne($matchmaking->getUser());
				$friend_list->setUserTwo($user_match);

				$friend_list->addFriendshipToDatabase();

				$_SESSION['other_user'] = $user_match;

				header('Location: message');
				return;

			}
			if (!$matchmaking->isUserInQueue()) {
				$matchmaking->addUserToDatabase();
			}
		}
		catch (Exception $e) {
			$error = $e->getMessage();
		}
		require 'app/views/Matchmaking.php';
	}

}