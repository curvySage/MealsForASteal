<?php

//echo "Recipe id : " . $_GET['recipe_id'];
//^works

$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

// Get recipe info:
//     recipe_id, title, ingredients, description, created, user_id, image
$q = 'SELECT *
      FROM recipes
      WHERE recipe_id = "' .$_GET['recipe_id']. '"';

$result = mysqli_query($db, $q);
$recipeRow = mysqli_fetch_assoc($result);
mysqli_free_result($result);

$created = date("m\/d\/Y g:iA", $recipeRow['created']);

//echo "title : " .$recipeRow['title'];
//^works

// Get votes for recipe:
$q = 'SELECT SUM(vote)
      FROM feedback
      WHERE type = "v"
      AND recipe_id = "' .$_GET['recipe_id']. '"';

$result = mysqli_query($db, $q);
$voteRow = mysqli_fetch_row($result);

  if(is_null($voteRow[0])){
     $votes = 0;
  }else{
     $votes = $voteRow[0];
  }

mysqli_free_result($result);

$q = 'SELECT username
      FROM users, recipes
      WHERE users.user_id = recipes.user_id
      	    AND recipe_id = "' .$_GET['recipe_id']. '"';

$result = mysqli_query($db, $q);
$row = mysqli_fetch_row($result);
$username = $row[0];

mysqli_close($db);
?>

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
        <a class="username" href="profile.html">jamesParty</a>
      </div>
    </div>
  </div>
  <div id="content-section">
    <!-- Stuff goes here -->
    <div class="recipe-posting">
      <div class="recipe-header">
        <div class="votes">
          <img src="public/img/voting/upvote-not-selected.svg" alt="upvote" id = "recUp" onclick = "up(this.id);">
          <span class="score"><?=$votes?></span>
          <img src="public/img/voting/downvote-not-selected.svg" alt="downvote" id = "recDown" onclick = "down(this.id);">
        </div>
        <div class="posting-details">
          <span class="food-title"><?=$recipeRow['title']?></span>
          <span class="date"><?=$created?></span>
          <a class="author" href="profile.html"><?=$username?></a>
        </div>
      </div>
      <img class="finished-food" src="<?=$recipeRow['image']?>" alt="user submitted food">
      <div class="recipe-details">
        <div class="recipe-ingredients">
          <span class="detail-title">Ingredients</span>
          <ul>
	    <?php
	      $ingredients = explode(',',$recipeRow['ingredients']);

	      foreach ($ingredients as $ingredient) {
	         echo '<li>' .$ingredient. '</li>';
	      }
	    ?>
          </ul>
        </div>
        <div class="recipe-instructions">
          <span class="detail-title">Instructions</span>
          <p><?=$recipeRow['description']?></p>
        </div>
      </div>
      <div class="comments">
        <span class="comments-title">Comments</span>
        <!-- Need to replace with link to profiles -->
        <p><a class="author" href="XXXXXX">TokyoChef</a><span class="comment-date"> &nbsp; 18 minutes ago</span><span class="comment-id"> &nbsp; id:1</span>
          <br>Great recipe! I especially liked the mixture of the flour and sugar! </p>
        <p><a class="author" href="XXXXXX">MaestroEater</a><span class="comment-date"> &nbsp; 1 hour ago</span><span class="comment-id"> &nbsp; id:2</span>
          <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p><a class="author" href="XXXXXX">PoorCollegeStudent1988</a><span class="comment-date"> &nbsp; 2 hours ago</span><span class="comment-id"> &nbsp; id:3</span>
          <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
      <div class="add-comment">
        <span class="add-comment-title">Comment:</span>
        <textarea class="add-comment-box" id="comment" placeholder="comment" title="comment"></textarea>
        <button class = "post-comment-button" id="post-comment">Post Comment</button>
      </div>
    </div>
  </div>
  <script src="public/js/app.js"></script>
</body>

</html>
