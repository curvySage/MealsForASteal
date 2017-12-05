<?php
if (!isset($_COOKIE['token'])) {
    header("Location: /group_C/account.php");
    exit();
}

if (!isset($_POST['title']) || !isset($_POST['ingredients']) || !isset($_POST['instructions']) 
  || $_POST['title'] == "" || $_POST['ingredients'] == "" || $_POST['instructions'] == "") {

  header("Location: /group_C/error.html");
    exit(); 
}

$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

$date_created = time();
// $target_dir = "public/img/uploads";

// echo "path :".$_POST['image'];

// added for url
if (!isset($_POST['image']) || $_POST['image'] == "") {
  $target_dir = "/group_C/public/img/uploads/0_none.png";
} else {
  $target_dir = $_POST['image'];
}

// if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
//    $_POST['image'] = $target_dir . '/0_none.jpg';
// } else {
//    $target_file = $target_dir . '/' . $date_created . '_' . $_FILES["image"]["name"];
//    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
//    $_POST['image'] = $target_file;
// }

   // Get user id of logged in user
   $q = 'SELECT user_id
     	FROM users
     	WHERE username="' . $_COOKIE['username'] . '"';

   $result = mysqli_query($db, $q);
   $rows = mysqli_fetch_row($result);
   mysqli_free_result($result);

   // Insert user specified values into db -- if image
   // $q = 'INSERT INTO recipes(title, ingredients, description, created, user_id, image)
   //    		VALUES("' . $_POST['title'] . '", "' . $_POST['ingredients'] . '", "'
		 //       . $_POST['instructions'] . '", "' . $date_created . '", "'
		 //       . $rows[0] . '", "' . $_POST['image'] . '")';


   // if no image
   $q = 'INSERT INTO recipes(title, ingredients, description, created, user_id, image)
          VALUES("' . $_POST['title'] . '", "' . $_POST['ingredients'] . '", "'
           . $_POST['instructions'] . '", "' . $date_created . '", "'
           . $rows[0] . '", "' . $target_dir . '")';


   $result = mysqli_query($db, $q);

   // Get recipe id of newly created recipe
   // for redirection
   $q = 'SELECT recipe_id
         FROM recipes
         WHERE title="'.$_POST['title'].'"
         AND created="'.$date_created.'"';

   $result = mysqli_query($db, $q);
   $row = mysqli_fetch_row($result);		
   mysqli_free_result($result);

   // Insert a 0 vote to newly created recipe into feedback
   $q = 'INSERT INTO feedback(user_id, recipe_id, vote, created, type)
      		VALUES('.$rows[0].', '.$row[0].', 0, '.$date_created.', "v")';


   $result = mysqli_query($db, $q);
   mysqli_close($db);
 
   header("Location: /group_C/recipe.php?recipe_id=".$row[0]);
?>