<?php

$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

$check = mysqli_query($db, 'SELECT user_id
FROM users WHERE 
token = "'.$_COOKIE['token'].'"'); 

if ($check->num_rows == 0 || $_POST['comment'] == "" || !isset($_POST['comment'])) {
	header("Location: /group_C/error.html"); /* Redirect browser */
	exit();
}

$ro = $check;
$ro = mysqli_fetch_assoc($check);
$user_id = $ro['user_id'];

$res = mysqli_query($db, 
  'INSERT INTO feedback
    (user_id, recipe_id, comment, created, type)
    VALUES('.$user_id.', '.$_REQUEST['recipe_id'].', "'.$_POST['comment'].'", '.time().', "c")');






mysqli_free_result($res);
mysqli_close($db);

if (isset($_COOKIE['token'])) {
    header("Location: /group_C/recipe.php?recipe_id=".$_REQUEST['recipe_id']);
    exit();
    }
?>
