<?php
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

// Format date stored in db
$created = date("m\/d\/Y g:iA", $recipeRow['created']);

// Get votes for recipe:
$q = 'SELECT SUM(vote)
      FROM feedback
      WHERE type = "v"
      AND recipe_id = "' .$_GET['recipe_id']. '"';

$result = mysqli_query($db, $q);
$voteRow = mysqli_fetch_row($result);
$votes = $voteRow[0];

mysqli_free_result($result);

$q = 'SELECT username
      FROM users, recipes
      WHERE users.user_id = recipes.user_id
      	    AND recipe_id = "' .$_GET['recipe_id']. '"';

$result = mysqli_query($db, $q);
$row = mysqli_fetch_row($result);


$username = $row[0];



$q = 'SELECT feedback_id, user_id, comment, created
      FROM feedback
      WHERE recipe_id = '.$_GET['recipe_id'].'
      AND type = "c";';

$comments = mysqli_query($db, $q);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Meals for a Steal - Recipe</title>
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
         <div>
             <a href="account.php"><img src="public/img/user.svg" alt="account"></a>
            <a href="addrecipeform.php"><img src="public/img/plus.svg" alt="recipe"></a>
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
    <!-- Stuff goes here -->
    <div class="recipe-posting">
      <div class="recipe-header">
        

        <div class="votes">

        <?php
              $vote_status_q = mysqli_query($db,
                "SELECT vote FROM feedback where user_id = ".$user_id." and recipe_id = ".$_GET['recipe_id'].";");

              $ro = mysqli_fetch_assoc($vote_status_q);
              $vote = $ro['vote'];
              
              if ((!isset($vote) || $vote == 0) && isset($_COOKIE['token'])) {
                echo '
                  <img id="rep_up_'.$_GET['recipe_id'].'" class="upvote-button" src="public/img/voting/upvote-not-selected.svg" alt="upvote">
                  <span class="score">'.$votes.'</span>
                  <img id="rep_down_'.$_GET['recipe_id'].'" class="downvote-button" src="public/img/voting/downvote-not-selected.svg" alt="downvote">
                ';
              } else 

              if ($vote == 1 && isset($_COOKIE['token'])) {
               echo '
                  <img id="rep_up_'.$_GET['recipe_id'].'" class="upvote-button" src="public/img/voting/upvote-selected.svg" alt="upvote">
                  <span class="score">'.$votes.'</span>
                  <img id="rep_down_'.$_GET['recipe_id'].'" class="downvote-button" src="public/img/voting/downvote-not-selected.svg" alt="downvote">
                '; 
              } else 

              if ($vote == -1 && isset($_COOKIE['token'])) {
                echo '
                  <img id="rep_up_'.$_GET['recipe_id'].'" class="upvote-button" src="public/img/voting/upvote-not-selected.svg" alt="upvote">
                  
                  <img id="rep_down_'.$_GET['recipe_id'].'" class="downvote-button" src="public/img/voting/downvote-selected.svg" alt="downvote">
                ';
              } else {
                echo '<span class="score">'.$votes.'</span>';
              }

        ?>
        </div>







        <div class="posting-details">
          <span class="food-title"><?=$recipeRow['title']?></span>
          <span class="date"><?=$created?></span>
          <?php echo '<a class="author" href="profile.php?username='.$username.'">'.$username.'</a>'; ?>
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
        <?php
        if ($comments->num_rows == 0) {
          echo "<h4>No Comments</h4>";
        } else {
          while ($row = mysqli_fetch_assoc($comments)) {
            $comment_created = gmdate("m/d/Y H:i", ($row['created']- 8 * 60 * 60));
            $comment_username_q = mysqli_query($db,
                "SELECT username FROM users where user_id = ".$row['user_id'].";");

            $ro = mysqli_fetch_assoc($comment_username_q);
            $comment_username = $ro['username'];

            echo '
              <p><a class="author" href="profile.php?username='.$comment_username.'">'.$comment_username.'</a><span class="comment-date"> &nbsp; '.$comment_created.'</span><span class="comment-id"> &nbsp; id:'.$row["feedback_id"].'</span>
              <br>'.$row['comment'].'</p>
            ';

          }

        }
        ?>
      </div>
      <div class="add-comment">
      <?php

        if (isset($_COOKIE['token'])) {
          echo '
            <span id=post-comment-error>&nbsp;</span>
            <form class="add-comment" action="comment.php?recipe_id='.$_GET["recipe_id"].'" method="post" autocomplete="off">
              <span class="add-comment-title">Comment:</span>
              <textarea class="add-comment-box" id="comment" placeholder="comment" name="comment" title="comment"></textarea>
              <button class="post-comment-button" id="post-comment" value="Post Comment">Post Comment</button>
            </form>
            <script src="public/js/comment.js"></script>
            ';  
        }
      ?>
      </div>

    </div>
  </div>
  <span style="display:none;" id="recipe_id"><?php echo $_GET['recipe_id'];?></span>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="public/js/app.js"></script>
</body>

</html>
