<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
} ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset='UTF-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Message</title>
</head>
<body>
<div>
    <h1>You are speaking with <?php echo $_SESSION['other_user'] ?></h1>
	<?php
    if (!empty($error)) echo '<p>' . $error . '</p>';

    if (isset($chat->messages)) {
	    foreach ($chat->messages as $message) {
            if (!(empty($message['content']) && empty($message['sender']))) {
                ?>
                <div>
                    <?php if ($message['sender'] === $_SESSION['other_user']) { ?>
                    <p id="left">
                        <?php } else { ?>
                    <p id="right">
                        <?php } ?>
                        <?= $message['content'] ?>
                    </p>
                </div>
                <?php
            }
            else {
                echo '<p>Nothing here.<br>Send the first message !</p>';
            }
        }
    } ?>
    <form action='' method='post'>
        <label>Send a new message:
            <input type='text' name='content' placeholder='Message'>
        </label>
        <input type='submit' value='Send'>
    </form>
</div>
</body>
</html>