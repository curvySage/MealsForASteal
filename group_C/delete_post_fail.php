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
?>
		<!doctype html>
		<html lang="en">

		<head>
		  <meta charset="UTF-8">
		  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		  <title>Meals for a Steal - Admin Panel</title>
		  <link rel="stylesheet" href="/group_C/public/css/styles.css">
		  <link rel="icon" type="image/png" href="/group_C/public/img/favicon.png" />
		</head>

		<body>
		  <div id="header-section">
		    <div class="logo">
		      
		      <a href="index.php"><img src="/group_C/public/img/logo.svg" alt="Meals for a Steal logo"></a>
		      <div class="header-text">
		        <span class="title">Meals for a Steal</span>
		        <span class="current-page">Admin Panel</span>
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
          echo('
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
			    <form action="/group_C/admin.php" method="post" id="delete-user-id">
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
				<span class="admin-error-msg">ID was not found in Database. Try Again!</span>
			      <input type="text" name="del-post-id" form="delete-post-id">
			    </label>
			    <form action="/group_C/admin.php" method="post" id="delete-post-id">
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
			    <form action="/group_C/admin.php" method="post" id="delete-comment">
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
		  <script type="text/javascript" src="/group_C/public/js/app.js"></script>
		</body>
		</html>
		');
	
mysqli_free_result($result);
mysqli_close($db);

?>