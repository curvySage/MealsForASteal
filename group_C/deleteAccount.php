<?php

	$db = @mysqli_connect (localhost, "root", "root")
	  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

	@mysqli_select_db($db, "group_c")
	  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

	$_POST['dPassword'] = sha1('asjdokasjkdasdnjkanbshdadjnaskdbakhbhabsdkhakjdnakjsndjkasnsad'.$_POST['dPassword']);

	$check = mysqli_query($db, 'SELECT username
	FROM users WHERE password = "'.$_POST['dPassword'].'"
	AND username = "'.$_COOKIE['username'].'"
	AND token = "'.$_COOKIE['token'].'"'); 

	if ($check->num_rows == 0) {
		header("Location: /group_C/deleteAccount-fail.php"); /* Redirect browser */
		exit();
	}

	$res = mysqli_query($db, 'DELETE FROM users
	WHERE username = "'.$_COOKIE['username'].'"
	AND token = "'.$_COOKIE['token'].'"
	AND password = "'.$_POST['dPassword'].'"'); 

	mysqli_free_result($res);
	mysqli_close($db);

	if (isset($_COOKIE['token'])) {
	  setcookie('token', '', time()-3600);
	}
	if (isset($_COOKIE['username'])) {
	  setcookie('username', '', time()-3600);
	}

	header("Location: /group_C/sorry_to_see_you_go.html"); /* Redirect browser */
	exit();

?>
