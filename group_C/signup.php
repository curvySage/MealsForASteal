<?php

if (isset($_COOKIE['token']) || $_POST['password1'] == "" || $_POST['password2'] == "" || $_POST['username'] == "" || ($_POST['password1'] != $_POST['password2'])) {
  header("Location: /group_C/error.html");
  exit();
}

$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");


$check = mysqli_query($db, 'SELECT username
FROM users
WHERE username = "'.$_POST['username'].'"'); 

if ($check->num_rows > 0) {
  mysqli_free_result($check);
  mysqli_close($db);
  header("Location: /group_C/signup-fail.php");
  exit();
}

$_POST['password1'] = sha1('asjdokasjkdasdnjkanbshdadjnaskdbakhbhabsdkhakjdnakjsndjkasnsad'.$_POST['password1']);
unset($_POST['password2']);

$length = rand(50, 60);
$unencryptedToken = substr(str_shuffle ("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$encryptedToken = sha1('asjdokasjkdasdnjkanbshdadjnaskdbakhbhabsdkhakjdnakjsndjkasnsad'.$unencryptedToken);

$insert = mysqli_query($db, 'INSERT INTO users
(token, password, username, created, admin)
VALUES ("'.$encryptedToken.'", "'.$_POST['password1'].'", "'.$_POST['username'].'", "'.time().'", 1)'); 


$token = $encryptedToken;

if(isset($token))
{
    setcookie("token", $token, time()+3600);
    setcookie("username", $_POST['username'], time() + 3600);
    mysqli_close($db);
    header("Location: /group_C/index.php");
    exit();
}

mysqli_free_result($res);
mysqli_close($db);

?>