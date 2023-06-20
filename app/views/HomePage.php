<!DOCTYPE html>
<html lang='fr'>
<head>
	<meta charset='UTF-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Homepage</title>
</head>
<body>
<div>
    <h1>Homepage</h1>
    <?php if (isset($account)) { ?>

        <p>Your account is <?php echo $account->getUsername();?>, your email is <?php echo $account->getEmail(); ?> and your language is <?php echo $account->getLanguage(); ?></p>

        <a href="matchmaking">Discover !</a>

        <br>
        <br>

        <a href='logout'>Logout</a>

        <br>

        <?php if (isset($friend_list->friends)) { ?>

            <form action='' method='post'>

                <?php foreach ($friend_list->friends as $f_list) {

                    if (!(empty($f_list['user_one']) && empty($f_list['user_two']))) { ?>

                        <ul>
                            <li>

                                <?php if ($f_list['user_one'] === $_SESSION['current_user']) { ?>

                                    <label><?php echo $f_list['user_two']; ?>
                                        <input type='radio' name='friend_name' value="<?php echo $f_list['user_two']; ?>">
                                    </label>

                                <?php } else { ?>

                                    <label><?php echo $f_list['user_one']; ?>
                                        <input type='radio' name='friend_name' value="<?php echo $f_list['user_one']; ?>">
                                    </label>

                                <?php } ?>
                            </li>
                        </ul>
                    <?php }
                } ?>
                <input type="submit" name="submit" value="Message this Friend">
            </form>
        <?php }
    } else { ?>

        <p>You are not connected</p>
        <p><a href="login">Login</a></p>

    <?php } ?>
</div>
</body>
</html>