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



if ($is_logged_in->num_rows == 0) {
  header("Location: /group_C/error.html"); /* Redirect browser */
  exit();
} 

$user_id = $ro['user_id'];

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Meals for a Steal - Settings</title>
  <link rel="stylesheet" href="/group_C/public/css/styles.css">
  <link rel="icon" type="image/png" href="/group_C/public/img/favicon.png" />
</head>

<body>
  <div id="header-section">
    <div class="logo">
      
      <a href="index.php"><img src="/group_C/public/img/logo.svg" alt="Meals for a Steal logo"></a>
      <div class="header-text">
        <span class="title">Meals for a Steal</span>
        <span class="current-page">Settings</span>
      </div>
    </div>
    <div class="right-header">
      <div class="account-selector">
        
        <div>
          <a href="account.php"><img src="/group_C/public/img/menu.svg" alt="account"></a>
          <a href="addrecipe.php"><img src="/group_C/public/img/plus.svg" alt="recipe"></a>
        </div>
        <?php

          // check if logged in user is still good
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
      <div class="sign-out">
        <button class="input-button" onClick="location.href='signingout.php'">Sign Out</button>
      </div>
      <div class="account-settings">
        <button id="change-password-button" class="input-button">Change Password</button>
        <div id="change-password-div" class="change-password">  
          <form action="/group_C/changePassword.php" method="post" id="change-password-form" autocomplete="off">
            <span class="account-error-msg" id="change-password-form-password2-error">&nbsp;</span>
            <input type="password" id="change-password-form-oldpassword" value="" name="oldPassword" placeholder="Enter your old password" class="input-field" required>
            <input type="password" id="change-password-form-password1" value="" name="newPassword1" placeholder="Enter your new password" class="input-field" required>
            <input type="password" id="change-password-form-password2" value="" name="newPassword2" placeholder="Re-enter your new password" class="input-field" required>
            <input type="submit" id="change-password-form-submit" value="Update Password" name="subscribe" class="input-button">
          </form>
        </div>
        <div class="delete-account">
          <button id="delete-account-warning" class="input-button">DELETE ACCOUNT</button>
          <form style="display:none;" action="/group_C/deleteAccount.php" method="post" id="delete-account-form" autocomplete="off" class="delete-account-form">
            <span class="account-error-msg" id="enter-delete-password">&nbsp;</span>
            <input type="password" id="delete-account-form" value="" name="dPassword" placeholder="Enter password to confirm" class="input-field" required>
            <input type="submit" class="input-button" id="change-password-form-oldpassword" value="DELETE" name="oldPassword" placeholder="Enter password to confirm" required>
          </form>
          <?php
          $u_token = $_COOKIE['token'];

          $SQLstring = "SELECT *
            FROM users WHERE token = '$u_token'";
            //get results from db
          $result = mysqli_query($db,$SQLstring);
          $Row = mysqli_fetch_assoc($result);

            //if user is admin show button
            if($Row['admin'] == 0){
             echo (' <a href="/group_C/admin_page.php" class="admin-panel-entrance"> Admin Page</a> ');
            }
        ?>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/group_C/public/js/account.js"></script>
  <script type="text/javascript" src="/group_C/public/js/app.js"></script>
</body>


