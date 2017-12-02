<?
$db = @mysqli_connect (localhost, "root", "root")
  Or die("<div class='error' ><p>Could not connect to mysql.<br>Error Code" . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p></div>");

@mysqli_select_db($db, "group_c")
  Or die("<div class='error'><p>Could not connect to database<br>Error Code" . mysqli_co\nnect_errno() . ": " . mysqli_connect_error() . "</p></div>");

$date_created = time();
$target_dir = "public/img/uploads";
$target_file = $target_dir . '/' . $date_created . '_' . $_FILES["image"]["name"];

// Check if file already exists
if (file_exists($target_file)) {
   echo "Sorry, file already exists.";
}

// If moved successfully to specified path
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
   if ($target_file != null){
      $_POST['image'] = $target_file;
   }
   else {
      $_POST['image'] = $target_dir . '/0_none.jpg';
   }

   // Get user id of logged in user
   $q = 'SELECT user_id
     	FROM users
     	WHERE username="' . $_COOKIE['username'] . '"';

   $result = mysqli_query($db, $q);
   $rows = mysqli_fetch_row($result);
   mysqli_free_result($result);

   // Insert user specified values into db
   $q = 'INSERT INTO recipes(title, ingredients, description, created, user_id, image)
      		VALUES("' . $_POST['title'] . '", "' . $_POST['ingredients'] . '", "'
		       . $_POST['instructions'] . '", "' . $date_created . '", "'
		       . $rows[0] . '", "' . $_POST['image'] . '")';

   $result = mysqli_query($db, $q);
   mysqli_free_result($result);
   mysqli_close($db);

   // Redirect to home
   // Want: redirect to details page
   header("Location: /index.php"); // how do i redirect to details page?
} else {
  echo "Sorry, there was an error uploading your file.";
}
?>