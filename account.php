<?php 
  if (isset($_COOKIE['token'])) {
    header("Location: /settings.php");
    exit();
  }

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Meals for a Steal</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="icon" type="image/png" href="public/img/favicon.png" />
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
        <form action="/signin.php" method="post" id="sign-in-form" autocomplete="off">
          <span class="account-error-msg" id="sign-in-form-error">&nbsp;</span>
          <input id="sign-in-form-username" value="" name="username" placeholder="Enter your username" class="input-field" required>
          <input id="sign-in-form-password" type="password" value="" name="password" placeholder="Enter your password" class="input-field" required>
          <input id="sign-in-form-submit" type="submit" value="Sign In" name="subscribe" class="input-button">
        </form>
      </div>
      <div class="sign-up">
        <form action="/signup.php" method="post" id="sign-up-form" autocomplete="off">
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
  <script type="text/javascript" src="public/js/signin.js"></script>
  <script type="text/javascript" src="public/js/app.js"></script>
</body>