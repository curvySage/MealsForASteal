<?php

//get type
$type = $_POST['type'];

//get the id value, and set table, and primary key
//to the right values
if($type == 'Post')
{	
	$id = $_POST['del-post-id'];
	$table= "recipes";
	$pk = "recipe_id";
}
else if($type == 'User')
{	
	$id = $_POST['del-user-id'];
	$table = "users";
	$pk = "user_id";

}
else if($type == 'Comment')
{
	$id = $_POST['del-comment-id'];
	$table = "feedback";
	$pk = "feedback_id";
}

$db = @mysqli_connect (localhost, "root", "root")
	  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");
	
	@mysqli_select_db($db, "group_c")
	  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

	//Delete SQl Code  
	$SQlstring = "DELETE
	FROM $table WHERE $pk = $id";

 	$check  = mysqli_query($db, $SQlstring);
	
	//number of lines affected
 	$num = mysqli_affected_rows($db);

	//no lines affected, then redirect to fail page.
 	if($num < 1)
 	{
 	
		if($type == "Post")
		{	
		header("Location: /delete_post_fail.php");
		}
		else if($type == "User")
		{	
		header("Location: /delete_user_fail.php");
		}
		else if($type == "Comment")
		{
		header("Location: /delete_comment_fail.php");
		}
	} 
	else{
		
		echo ('
		<!doctype html>
		<html lang="en">

		<head>
		  <meta charset="UTF-8">
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
		        <!-- <span class="current-page">Home</span>   -->
		      </div>
		    </div>
		    <div class="right-header">
		      <div class="account-selector">
		        <!-- Will need to replace these links later -->
		        <div>
		          <a href="account.php"><img src="public/img/user.svg" alt="account"></a>
		          <a href="addrecipe.html"><img src="public/img/plus.svg" alt="recipe"></a>
		        </div>
		        <a class="username" href="profile.html">Admin</a>
		      </div>
		    </div>
		  </div>

		<div id="content-section">
		  <div class="admin-panel"> 
		  <p> '.$type.' '.$id.' was deleted! </p>
		<a href="/admin_page.php" class="go-home" style= "justify-content: center; background-color: #2595ff;"> Delete More</a>
    	<a href="index.html" class="go-home" style= "justify-content: center;"> Home</a>
		</form>
		</div>
		</div>
	 ');
}

mysqli_free_result($check);
mysqli_close($db);
	?>