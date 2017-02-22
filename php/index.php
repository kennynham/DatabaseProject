<?php
# Site login and prompt for user login or creation.
# 
# User must do 1 of these to actions.
# include config for db and mysql sanitize.
include 'config.php';
include 'mysql.php';

if (isset($_POST['submit'])) {
	# Set the posted data from the form into local variables
	$username = clean_input($db, $_POST['username']);
	$password = clean_input($db, $_POST['password']);

	# switch case for form submission depending
	# on create or login flag.
	switch ($_POST['submit']) {
		case 'login': // Block for login
			$result = mysqli_query($db, "SELECT * FROM ACCOUNTS WHERE login='$username' AND password='$password'");
			$user   = mysqli_fetch_array($result, MYSQLI_ASSOC);

			# since we already compared login and password
			# in mysql, if $user !false then we obatined acocunt.
			if (!empty($user)) {
				# Set session user and route to landing page
				$_SESSION['user'] = $user;
				header("Location: user.php");
			} else {
				echo "<h2 class=error>Incorrect username or password combination. <br/> Please try again.</h2>";
			}
		break;
		case 'create': // block for creating a new account
			foreach ($_POST as $k => $v) { $$k = $v; } // create variables from $_POST

			// Check to see if a user exists
			$result = mysqli_query($db, "SELECT * FROM ACCOUNTS WHERE login='$username' AND password='$password'");
			if (!empty(mysqli_num_rows($result))) {
				# if account exists, notify and exit to page.
				echo "<h2 class=error>User account exists. <br/> Please try again.</h2>";
				break;
			}

			# when we are inserting a new account, we want two fields to use the default values.
			# the user_id is autoincrement, so we use the default here.
			# also, date_joined is set to current_timestamp, which is created in mysql.
			if ($result = mysqli_query($db, "INSERT INTO ACCOUNTS (user_id, firstname, lastname, " .
               						"email, login, password, date_joined) VALUES(DEFAULT,'$firstname'," .
               						"'$lastname','$email','$username','$password',DEFAULT)")) {

				# Set session and route to landing page
				$user = mysqli_query($db, "SELECT * FROM ACCOUNTS WHERE login='$username'");
				$_SESSION['user'] = mysqli_fetch_assoc($user);
				header("Location: user.php");
			} else {
				# if we have an error, tell them.
				echo "<h2 class=error>Unable to create account. <br/> Please try again.</h2>";
			}
		break;
		default:
			echo "<h2 class=error>Internal Server Error 500</h2>";
		break;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ImgRepo</title>
<link rel="stylesheet" type="text/css" href="/css/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>
<body>
<header>
	<img src="/img/logo.png"/>
	<div class="userbox"><i class="fa fa-user" aria-hidden="true"></i></div>
</header>
<div class="wrapper">
	<div class="forms">
		<h2>Please Login</h2>
		<div class="choices"><label data-toggle='login'>Login</label><label data-toggle='create'>Create</label></div>

		<form class="login" action="index.php" method="post">
			<label><input type="text" name="username" placeholder="Username" required></label>
			<label><input type="password" name="password" placeholder="Password" required></label>
			<label><input type="submit" value="login" name="submit"></label>
		</form>

		<form class="create" action="index.php" method="post">
			<label><input type="text" name="username" placeholder="Username" required></label>
			<label><input type="password" name="password" placeholder="Password" required></label>
			<label><input type="email" name="email" placeholder="Email" required></label>
			<label><input type="text" name="firstname" placeholder="First Name" required></label>
			<label><input type="text" name="lastname" placeholder="Last Name" required></label>
			<label><input type="submit" value="create" name="submit"></label>
		</form>
	</div>
</div>
<footer style="position: fixed;bottom: 0;">	
</footer>
</body>
<script>
	$(".choices label").click(function() {
		var dropDown = $(this).attr('data-toggle');

		$(".choices label").removeClass("active");
		$(this).addClass("active");

		if (dropDown == 'login') {
			$(".create").slideUp();
			$(".login").delay('300').slideDown();
		} else {
			$(".login").slideUp();
			$(".create").delay('300').slideDown();
		}
	});
</script>
</html>