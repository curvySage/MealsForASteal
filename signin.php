<?php
// $db = @mysqli_connect (localhost, "abedm001", "Vt564j")

if (isset($_COOKIE['token'])) {
  header("Location: /index.php");
  exit();
}

$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

$_POST['password'] = sha1('asjdokasjkdasdnjkanbshdadjnaskdbakhbhabsdkhakjdnakjsndjkasnsad'.$_POST['password']);

$res = mysqli_query($db, 'SELECT token
FROM users
WHERE username = "'.$_POST['username'].'"
AND password = "'.$_POST['password'].'"'); 

$token;




while ($row = mysqli_fetch_assoc($res)) {
    foreach ($row as $col) {
      $token = $col ;
    }
}

if(isset($token))
{
    setcookie("token", $token, time()+3600);
    setcookie("username", $_POST['username'], time() + 3600);
    mysqli_free_result($res);
    mysqli_close($db);
    header("Location: /index.php"); /* Redirect browser */
    exit();
}

mysqli_free_result($res);
mysqli_close($db);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Meals for a Steal</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="icon" type="image/png" href="public/img/favicon.png" />

  <!-- <meta http-equiv="refresh" content="0; url=/index.php" /> -->
  <!--  -->
</head>

<body>
  <div id="header-section">
    <div class="logo">
      <!-- Will need to replace these links later -->
      <a href="index.html"><img src="public/img/logo.svg" alt="Meals for a Steal logo"></a>
      <div class="header-text">
        <span class="title">Meals for a Steal</span>
        <span class="current-page">Account</span>
      </div>
    </div>
    <div class="right-header">
      <div class="account-selector">
        <!-- Will need to replace these links later -->
        <div>
          <a href="account.php"><img src="public/img/user.svg" alt="account"></a>
          <a href="addrecipe.html"><img src="public/img/plus.svg" alt="recipe"></a>
        </div>
        <a class="username" href="profile.html">jamesParty</a>
      </div>
    </div>
  </div>
  <div id="content-section">
    <div class="account-options">
      <div class="sign-in">
        <form action="signin.php" method="post" id="sign-in-form" autocomplete="off">
          <span class="account-error-msg" id="sign-in-form-error">Username and Password combination not valid.</span>
          <label for="sign-in-form-username">sign-in-form-username</label>
          <input id="sign-in-form-username" value="" name="username" placeholder="Enter your username" class="input-field" required>
          <label for="sign-in-form-password">sign-in-form-password</label>
          <input id="sign-in-form-password" type="password" value="" name="password" placeholder="Enter your password" class="input-field" required>
          <input id="sign-in-form-submit" type="submit" value="Sign In" name="subscribe" class="input-button">
        </form>
      </div>
      <div class="sign-up">
        <form action="/signup" method="post" id="sign-up-form" autocomplete="off">
          <span class="account-error-msg" id="sign-up-form-error">&nbsp;</span>
          <label for="sign-up-form-username">sign-up-form-username</label>
          <input id="sign-up-form-username" value="" name="username" placeholder="Enter your username" class="input-field" required>
          <label for="sign-up-form-password1">sign-up-form-password1</label>
          <input type="password" id="sign-up-form-password1" value="" name="password" placeholder="Enter your password" class="input-field" required>
          <label for="sign-up-form-password2">sign-up-form-password2</label>
          <input type="password" id="sign-up-form-password2" value="" name="password" placeholder="Re-enter your password" class="input-field" required>
          <input type="submit" id="sign-up-form-submit" value="Sign Up" name="subscribe" class="input-button">
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="public/js/account.js"></script>
  <script type="text/javascript" src="public/js/app.js"></script>
</body>