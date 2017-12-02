<?php
$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_co\nnect_errno() . ": " . mysqli_connect_error() . "</p></div>");

$date_created = time();
$target_dir = "public/img/uploads";
$target_file = $target_dir . '/' . $date_created . '_' . $_FILES["image"]["name"];

echo $target_file . '<br/>';

// Check if file already exists
if (file_exists($target_file)) {
   echo "Sorry, file already exists.";
}

//        echo "a";

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
   echo "1";

   if ($target_file != null){
      $_POST['image'] = $target_file;
   }
   else{
      $_POST['image'] = '../../uploads//0_none.jpg';
   }

   echo "2";

  $_POST['created'] = Time::now();
  $_POST['user_id'] = $this->user->user_id;
  DB::instance(DB_NAME)->insert_row('recipes', $_POST);

  $q = 'SELECT *
        FROM recipes
        WHERE title="'.$_POST["title"].'"
        AND created="'.$_POST["created"].'"';

  $qres = DB::instance(DB_NAME)->select_row($q);

  Router::redirect('/recipes/detail/'.$qres["recipe_id"]);

  } else {
    echo "Sorry, there was an error uploading your file.";
  }

?>