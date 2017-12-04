<?php

//if cookie isnt set
if (!isset($_COOKIE['username'])) {
  header("Location: /error.html");
  exit();
}
else{
	//to get cookie name
	$u_name = $_COOKIE['username'];
	
  $db = @mysqli_connect (localhost, "root", "root")
	  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");
	
	@mysqli_select_db($db, "group_c")
	  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");
	
	//query string
	$SQLstring = "SELECT *
	FROM users WHERE username = '$u_name'";

	//get results from db
	$result = mysqli_query($db,$SQLstring);
	$Row = mysqli_fetch_assoc($result);

	//if user isnt admin redirect, else show admin page
	if($Row['admin'] != 1){
		header("Location: /error.html");
  		exit();
	}

	else{
		
		//admin page
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
		      <span class="welcome">Admin Dashboard</span>
		      <hr>
		      <div class="user-admin">
			<span class="section-headers">Users</span>
			<div class="user-actions">
			  <div class="prompt">
			    <label>
			      <span>ID of the <span class="mod-type">user</span> to delete:</span>
			      &nbsp;&nbsp;&nbsp;

			      <input type="text" name="del-user-id" form="delete-user-id" >
			    </label>
			    <form action="/admin.php" method="post" id="delete-user-id">
			      <div class="user-button">
				<button name="type" value = "User" class="delete-button" form ="delete-user-id">
			        Delete
				</button>
			      </div>
			    </form>

			  </div>
			</div>
		      </div>
		      <div class="post-admin">
			<span class="section-headers">Posts</span>
			<div class="post-actions">
			  <div class="prompt">
			    <label>
			      <span>ID of the <span class="mod-type">post</span> to delete:</span>
			      &nbsp;&nbsp;&nbsp;

			      <input type="text" name="del-post-id" form="delete-post-id">
			    </label>
			    <form action="admin.php" method="post" id="delete-post-id">
			      <div class="post-button">
				<button name="type" value="Post" class="delete-button" form="delete-post-id">
			        Delete
				</button>
			      </div>
			    </form>

			  </div>
			</div>
		      </div>
		      <div class="comment-admin">
			<span class="section-headers">Comments</span>
			<div class="comment-actions">
			  <div class="prompt">
			    <label>
			      <span>Enter the ID of the <span class="mod-type">comment</span> to delete:&nbsp;</span>
			      <input type="text" name="del-comment-id" form="delete-comment">
			    </label>
			    <form action="admin.php" method="post" id="delete-comment">
			      <div class="comment-button">
				<button name="type" value= "Comment" class="delete-button" form="delete-comment">
			        Delete
				</button>
			      </div>
			    </form>
			  </div>
			</div>
		      </div>
		    </div>
		  </div>
		  <script type="text/javascript" src="public/js/app.js"></script>
		</body>
		</html>
		');
	}

mysqli_free_result($result);
mysqli_close($db);
}

?>