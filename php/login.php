<?php
include_once 'config.php';
include_once 'mysql.php';

session_start();
if (isset($_POST['submit'])) {
	// Set the posted data from the form into local variables
	$username = clean_input($_POST['username']);
	$password = clean_input($_POST['password']);

	switch ($_POST['submit']) {
		case 'login':
			$result = mysql_query($db, "SELECT * FROM ACCOUNTS WHERE login='$username' AND password='$password'");

			var_export($result);exit;
			if ($usname == $dbUsname && $paswd == $dbPassword) {
			// Set session 
			$_SESSION['username'] = $usname;
			$_SESSION['id'] = $uid;
			// Now direct to users feed
			header("Location: user.php");
			} else {
				echo "<h2 class=error>incorrect username or password combination.
				<br /> Please try again.</h2>";
			}
		break;
		case 'create':

		break;
		// Check if the username and the password they entered was correct

	}
}
?>