<?php
  if(!isset($_COOKIE['token'])) {
    header("Location: /group_C/account.php");
    exit();
  }
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Meals for a Steal - Add</title>
  <link rel="stylesheet" href="/group_C/public/css/styles.css">
  <link rel="icon" type="image/png" href="/group_C/public/img/favicon.png" />
</head>

<body>
  <div id="header-section">
    <div class="logo">
      <a href="index.php"><img src="/group_C/public/img/logo.svg" alt="Meals for a Steal logo"></a>
      <div class="header-text">
        <span class="title">Meals for a Steal</span>
        <span class="current-page">Add Recipe</span>
      </div>
    </div>
    <div class="right-header">
      <div class="account-selector">
	<?php
	  if(isset($_COOKIE['username'])){
	    $db = @mysqli_connect (localhost, "root", "root")
	    Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

	    @mysqli_select_db($db, "group_c")
	    Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

	    $q = 'SELECT user_id
	          FROM users
	          WHERE username ="'.$_COOKIE['username'].'"';

	    $result = mysqli_query($db, $q);
            $userIDRow = mysqli_fetch_row($result);
	    $userID = $userIDRow[0];
	  }
	  ?>
	  
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
           ?>
      </div>
    </div>
  </div>
  
  <div id="content-section">
    
    <form action="/group_C/createrecipe.php" method="post" id="add-recipe" class="add-recipe-form">
      <div class="add-title">
        <label for="title">Title*
    	  <br/><span class="add-recipe-form-errors" id="title-error">&nbsp;</span>	
    	  <br/><input type="text" value="" autocomplete="off" placeholder="Title" class="title-input" title="title" name="title" id="title" />
    	</label>
      </div>


      <div class="add-title">
        <label for="title">Image
    <br/><!-- <span class="add-recipe-form-errors" id="title-error">&nbsp;</span>   -->
    <br/><input type="text" value="" autocomplete="off" placeholder="Image URL" class="title-input" title="title" name="image" id="image" />
  </label>
      </div>


      <!-- <input type="file" id="image" name="image" accept="image/*" /> -->
      <!-- <div class="add-photo-preview"> -->
	<!-- <label for="image"> -->
          <!-- <img src="/group_C/public/img/addphoto.svg" alt="add photo" id = "photo"/> -->
	<!-- </label> -->
      <!-- </div> -->

      <div class="add-ingredients">
        <label for="ingredients">Ingredients*
 	      <br/><span class="add-recipe-form-errors" id="ingredient-error">&nbsp;</span>
          <br/><textarea type="text" value="" placeholder="Amount & Ingredient (separated by commas)" id="ingredients" name="ingredients" title="amount and ingredient"></textarea>  
	   </label>
      </div>
      <div class="add-instructions">
        <label for="instructions">Instructions*
	  <br/><span class="add-recipe-form-errors" id="instruction-error">&nbsp;</span>
	  <br/><textarea  placeholder="Add instructions" title="add instructions" id="instructions" name="instructions"></textarea>
	   </label>
      </div>
      <div class="buttons">
        <input type="submit" id="submit-btn" value="Add" class="add-button" />
        <input type="reset" value="Clear" class="clear-button" onclick="clearAll();"/>
      </div>
      <script src="/group_C/public/js/addrecipe.js"></script>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
