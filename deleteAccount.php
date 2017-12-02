<?php

$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

$_POST['dPassword'] = sha1('asjdokasjkdasdnjkanbshdadjnaskdbakhbhabsdkhakjdnakjsndjkasnsad'.$_POST['dPassword']);
unset($_POST['newPassword2']);

$res = mysqli_query($db, 'UPDATE users
SET password = "'.$_POST['newPassword1'].'"
WHERE username = "'.$_COOKIE['username'].'"
AND token = "'.$_COOKIE['token'].'"
AND password = "'.$_POST['oldPassword'].'"'); 


mysqli_free_result($res);
mysqli_close($db);

if (isset($_COOKIE['token'])) {
  setcookie('token', '', time()-3600);
}
if (isset($_COOKIE['username'])) {
  setcookie('username', '', time()-3600);
}

  header("Location: /account.php"); /* Redirect browser */
  exit();

?>
