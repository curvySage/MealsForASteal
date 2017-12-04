<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>Meals for a Steal</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="icon" type="image/png" href="public/img/favicon.png" />
  <!-- Font awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" />
</head>

<body>
  <div id="header-section">
    <div class="logo">
      <!-- Will need to replace these links later -->
      <a href="index.html"><img src="public/img/logo.svg" alt="Meals for a Steal logo"></a>
      <div class="header-text">
        <span class="title">Meals for a Steal</span>
        <span class="current-page">Home</span>
      </div>
    </div>
    <div class="right-header">
      <div class="account-selector">
        <!-- Will need to replace these links later -->
        <div>
        <php








          

         ?>




          <a href="account.php"><img src="public/img/user.svg" alt="account"></a>
          <a href="addrecipeform.php"><img src="public/img/plus.svg" alt="recipe"></a>
        </div>
        <a class="username" href="profile.html">jamesParty</a>
      </div>
    </div>
  </div>
  <div id="content-section">
    <!-- Stuff goes here -->
    <div class="posting-selection">
      <div>
        <a class="selected" href=" ">Popular</a>
        <a href=" ">Recent</a>
      </div>
    </div>
    <div class="page-posting">
      <span class="posting-number">1</span>
      <div class="votes">
        <img class="upvote-button" src="public/img/voting/upvote-not-selected.svg" alt="upvote">
        <span class="score">27</span>
        <img class="downvote-button" src="public/img/voting/downvote-not-selected.svg" alt="downvote">
      </div>
      <img class="thumbnail" src="public/img/filler/food1.png" alt="user submitted food">
      <div class="posting-details">
        <a class="food-title" href="recipe.html">Hot Deli Sub Sandwich</a>
        <span class="date">8 hours ago</span>
        <a class="author" href="profile.html">jamesParty</a>
      </div>
    </div>
    <div class="page-posting">
      <span class="posting-number">2</span>
      <div class="votes">
        <img class="upvote-button" src="public/img/voting/upvote-not-selected.svg" alt="upvote">
        <span class="score">32</span>
        <img class="downvote-button" src="public/img/voting/downvote-not-selected.svg" alt="downvote">
      </div>
      <img class="thumbnail" src="public/img/filler/food2.png" alt="user submitted food">
      <div class="posting-details">
        <a class="food-title">Spicy Cajun Cheeseburger</a>
        <span class="date">14 hours ago</span>
        <a class="author" href="XXXXXX">rocketMan1992</a>
      </div>
    </div>
    <div class="page-posting">
      <span class="posting-number">3</span>
      <div class="votes">
        <img class="upvote-button" src="public/img/voting/upvote-not-selected.svg" alt="upvote">
        <span class="score">8</span>
        <img class="downvote-button" src="public/img/voting/downvote-not-selected.svg" alt="downvote">
      </div>
      <img class="thumbnail" src="public/img/filler/food3.png" alt="user submitted food">
      <div class="posting-details">
        <a class="food-title">Smoked Pink Salmon</a>
        <span class="date">4 hours ago</span>
        <a class="author" href="XXXXXX">paulaDeanRox</a>
      </div>
    </div>
    <div class="page-posting">
      <span class="posting-number">4</span>
      <div class="votes">
        <img class="upvote-button" src="public/img/voting/upvote-not-selected.svg" alt="upvote">
        <span class="score">9</span>
        <img class="downvote-button" src="public/img/voting/downvote-not-selected.svg" alt="downvote">
      </div>
      <img class="thumbnail" src="public/img/filler/food4.png" alt="user submitted food">
      <div class="posting-details">
        <a class="food-title">Cheesy Pasta Roni</a>
        <span class="date">6 hours ago</span>
        <a class="author" href="XXXXXX">paulaDeanRox</a>
      </div>
    </div>
    <div class="load-more">
      <button id="loadmore">Load More</button>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="public/js/app.js"></script>
  <script type="text/javascript" src="public/js/load-posts.js"></script>
</body>

</html>
