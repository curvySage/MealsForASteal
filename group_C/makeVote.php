<?php 
  
  if(isset($_COOKIE['token'])) {

    $db = @mysqli_connect (localhost, "root", "root")
      Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

    @mysqli_select_db($db, "group_c")
      Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");


    // find user id
    $is_logged_in = mysqli_query($db, 'SELECT *
    FROM users WHERE
    username = "'.$_COOKIE['username'].'"
    AND token = "'.$_COOKIE['token'].'"'); 

    $ro = mysqli_fetch_assoc($is_logged_in);
    $user_id = $ro['user_id'];

    // If vote was previously made, update
    // If vote was not previously made, insert

    $res = mysqli_query($db,
      'SELECT *
      FROM feedback 
      WHERE user_id = '.$user_id.'
      AND recipe_id = '.$_REQUEST["recipe_id"].'
      AND type = "v";');

    $ro;
    $currVote;

    if ($res->num_rows != 0) {
      $ro = mysqli_fetch_assoc($res);
      $currVote = $ro['vote'];  
    }

    $vote = 0;

    if ($_REQUEST['direction'] == "up") {
      $vote = 1;
    } else {
      $vote = -1;
    }


    if ($res->num_rows > 0 ) {
      if ($currVote == $vote) {
        $res = mysqli_query($db,
        'UPDATE feedback
        SET vote = 0
        WHERE user_id = '.$user_id.'
        AND recipe_id = '.$_REQUEST['recipe_id'].'
        AND type = "v"');
      } else {
        $res = mysqli_query($db,
        'UPDATE feedback
        SET vote = '.$vote.'
        WHERE user_id = '.$user_id.'
        AND recipe_id = '.$_REQUEST['recipe_id'].'
        AND type = "v"');
      }
    } else {
      $res = mysqli_query($db,'INSERT INTO feedback
          (user_id, recipe_id, vote, created, type)
          VALUES('.$user_id.', '.$_REQUEST['recipe_id'].', '.$vote.', '.time().', "v")');
      echo 'INSERT INTO feedback
          (user_id, recipe_id, vote, created, type)
          VALUES('.$user_id.', '.$_REQUEST['recipe_id'].', '.$vote.', '.time().', "v")';
    }

    mysqli_free_result($res);
    mysqli_close($db);

  } else {
    
  }

?>