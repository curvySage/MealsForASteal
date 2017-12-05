<?php

//if cookie isnt set
if (!isset($_COOKIE['token'])) {
  header("Location: /group_C/error.html");
  exit();
}
//to get cookie name
$u_name = $_COOKIE['username'];

$db = @mysqli_connect (localhost, "root", "root")
	Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

//query string
$SQLstring = "SELECT admin
FROM users WHERE token = '".$_COOKIE['token']."' AND admin = 0;";

//get results from db
$result = mysqli_query($db, $SQLstring);

//if user isnt admin redirect, else show admin page
if($result->num_rows == 0){
	header("Location: /group_C/error.html");
	exit();
}

$check;
$num;

//get type
$type = $_POST['type'];

//get the id value, and set table, and primary key
//to the right values
if($type == 'Post')
{	
	$id = $_POST['del-post-id'];
	$table= "Recipes";
	$pk = "recipe_id";
	$SQlstring2 = "DELETE
	FROM recipes WHERE recipe_id = ".$id.";";
	// mysqli_query($db, $SQlstring1);
	$check = mysqli_query($db, $SQlstring2);
 	$num = mysqli_affected_rows($db);
 	$r_id = $id;
}
else if($type == 'User')
{	
	$r_id = $_POST['del-user-id'];
	$table = "Users";
	$SQlstring1 = "SELECT user_id from users WHERE username='".$r_id."';";
	$get_r_id = mysqli_query($db, $SQlstring1);
	$get_r_id_row = mysqli_fetch_assoc($get_r_id);
	$id = $get_r_id_row ['user_id'];
	$SQlstring4 = "DELETE FROM users WHERE user_id = ".$id.";";
	$check = mysqli_query($db, $SQlstring4);
	$num = mysqli_affected_rows($db);


}
else if($type == 'Comment')
{
	$id = $_POST['del-comment-id'];
	$table = "Feedback";
	$SQlstring = "DELETE from feedback WHERE feedback_id=".$id.";";
	$check = mysqli_query($db, $SQlstring);
	$num = mysqli_affected_rows($db);
	$r_id = $id;
}


 	if($num <= 0)
 	{
 	
		if($type == "Post") {	
			header("Location: /group_C/delete_post_fail.php");
			exit();
		}
		else if($type == "User") {
			header("Location: /group_C/delete_user_fail.php");
			exit();
		}
		else if($type == "Comment") {
			header("Location: /group_C/delete_comment_fail.php");
			exit();
		}
	} 
	?>
		<!doctype html>
		<html lang="en">

		<head>
		  <meta charset="UTF-8">
		  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		  <title>Meals for a Steal - Admin</title>
		  <link rel="stylesheet" href="/group_C/public/css/styles.css">
		  <link rel="icon" type="image/png" href="/group_C/public/img/favicon.png" />
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

				  mysqli_free_result($check);
				  mysqli_close($db);
				  ?>
		      </div>
		    </div>
		  </div>

		<div id="content-section">
		  <div class="admin-panel"> 
		  <p> <?php echo $type.' '.$r_id.' was deleted!'; ?> </p>
		<a href="/group_C/admin_page.php" class="go-home" style= "justify-content: center; background-color: #2595ff;"> Admin Page</a>
    	<a href="index.php" class="go-home" style= "justify-content: center;"> Home</a>
		</div>
	</div>
