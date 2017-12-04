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
	  <!-- Will need to replace these links later -->
          <div>
	    <a href="account.php"><img src="public/img/user.svg" alt="account"></a>
            <a href="addrecipeform.php"><img src="public/img/plus.svg" alt="recipe"></a>
          </div>
          <a class="username" href="profile.html?user_id=<?=$userID?>"><?=$_COOKIE['username']?></a>
      </div>
    </div>
  </div>
  
  <div id="content-section">
    <!-- Stuff goes here -->
    <form action="/createrecipe.php" method="post" id="add-recipe" class="add-recipe-form" enctype="multipart/form-data">
      <div class="add-title">
        <label for="title">Title:
	  <br/><span class="add-recipe-form-errors" id="title-error">&nbsp;</span>	
	  <br/><input type="text" value="" placeholder="Title" class="title-input" title="title" name="title" id="title" />
	</label>
      </div>
      <input type="file" id="image" name="image" accept="image/*" />
      <div class="add-photo-preview">
	<label for="image">
          <img src="public/img/addphoto.svg" alt="add photo" id = "photo"/>
	</label>
      </div>
      <div class="add-ingredients">
        <label for="ingredients">Ingredients:
 	  <br/><span class="add-recipe-form-errors" id="ingredient-error">&nbsp;</span>
          <br/><textarea type="text" value="" placeholder="Amount & Ingredient (separated by commas)" id="ingredients" name="ingredients" title="amount and ingredient"></textarea>  
	</label>
      </div>
      <div class="add-instructions">
        <label for="instructions">Instructions:
	  <br/><span class="add-recipe-form-errors" id="instruction-error">&nbsp;</span>
	  <br/><textarea  placeholder="Add instructions" title="add instructions" id="instructions" name="instructions"></textarea>
	</label>
      </div>
      <div class="buttons">
        <input type="submit" id="submit-btn" value="Add" class="add-button" />
        <input type="reset" value="Clear" class="clear-button" onclick="clearAll();"/>
      </div>
      <script src="public/js/addrecipe.js"></script>
    </form>
  </div>
</body>
</html>
