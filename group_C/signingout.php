<?php 
  
  if(isset($_COOKIE['token']) && isset($_COOKIE['username'])) {
    $db = @mysqli_connect (localhost, "root", "root")
      Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

    @mysqli_select_db($db, "group_c")
      Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");


    $length = rand(50, 60);
    $unencryptedToken = substr(str_shuffle ("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    $encryptedToken = sha1('asjdokasjkdasdnjkanbshdadjnaskdbakhbhabsdkhakjdnakjsndjkasnsad'.$unencryptedToken);

    $res = mysqli_query($db, 'UPDATE users
    SET token = "'.$encryptedToken.'"
    WHERE username = "'.$_COOKIE['username'].'"
    AND token = "'.$_COOKIE['token'].'"'); 


mysqli_close($db);

  }

  if (isset($_COOKIE['token'])) {
    setcookie('token', '', time()-3600);
  }
  if (isset($_COOKIE['username'])) {
    setcookie('username', '', time()-3600);
  }



  header("Location: /group_C/index.php"); /* Redirect browser */
  exit();

?>