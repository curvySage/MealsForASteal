<?php

if (isset($_COOKIE['token'])) {
  header("Location: /group_C/index.php");
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
    header("Location: /group_C/index.php"); /* Redirect browser */
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
  <title>Meals for a Steal - Signing</title>
  <link rel="stylesheet" href="/group_C/public/css/styles.css">
  <link rel="icon" type="image/png" href="/group_C/public/img/favicon.png" />

  <!-- <meta http-equiv="refresh" content="0; url=/index.php" /> -->
  <!--  -->
</head>

<body>
  <div id="header-section">
    <div class="logo">
      
      <a href="index.php"><img src="/group_C/public/img/logo.svg" alt="Meals for a Steal logo"></a>
      <div class="header-text">
        <span class="title">Meals for a Steal</span>
        <span class="current-page">Account</span>
      </div>
    </div>
    <div class="right-header">
      <div class="account-selector">
        
        <div>
          <a href="account.php"><img src="/group_C/public/img/menu.svg" alt="account"></a>
          <a href="addrecipe.php"><img src="/group_C/public/img/plus.svg" alt="recipe"></a>
        </div>
        <?php

          $db = @mysqli_connect (localhost, "root", "root")
            Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");
  
          @mysqli_select_db($db, "group_c")
            Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

          // check if logged in user is still good

          $is_logged_in = mysqli_query($db, 'SELECT *
          FROM users WHERE
          username = "'.$_COOKIE['username'].'"
          AND token = "'.$_COOKIE['token'].'"'); 

          $ro = mysqli_fetch_assoc($is_logged_in);
          $user_id = $ro['user_id'];


          if ($is_logged_in->num_rows != 0) {
            echo '<a class="username" href="profile.php?username='.$_COOKIE['username'].'">'.$_COOKIE['username'].'</a>';
          } else {
            echo '<span class="username" >Not logged in</span>';
          }

        ?>
      </div>
    </div>
  </div>
  <div id="content-section">
    <div class="account-options">
      <div class="sign-in">
        <form action="/group_C/signin.php" method="post" id="sign-in-form" autocomplete="off">
          <span class="account-error-msg" id="sign-in-form-error">Username and Password combination not valid.</span>
          <input id="sign-in-form-username" value="" name="username" placeholder="Enter your username" class="input-field" required>
          <input id="sign-in-form-password" type="password" value="" name="password" placeholder="Enter your password" class="input-field" required>
          <input id="sign-in-form-submit" type="submit" value="Sign In" name="subscribe" class="input-button">
        </form>
      </div>
      <div class="sign-up">
        <form action="/group_C/signup.php" method="post" id="sign-up-form" autocomplete="off">
          <span class="account-error-msg" id="sign-up-form-error">&nbsp;</span>
          <input id="sign-up-form-username" value="" name="username" placeholder="Enter your username" class="input-field" required>
          <input type="password" id="sign-up-form-password1" value="" name="password1" placeholder="Enter your password" class="input-field" required>
          <input type="password" id="sign-up-form-password2" value="" name="password2" placeholder="Re-enter your password" class="input-field" required>
          <input type="submit" id="sign-up-form-submit" value="Sign Up" name="subscribe" class="input-button">
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/group_C/public/js/account.js"></script>
  <script type="text/javascript" src="/group_C/public/js/app.js"></script>
</body>