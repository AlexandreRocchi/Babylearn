<?php

namespace Babylearn\Controllers;

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once 'app/models/Chat.php';
require_once 'app/models/Database.php';

use Babylearn\Models\Chat;
use Babylearn\Models\Database;
use Exception;

class Message {
	public function execute(): void {
		try {

			if (!(isset($_SESSION['current_user']) && isset($_SESSION['other_user']))) {
				header('Location: homepage');
			}

			$database = new Database();

			if (isset($_POST['content'])) {

			$new_chat = new Chat($database);

			$new_chat->setCurrentUser($_SESSION['current_user']);
			$new_chat->setOtherUser($_SESSION['other_user']);
			$new_chat->setContent($_POST['content']);

			$new_chat->addToDatabase();

			}

			$chat = new Chat($database);

			$chat->setCurrentUser($_SESSION['current_user']);
			$chat->setOtherUser($_SESSION['other_user']);

			$chat->setMessagesFromDatabase();
		}
		catch (Exception $e) {
			$error = $e->getMessage();
		}

		require 'app/views/MessagePage.php';
	}
}