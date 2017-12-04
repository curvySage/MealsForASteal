<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Meals for a Steal - Profile</title>
  <link rel="stylesheet" href="/group_C/public/css/styles.css">
  <link rel="icon" type="image/png" href="/group_C/public/img/favicon.png" />
</head>

<body>
  <div id="header-section">
    <div class="logo">
      
      <a href="index.php"><img src="/group_C/public/img/logo.svg" alt="Meals for a Steal logo"></a>
      <div class="header-text">
        <span class="title">Meals for a Steal</span>
        <span class="current-page">Profile</span>  
      </div>
    </div>
    <div class="right-header">
      <div class="account-selector">
        
        <div>
          <a href="account.php"><img src="/group_C/public/img/menu.svg" alt="account"></a>
          <a href="addrecipe.php"><img src="/group_C/public/img/plus.svg" alt="recipe"></a>
        </div>
        
        <?php

          $db = @mysqli_connect (localhost, "root", "root")
            Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");
  
          @mysqli_select_db($db, "group_c")
            Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

          // check if logged in user is still good

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
    <div class="profile">
      <!--profile header-->
      <div class="profile-side">
        <img src="/group_C/public/img/user.svg" alt="ProfilePic">
        <div class="account-details">
          <?php

          $profile_username = $_GET['username']; 
          $exists = mysqli_query($db, "SELECT user_id, created FROM users WHERE username='" . $profile_username . "';");

          // Does the user exist? 
          if ($exists->num_rows == 0) {
            echo '<h1> User does not exist </h1>'.
            '</div>'.
            '</div>'.
            '</div>'.
            '<a href="index.php" class="go-home">Home</a>';
            exit();
          }

          // If this point is reached, user exists

          $exists_rows = mysqli_fetch_assoc($exists);
          $profile_id = $exists_rows['user_id'];
          $profile_created = $exists_rows['created'];
          $profile_created = gmdate("m/d/Y", ($profile_created - 8 * 60 * 60));

          $posts_number_q = mysqli_query($db,
            "SELECT count(*) from recipes WHERE recipes.user_id = " . $profile_id . ";");

          $posts_score_q = mysqli_query($db,
            "SELECT sum(f.vote) from recipes r inner join feedback f on r.recipe_id = f.recipe_id WHERE r.user_id = ".$profile_id."  group by r.user_id");

          $posts_score = mysqli_fetch_assoc($posts_score_q)['sum(f.vote)'];

          if (!isset($posts_score)) {
            $posts_score = 0;
          }


          $posts_number = mysqli_fetch_assoc($posts_number_q)['count(*)'];

          if (!isset($posts_number)) {
            $posts_score = 0;
          }
          // $posts_number_d = 
          // echo mysqli_fetch_assoc($posts_number_qp)['count(*)'];

          ?>



          <span class="username"><?php echo $profile_username ?></span>
          <div class="info">
            <div class="stat-column">
              <span class="stat-header">Posts</span>
              <span> <?php echo $posts_number ?> </span>
            </div>
            <div class="stat-column">
              <span class="stat-header">Score</span>
              <span> <?php echo $posts_score ?> </span>
            </div>
            <div class="stat-column">
              <span class="stat-header">Joined</span>
              <span> <?php echo $profile_created ?>  </span>
            </div>
          </div>
        </div>
      </div>
      <div class="posts-side">
        <div class="posting-selection">
          <div>
          <?php
            $posts_array = mysqli_query($db,
            "SELECT sum(f.vote), r.title, r.user_id, r.created, r.image, r.recipe_id from recipes r inner join feedback f on r.recipe_id = f.recipe_id WHERE r.user_id = ".$profile_id." group by r.title, r.user_id, r.created, r.image, r.recipe_id order by r.created DESC");


            if (mysqli_num_rows($posts_array) != 0) {
              echo '
              <a class="selected" href="profile.php?username='.$_GET['username'].'">Recent</a>
              <a href="profile-hot.php?username='.$_GET['username'].'">Top Upvoted</a>
            ';  
            }
          ?>
          </div>
        </div>
        <!-- posts-->

        <?php

          if (mysqli_num_rows($posts_array) == 0) {
            echo '
              <img class="sorry" src="/group_C/public/img/empty_user.jpg">
              <h1>There\'s nothing here</h1>';

          } else {
            while ($row = mysqli_fetch_assoc($posts_array)) {

              $post_created = date("m\/d\/Y g:iA", ($row['created'] - 8 * 60 * 60));

              $vote_status_q = mysqli_query($db,
                "SELECT vote FROM feedback where user_id = ".$user_id." and recipe_id = ".$row['recipe_id']." and type = 'v';");

              $ro = mysqli_fetch_assoc($vote_status_q);
              $vote = $ro['vote'];

              echo '
              <div class="page-posting">
                <span class="posting-number">'.$row['recipe_id'].'</span>
                <div class="votes">';

              
              if ((!isset($vote) || $vote == 0) && isset($_COOKIE['token'])) {
                echo '
                  <img id="rep_up_'.$row['recipe_id'].'" class="upvote-button" src="/group_C/public/img/voting/upvote-not-selected.svg" alt="upvote">
                  <span class="score">'.$row['sum(f.vote)'].'</span>
                  <img id="rep_down_'.$row['recipe_id'].'" class="downvote-button" src="/group_C/public/img/voting/downvote-not-selected.svg" alt="downvote">
                ';
              } else 

              if ($vote == 1 && isset($_COOKIE['token'])) {
               echo '
                  <img id="rep_up_'.$row['recipe_id'].'" class="upvote-button" src="/group_C/public/img/voting/upvote-selected.svg" alt="upvote">
                  <span class="score">'.$row['sum(f.vote)'].'</span>
                  <img id="rep_down_'.$row['recipe_id'].'" class="downvote-button" src="/group_C/public/img/voting/downvote-not-selected.svg" alt="downvote">
                '; 
              } else 

              if ($vote == -1 && isset($_COOKIE['token'])) {
                echo '
                  <img id="rep_up_'.$row['recipe_id'].'" class="upvote-button" src="/group_C/public/img/voting/upvote-not-selected.svg" alt="upvote">
                  <span class="score">'.$row['sum(f.vote)'].'</span>
                  <img id="rep_down_'.$row['recipe_id'].'" class="downvote-button" src="/group_C/public/img/voting/downvote-selected.svg" alt="downvote">
                ';
              }

              else {
                echo '
                  <span class="score">'.$row['sum(f.vote)'].'</span>
                ';
              }
                
              echo '
                </div>
                <img class="thumbnail" src="'.$row['image'].'" onError="this.onerror=null;this.src=\'/group_C/public/img/uploads/0_none.png\';" alt="user submitted food">
                <div class="posting-details">
                  <a class="food-title" href="recipe.php?recipe_id='.$row['recipe_id'].'">'.$row['title'].'</a>
                  <span class="date">'.$post_created.'</span>
                </div>
              </div>';

            }

          }

        ?>
        
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="/group_C/public/js/app.js"></script>
</body>

</html>