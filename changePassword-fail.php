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
        <a class="username" href="profile.html">jamesParty</a>
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
          <form action="changePassword.php" method="post" id="change-password-form" autocomplete="off">
            <span class="account-error-msg" id="change-password-form-password2-error">Old password does not match</span>
            <label for="change-password-form-password1">change-password-form-password1</label>
            <input type="password" id="change-password-form-oldpassword" value="" name="oldPassword" placeholder="Enter your old password" class="input-field" required>
            <label for="change-password-form-password1">change-password-form-password1</label>
            <input type="password" id="change-password-form-password1" value="" name="newPassword1" placeholder="Enter your new password" class="input-field" required>
            <label for="change-password-form-password2">change-password-form-password2</label>
            <input type="password" id="change-password-form-password2" value="" name="newPassword2" placeholder="Re-enter your new password" class="input-field" required>
            <input type="submit" id="change-password-form-submit" value="Update Password" name="subscribe" class="input-button">
          </form>
        </div>
        <div class="delete-account">
          <button id="delete-account-warning" class="input-button">DELETE ACCOUNT</button>
          <form action="deleteAccount.php" method="post" id="delete-account-form" autocomplete="off" class="delete-account-form">
            <span class="account-error-msg" id="enter-delete-password">&nbsp;</span>
            <input type="password" id="delete-account-form" value="" name="dPassword" placeholder="Enter password to confirm" class="input-field" required>
            <input type="submit" class="input-button" id="change-password-form-oldpassword" value="DELETE" name="oldPassword" placeholder="Enter password to confirm" required>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="public/js/account.js"></script>
  <script type="text/javascript" src="public/js/app.js"></script>
  <!-- Override -->
  <script type="text/javascript" src="public/js/passwordFailOverride.js"></script>
</body>



